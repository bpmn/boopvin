<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

elgg_register_event_handler('init', 'system', 'degust_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'degust_fields_setup', 10000);

function degust_init(){
    
    	elgg_register_library('degust', elgg_get_plugins_path() . 'degusts/lib/degust.php');

	// register wine entities for search
	elgg_register_entity_type('object','degust');
        add_subtype('object', 'degust', 'ElggDegust');
        
        // Register a page handler, so we can have nice URLs
	elgg_register_page_handler('degust', 'degust_page_handler');

        //extend some views
	elgg_extend_view('css/elgg', 'degusts/css');
        
        elgg_extend_view('wines/tool_latest', 'degusts/module');
        
	//elgg_register_js('elgg.degust', 'js/degusts/degust.js', 'footer');
        $url = 'mod/degusts/views/default/js/degusts/degust.js';
	elgg_register_js('elgg.degust', $url, 'footer');
	elgg_load_js('elgg.degust');
        //elgg_extend_view('js/elgg', 'degusts/js');
        
        $jquery_UI = elgg_get_simplecache_url('css', 'degusts/JqueryUI_css');
        elgg_register_css('degust.jqueryUI', $jquery_UI,'head',1000);
        elgg_load_css('degust.jqueryUI');
        
        elgg_register_plugin_hook_handler('register', 'menu:entity', 'degust_entity_menu_setup');
        elgg_register_plugin_hook_handler('permissions_check', 'object', 'degust_override_permissions');
        
        $action_base = elgg_get_plugins_path() . 'degusts/actions/degusts';
	elgg_register_action("degusts/edit", "$action_base/edit.php");
        elgg_register_action("degusts/delete", "$action_base/delete.php");
        
        // Register URL handlers for wine
	elgg_register_entity_url_handler('object', 'degust', 'degust_url');
};

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function degust_fields_setup() {

	$profile_defaults = array(
		
            
 // MetaData
 // Visuel
             'visuel'=>array(  
                    'couleur_intensity'=>'coloradio',             
                    'couleur'=>'coloradio',
                    'reflet'=>'coloradio',
                    'mousse'=>'coloradio',
                    'nez_bulle'=>'coloradio'),
             
 //Olfactif
             'olfactif'=>array(
                    'nez_intensity'=>'coloradio',
                    'nez'=>'noseboxes',    // résultat des checkboxes sous forme de tableau
                    'arome'=>'text'),        // description texte des arôme
                    //'complexity'=>'text'),   // en fonction du nombres de checkbox cochées.
 //Gustatif
             'gustatif'=> array(
                    'rondeur'=>'paletradio',
                    'palet_bulle'=>'paletradio',
                    'acidity'=>'paletradio',
                    'dosage'=>'paletradio',
                    'alcool'=>'paletradio',
                    'tanin'=>'paletradio',
                    'moelleux'=>'paletradio',
                    'retro'=>'text',
                    'longueur'=>'paletradio'),
 
 //Commentaire final
              'comment'=>array(
                    'evolution'=>'paletradio',
                    'comment'=>'longtext',   //commentaire finale
                    'accord'=>'text',        //proposition accord mets vins
                    'note'=>'notedropdown' )      //note sur 20.        
            
	);

	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'object', NULL, $profile_defaults);

	elgg_set_config('degust', $profile_defaults);

	
}

/**
 * Degust page handler
 *
 * URLs take the form of
 *  All wine:           degust/all
 *  User's owned wine:  degust/owner/<username>
 *  User's member wine: degust/member/<username>
 *  wine profile:        degust/profile/<guid>/<title>
 *  New wine:            degust/add/<guid>
 *  Edit wine:           degust/edit/<guid>
 *  wine invitations:    degust/invitations/<username>
 *  Invite to wine:      degust/invite/<guid>
 *  Membership requests:  degust/requests/<guid>
 *  wine activity:       degust/activity/<guid>
 *  wine members:        degust/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function degust_page_handler($page) {

	elgg_load_library('degust');

	elgg_push_breadcrumb(elgg_echo('degust'), "degust/all");

	switch ($page[0]) {
	
		case 'add':
                        set_input('entity_guid',$page[1]);
                        set_input('annee',$page[2]);
			degust_handle_edit_page('add');
			break;
		case 'edit':
                        set_input('entity_guid',$page[1]);
			degust_handle_edit_page('edit');
			break;
		case 'profile':
			degust_handle_profile_page($page[1]);
			break;

		default:
			return false;
	}
	return true;
}



/**
 * Populates the ->getUrl() method for wine objects
 *
 * @param ElggEntity $entity File entity
 * @return string File URL
 */
function degust_url($entity) {
	$title = elgg_get_friendly_title($entity->name);

	return "degust/profile/{$entity->guid}/$title";
}




/**
 * Add links/info to entity menu particular to wine entities
 */
function degust_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'degust') {
		return $return;
	}

	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access', 'likes', 'edit', 'delete'))) {
			unset($return[$index]);
		}
	}

	// membership type
	$membership = $entity->membership;
	if ($membership == ACCESS_PUBLIC) {
		$mem = elgg_echo("wine:open");
	} else {
		$mem = elgg_echo("wine:closed");
	}
	$options = array(
		'name' => 'membership',
		'text' => $mem,
		'href' => false,
		'priority' => 100,
	);
	$return[] = ElggMenuItem::factory($options);

	// number of members
	$num_members = get_group_members($entity->guid, 10, 0, 0, true);
	$members_string = elgg_echo('wine:member');
	$options = array(
		'name' => 'members',
		'text' => $num_members . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options);

	// feature link
	if (elgg_is_admin_logged_in()) {
		if ($entity->featured_group == "yes") {
			$url = "action/wine/featured?wine_guid={$entity->guid}&action_type=unfeature";
			$wording = elgg_echo("wine:makeunfeatured");
		} else {
			$url = "action/wine/featured?wine_guid={$entity->guid}&action_type=feature";
			$wording = elgg_echo("wine:makefeatured");
		}
		$options = array(
			'name' => 'feature',
			'text' => $wording,
			'href' => $url,
			'priority' => 300,
			'is_action' => true
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}


function degust_override_permissions($hook, $entity_type, $returnvalue, $params){
    $degust=elgg_extract('entity', $params);
    $user=elgg_extract('user', $params);
    if ($degust->getSubtype()== 'degust'){
        $container_entity = get_entity($degust->container_guid);
	if ($container_entity->canEdit($user->getGUID()) && ($degust->getOwnerGUID()!= $user->getGUID())) {
			return false;
	}
    }
    
    
}
?>