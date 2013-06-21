<?php
/**
 * Degust function library
 *
 *
 * 
 * List all Degust
 */


function degust_handle_all_page($wine_guid) {

	// all Wine doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('degust'));

	//elgg_register_title_button();

	
			$content = elgg_list_entities(array(
				'type_subtype_pairs' =>array('object' => 'degust'),
				'full_view' => false,
                                'container_guid'=>$wine_guid
			));
	
	$sidebar = elgg_view('degusts/sidebar/find');
	$sidebar .= elgg_view('degusts/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('degust:all'), $body);
}


/**
 * List owned Degusts
 */
function degust_handle_wine_page() {
        elgg_load_js('elgg.modal');
        elgg_load_js('elgg.degust');
	$page_owner = elgg_get_page_owner_entity();
        $owner_guid = elgg_get_logged_in_user_guid();
  
        // all Wine doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('degust'));

	//elgg_register_title_button();

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) {
	
                case 'mine':
                           
                        $options=array( 'types' => 'object',
                                        'subtypes'=>'degust',
                                        'owner_guid' => $owner_guid,
                                        'container_guid'=>$page_owner->getGUID(),
                                        'list_class'=>'list-style-all',
                                        'full_view' => false,
                                        'pagination'=>true);
                       
                        $content = "<div class=\"degust_list\">".elgg_list_entities($options)."</div>";
        
                        if (!$content) {
                            $content = elgg_echo('degust:none');
                        }
			break;
		case 'newest':
		default:
		   
                         $options=array('types' => 'object',
                                        'subtypes'=>'degust',
                                        'container_guid'=>$page_owner->getGUID(),
                                        'list_class'=>'list-style-all',
                                        'full_view' => false,
                                        'pagination'=>true);
        
                       
                        $content = "<div class=\"degust_list\">".elgg_list_entities($options)."</div>";
        
                        if (!$content) {
                            $content = elgg_echo('degust:none');
                        }
                       
			break;
	}

	$filter = elgg_view('degusts/degust_sort_menu', array('selected' => $selected_tab,'wine_guid'=>$page_owner->getGUID()));
	
	//$sidebar = elgg_view('wines/sidebar/find');
	//$sidebar .= elgg_view('wines/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('degust:all'), $body);
}




/**
 * Create or edit a degustation
 *
 * @param string $page
 * @param int $guid
 */
function degust_handle_edit_page($page, $guid = 0) {
           
        gatekeeper();
	$guid=(int)get_input('entity_guid');
	if ($page == 'add') {
		$wine = get_entity($guid);
		if (!($wine instanceof ElggGroup)) {
			register_error(elgg_echo('wine:notfound'));
			forward();
		}
                
                
		// make sure user has permissions to add a topic to container
		//if (!$group->canWriteToContainer(0, 'object', 'groupforumtopic')) {
			//register_error(elgg_echo('groups:permissions:error'));
			//forward($group->getURL());
		//}

                
                
                // éviter qu'un utilisateur crée une autre fiche de dégustation s'il en a déjà une sur ce vin
                // 'todo' et si c'est le même millésime sélectionné.
                
               // $user_guid=elgg_get_logged_in_user_guid();
               // if($degust=elgg_get_entities(array('type_subtype_pairs'=>array('object' => 'degust'),'owner_guids'=>$user_guid,'container_guids'=>$wine->getGUID()))){
               //    forward(elgg_get_site_url().'degust/edit/'.$degust->getGUID());
               // }
                
                
		//$title = elgg_echo('degust:add');
		//elgg_push_breadcrumb($title);
                
		$content = elgg_view('degusts/edit',array('container_guid' => $wine->getGUID()));
                   
		
                
	} else {
		//$title = elgg_echo("degust:edit");
		$degust = get_entity($guid);
                if (!($degust instanceof ElggObject)) {
			register_error(elgg_echo('object:notfound'));
			forward();
		}
		if ($degust && $degust->canEdit()) {
			elgg_set_page_owner_guid($guid);
			//elgg_push_breadcrumb($degust->title, $degust->getURL());
			//elgg_push_breadcrumb($title);
			$content = elgg_view("degusts/edit", array('entity' => $degust));
		} else {
			$content = elgg_echo('degust:noaccess');
		}
	}
	
        
        $help=elgg_view('degusts/help');
	$params = array(
		'tab1' => $content,
		'tab2' => $help,
                
		'filter' => '',
                //'class'=>'elgg-overlay'
                
	);
        	
	

	$body = elgg_view_layout('degust_one_column', $params);
        //echo $body;

	echo elgg_view_page($title, $body,'overlay');
        //echo elgg_view_page($title, $body);
}



/**
 * Group profile page
 *
 * @param int $guid Group entity GUID
 */
function degust_handle_profile_page($guid,$overlay) {
    
	if ($overlay != "overlay"){
         gatekeeper();
        }
        elgg_set_page_owner_guid($guid);
	elgg_push_context('degust_profile');

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	$degust = get_entity($guid);
	if (!$degust) {
                $wine=get_entity($degust->container_guid);
		forward("{$wine->getURL()}");
	}

	//elgg_push_breadcrumb($wine->name);
        
        if ($degust->canEdit()){
                        $url = "edit/{$degust->getGUID()}";
                        elgg_register_menu_item('edit_degust', array(
				'name' => 'degust:edit',
				'data-action' => $url,
				'text' => elgg_echo('degust:edit'),
				'link_class' => 'elgg-button elgg-button-action degust-edit',
                                
                                //'rel'=>'#overlay',
			));}

	$content = elgg_view('degusts/profile/layout', array('entity' => $degust));
        $sidebar = elgg_view('degusts/profile/sidebar', array('entity' => $degust));

		

	$params = array(
		'content' => $content,
		'title' => $title,
                'sidebar'=>$sidebar,
		'filter' => ''
                
	);
        	
	      
	$body = elgg_view_layout('degust_one_sidebar', $params);
        
        if ($overlay =="overlay"){
            echo elgg_view_page($title, $body,'overlay');
        }else{
            echo elgg_view_page($title, $body,'degust_normal');
        }
}




/**
 * Registers the buttons for title area of the wine profile page
 *
 * @param ElggGroup $group
 */
function degust_register_profile_buttons($wine) {

	$actions = array();

	// group owners
	if ($wine->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "wine/edit/{$wine->getGUID()}";
		$actions[$url] = 'wine:edit';
		
                $url = elgg_get_site_url() . "wine/invite/{$wine->getGUID()}";
		$actions[$url] = 'wine:invite';
	}

	// group members
	if ($wine->isMember(elgg_get_logged_in_user_entity())) {
		if ($wine->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			// leave
			$url = elgg_get_site_url() . "action/wines/leave?wine_guid={$wine->getGUID()}";
			$url = elgg_add_action_tokens_to_url($url);
			$actions[$url] = 'wine:leave';
		}
	} elseif (elgg_is_logged_in()) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/wines/join?wine_guid={$wine->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($wine->isPublicMembership() || $wine->canEdit()) {
			$actions[$url] = 'wine:join';
		} else {
			// request membership
			$actions[$url] = 'wine:joinrequest';
		}
	}

	if ($actions) {
		foreach ($actions as $url => $text) {
			elgg_register_menu_item('title', array(
				'name' => $text,
				'href' => $url,
				'text' => elgg_echo($text),
				'link_class' => 'elgg-button elgg-button-action',
			));
		}
	}
}
