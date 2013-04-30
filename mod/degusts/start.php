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
	//elgg_extend_view('css/elgg', 'degusts/css');
        
        elgg_extend_view('wines/tool_latest', 'degusts/module');
       
        
         /*script degust*/
        $degust_js = elgg_get_simplecache_url('js', 'degust');
	elgg_register_simplecache_view('js/degust');
	elgg_register_js('elgg.degust', $degust_js,'footer');
        //elgg_load_js('elgg.degust');
        
        elgg_register_plugin_hook_handler('register', 'menu:entity', 'degust_entity_menu_setup');
        elgg_register_plugin_hook_handler('permissions_check', 'object', 'degust_override_permissions');
        elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'degust_setup_owner_block_menu');
        
        $action_base = elgg_get_plugins_path() . 'degusts/actions/degusts';
	elgg_register_action("degusts/edit", "$action_base/edit.php");
        elgg_register_action("degusts/delete", "$action_base/delete.php");
        
        // Register URL handlers for wine
	elgg_register_entity_url_handler('object', 'degust', 'degust_url');
        register_notification_object('object', 'degust', elgg_echo('degust:notification:topic:subject'));
        
        elgg_register_plugin_hook_handler('object:notifications', 'object', 'degust_notifications');
        //elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'degust_notify_message');
        
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
                    'bulle'=>'coloradio'),
             
 //Olfactif
             'olfactif'=>array(
                    'nez_intensity'=>'coloradio',
                    'nez'=>'noseboxes', // résultat des checkboxes sous forme de tableau
                    'complexity'=>'hidden', // en fonction du nombres de checkbox cochées.
                    'arome'=>'text'),        // description texte des arôme
                       
 //Gustatif
             'gustatif'=> array(
                    'rondeur'=>'coloradio',
                    'acidity'=>'coloradio',
                    'douceur'=>'coloradio',
                    'palet_bulle'=>'coloradio',
                    'dosage'=>'coloradio',
                    'alcool'=>'coloradio',
                    'tanin'=>'coloradio',
                    'moelleux'=>'coloradio',
                    'retro'=>'text',
                    'longueur'=>'coloradio',
                    'equilibre'=>'coloradio'),
 
 //Commentaire final
              'comment'=>array(
                    'evolution'=>'coloradio',
                    'comment'=>'longtext',   //commentaire finale
                    'context'=>'text',        //proposition accord mets vins
                    'note'=>'notedropdown', //note sur 20.
                    )              
            
	);

        
        $profile_defaults_view = array(
		
            
 // MetaData
 // Visuel
             'visuel'=>array(  
                    'couleur_intensity'=>'coloradio',             
                    'couleur'=>'coloradio',
                    'reflet'=>'coloradio',
                    'mousse'=>'coloradio',
                    'bulle'=>'coloradio'),
             
 //Olfactif
             'olfactif'=>array(
                    'nez_intensity'=>'coloradio',
                    'nez'=>'noseboxes', // résultat des checkboxes sous forme de tableau
                    'complexity'=>'hidden', // en fonction du nombres de checkbox cochées.
                    'arome'=>'text'),        // description texte des arôme
                       
 //Gustatif
             'gustatif'=> array(
                    'rondeur'=>'coloradio',
                    'acidity'=>'coloradio',
                    'douceur'=>'coloradio',
                    'palet_bulle'=>'coloradio',
                    'dosage'=>'coloradio',
                    'alcool'=>'coloradio',
                    'tanin'=>'coloradio',
                    'moelleux'=>'coloradio',
                    'retro'=>'text',
                    'longueur'=>'coloradio',
                    'equilibre'=>'coloradio'),
 
 //Commentaire final
              'comment'=>array(
                    'evolution'=>'coloradio',
                    'comment'=>'longtext',   //commentaire finale
                    'context'=>'text',        //proposition accord mets vins
                    'note'=>'notedropdown', //note sur 20.
                    'price'=>'dropdown')              
            
	);
        
        
        
        
	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'object', NULL, $profile_defaults);

	elgg_set_config('degust', $profile_defaults);
        elgg_set_config('degust_profile', $profile_defaults_view);

	
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
			degust_handle_profile_page($page[1],$page[2]);
                        break;
                case 'wine':
                        elgg_set_context('wine:degust');
                        elgg_set_page_owner_guid($page[1]);
                        degust_handle_wine_page();
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
	
            return "degust/profile/{$entity->guid}";
       
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
	/*$membership = $entity->membership;
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
	$return[] = ElggMenuItem::factory($options);*/

	// number of members
	/*$num_members = get_group_members($entity->guid, 10, 0, 0, true);
	$members_string = elgg_echo('wine:member');
	$options = array(
		'name' => 'members',
		'text' => $num_members . ' ' . $members_string,
		'href' => false,
		'priority' => 200,
	);
	$return[] = ElggMenuItem::factory($options);*/

	// feature link
	/*if (elgg_is_admin_logged_in()) {
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
	}*/

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


function degust_setup_owner_block_menu($hook, $type, $return, $params) {

	// Get the page owner entity
	
		if (elgg_instanceof($params['entity'], 'group','wine' )) {
			if (elgg_is_logged_in()) {
				$url = elgg_normalize_url("degust/wine/{$params['entity']->getGUID()}");	
                                $text= 'wine:degust:all';				
                                $menu_item=array('name' => $text,'text' => elgg_echo($text),'href' => $url);
                                $item = ElggMenuItem::factory($menu_item);
                                $return[] = $item;
			
			
		}
	}
    return $return;
}


/**
 * Catch object notif for degust and generate notifications
 *
 * @todo this will be replaced in Elgg 1.9 and is a clone of object_notifications()
 *
 * @param string         $event
 * @param string         $type
 * @param ElggAnnotation $annotation
 * @return void
 */
function degust_notifications($event, $type, $return, $param) {
	
        global $CONFIG, $NOTIFICATION_HANDLERS;
        $degust=$param['object'];
        

	if ($degust->getSubtype() !== 'degust') {
		return ;
	}

	// Have we registered notifications for this type of entity?
	$object_type = 'object';
	$object_subtype = 'degust';

	

	$poster = $degust->getOwnerEntity();
	if (!$poster) {
		return $return;
	}

	if (isset($CONFIG->register_objects[$object_type][$object_subtype])) {
		$subject = $poster->name." ".$CONFIG->register_objects[$object_type][$object_subtype];
		$string = $subject . ": " . $degust->getURL();

		// Get users interested in content from this person and notify them
		// (Person defined by container_guid so we can also subscribe to groups if we want)
                // on adapte les notifications de degust qu'au notifier
                //foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
			$interested_users = elgg_get_entities_from_relationship(array(
				//'relationship' => 'notify' . $method,
                                'relationship' => 'notify' . 'notifier',
				'relationship_guid' => $degust->getOwnerGUID(),
				'inverse_relationship' => true,
				'types' => 'user',
				'limit' => 999999,
			));
                        
                        $interested_users_bis = elgg_get_entities_from_relationship(array(
					'site_guids' => ELGG_ENTITIES_ANY_VALUE,
					'relationship' => 'notify' . 'notifier',					
                                        'relationship_guid' => $degust->container_guid,
  					'inverse_relationship' => TRUE,
					'types' => 'user',
					'limit' => 99999
				));
                        
                        
                       if ($interested_users_bis && is_array($interested_users_bis)) {
                           if ($interested_users && is_array($interested_users))
                               $interested_users=array_merge($interested_users,$interested_users_bis);
                           else {
                               $interested_users=$interested_users_bis;
                           }
                       }

	if ($interested_users && is_array($interested_users)) {
					foreach ($interested_users as $user) {
						if ($user instanceof ElggUser && !$user->isBanned()) {
							if (($user->guid != elgg_get_logged_in_user_guid()) && has_access_to_entity($degust, $user)
							&& $degust->access_id != ACCESS_PRIVATE) {
								$body = elgg_trigger_plugin_hook('notify:entity:message', $degust->getType(), array(
									'entity' => $degust,
									'to_entity' => $user,
									'method' => 'notifier'), $string);
								if (empty($body) && $body !== false) {
									$body = $string;
								}
								if ($body !== false) {
									notify_user($user->guid, $degust->owner_guid, $subject, $body,
										null, array($method));
								}
							}
						}
					}
				}
		//}
	
         $return=true;
        }

return $return;
}

/* le message est crée dans le notifier
function degust_notify_message($hook, $type, $message, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];

	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'degust')) {
		$descr = $entity->description;
		$title = $entity->title;
		$url = $entity->getURL();
		$owner = $entity->getOwnerEntity();
		$wine = $entity->getContainerEntity();

		return elgg_echo('degust:notification', array(
			$owner->name,
			$entity->title,
			$entity->getURL()
		));
	}

	return null;
}*/

