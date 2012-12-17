<?php
/**
 * Wine function library
 */

/**
 * List all Wine
 */
function wine_handle_all_page() {

	// all Wine doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('wine'));
        gatekeeper();
	//elgg_register_title_button();

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) {
		/*case 'popular':
			$content = elgg_list_entities_from_relationship_count(array(
				//'type_subtype_pairs' =>array('group' => 'wine'),
                                'type'=>'group',
                                'subtype'=>'wine',
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
			));
			if (!$content) {
				$content = elgg_echo('wine:none');
			}
			break;
		case 'discussion':
			$content = elgg_list_entities(array(
				'type' => 'object',
				'subtype' => 'wineforumtopic',
				'order_by' => 'e.last_action desc',
				'limit' => 40,
				'full_view' => false,
			));
			if (!$content) {
				$content = elgg_echo('discussion:none');
			}
			break;*/
            
                case 'mine':
                    elgg_set_context('my_wine');
			$content = elgg_list_entities_from_relationship(array(
                            'types' => 'group',
                            'subtypes'=>'wine',
                            'relationship' => 'member',
                            'relationship_guid' => elgg_get_logged_in_user_guid(),
                            'inverse_relationship' => false,
                            'list_class'=>'list-style-all',
                            'full_view' => false,
                            'pagination'=>true
                        ));
                        if (!$content) {
                            $content = elgg_echo('wine:none');
                        }
			break;
		case 'newest':
		default:
			$content = elgg_list_entities(array(
				'type_subtype_pairs' =>array('group' => 'wine'),
				'full_view' => false,
                                'list_class'=>'list-style-all',
                                'pagination'=>true
			));
			if (!$content) {
				$content = elgg_echo('wine:none');
			}
			break;
	}

	$filter = elgg_view('wines/wine_sort_menu', array('selected' => $selected_tab));
	
	//$sidebar = elgg_view('wines/sidebar/find');
	//$sidebar .= elgg_view('wines/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page(elgg_echo('wines:all'), $body);
}

function wine_search_page() {
	elgg_push_breadcrumb(elgg_echo('search'));

	$tag = get_input("tag");
	$title = elgg_echo('groups:search:title', array($tag));

	// groups plugin saves tags as "interests" - see groups_fields_setup() in start.php
	$params = array(
		'metadata_name' => 'interests',
		'metadata_value' => $tag,
		'types' => 'group',
		'full_view' => FALSE,
	);
	$content = elgg_list_entities_from_metadata($params);
	if (!$content) {
		$content = elgg_echo('groups:search:none');
	}

	$sidebar = elgg_view('wines/sidebar/find');
	$sidebar .= elgg_view('wines/sidebar/featured');

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => false,
		'title' => $title,
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List owned groups
 */
function wine_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('wine:owned');
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities(array(
		'type' => 'group',
		'owner_guid' => elgg_get_page_owner_guid(),
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('wine:none');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List groups the user is memober of
 */
function wine_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('wine:yours');
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities_from_relationship_count(array(
		'type' => 'group',
                'subtype'=>'wine',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('wine:none');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Create or edit a group
 *
 * @param string $page
 * @param int $guid
 */
function wine_handle_edit_page($page, $guid = 0) {
        elgg_load_js('elgg.wine_edit');
        elgg_load_js('elgg.validate');

	gatekeeper();
	
	if ($page == 'add') {
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
		$title = elgg_echo('wine:add');
		elgg_push_breadcrumb($title);
		$content = elgg_view('wines/edit');
	} else {
		$title = elgg_echo("wine:edit");
		$wine = get_entity($guid);

		if ($wine && $wine->canEdit()) {
			elgg_set_page_owner_guid($wine->getGUID());
			elgg_push_breadcrumb($wine->name, $wine->getURL());
			elgg_push_breadcrumb($title);
			$content = elgg_view("wines/edit", array('entity' => $wine));
		} else {
			$content = elgg_echo('wine:noaccess');
		}
	}
	
	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group invitations for a user
 */
function wine_handle_invitations_page() {
	gatekeeper();

	$user = elgg_get_page_owner_entity();

	$title = elgg_echo('groups:invitations');
	elgg_push_breadcrumb($title);

	// @todo temporary workaround for exts #287.
	$invitations = groups_get_invited_groups(elgg_get_logged_in_user_guid());
	$content = elgg_view('groups/invitationrequests', array('invitations' => $invitations));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group profile page
 *
 * @param int $guid Group entity GUID
 */
function wine_handle_profile_page($guid) {
        elgg_set_page_owner_guid($guid);
        //elgg_load_js('elgg.googlemap');
        elgg_load_js('elgg.wine');
        elgg_load_js('elgg.modal');
	elgg_load_js('elgg.validate');
        elgg_load_js('elgg.degust');
        elgg_load_js('elgg.popup');
  
       
     

	// turn this into a core function
	global $autofeed;
	$autofeed = true;
        
        elgg_push_context('wine_profile');

	$wine = get_entity($guid);
	if (!$wine) {
		forward('wine/all');
	}

	elgg_push_breadcrumb($wine->name);

	$content = elgg_view('wines/profile/layout', array('entity' => $wine));
	
        $sidebar = '';
        $sidebar .= elgg_view('wines/sidebar/suggestions', array());
        if (group_gatekeeper(false)) {
		//$sidebar = '';
		//if (elgg_is_active_plugin('search')) {
		//	$sidebar .= elgg_view('wines/sidebar/search', array('entity' => $wine));
		//}
		$sidebar .= elgg_view('wines/sidebar/members', array('entity' => $wine));
	} else {
		$sidebar = '';
	}
        
        
	wine_register_profile_buttons($wine);
        

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'title' => $wine->domaine,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($wine->name, $body);
}

/**
 * Group activity page
 *
 * @param int $guid Group entity GUID
 */
function wine_handle_activity_page($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();

	$title = elgg_echo('groups:activity');

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);

	$db_prefix = elgg_get_config('dbprefix');

	$content = elgg_list_river(array(
		'joins' => array("JOIN {$db_prefix}entities e ON e.guid = rv.object_guid"),
		'wheres' => array("e.container_guid = $guid")
	));
	if (!$content) {
		$content = '<p>' . elgg_echo('groups:activity:none') . '</p>';
	}
	
	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Group members page
 *
 * @param int $guid Group entity GUID
 */
function wine_handle_members_page($guid) {

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);
	if (!$group || !elgg_instanceof($group, 'group')) {
		forward();
	}

	group_gatekeeper();

	$title = elgg_echo('groups:members:title', array($group->name));

	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb(elgg_echo('groups:members'));

	$content = elgg_list_entities_from_relationship(array(
		'relationship' => 'member',
		'relationship_guid' => $group->guid,
		'inverse_relationship' => true,
		'types' => 'user',
		'limit' => 20,
	));

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Invite users to a group
 *
 * @param int $guid Group entity GUID
 */
function wine_handle_invite_page($guid) {
	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$wine = get_entity($guid);

	$title = elgg_echo('wine:invite:title');

	elgg_push_breadcrumb($wine->name, $wine->getURL());
	elgg_push_breadcrumb(elgg_echo('wine:invite'));

	if ($wine && $wine->canEdit()) {
		$content = elgg_view_form('wines/invite', array(
			'id' => 'invite_to_group',
			'class' => 'elgg-form-alt mtm',
		), array(
			'entity' => $wine,
		));
	} else {
		$content .= elgg_echo('wine:noaccess');
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Manage requests to join a group
 * 
 * @param int $guid Group entity GUID
 */
function wine_handle_requests_page($guid) {

	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$group = get_entity($guid);

	$title = elgg_echo('groups:membershiprequests');

	if ($group && $group->canEdit()) {
		elgg_push_breadcrumb($group->name, $group->getURL());
		elgg_push_breadcrumb($title);
		
		$requests = elgg_get_entities_from_relationship(array(
			'type' => 'user',
			'relationship' => 'membership_request',
			'relationship_guid' => $guid,
			'inverse_relationship' => true,
			'limit' => 0,
		));
		$content = elgg_view('groups/membershiprequests', array(
			'requests' => $requests,
			'entity' => $group,
		));

	} else {
		$content = elgg_echo("groups:noaccess");
	}

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * Registers the buttons for title area of the wine profile page
 *
 * @param ElggGroup $group
 */
function wine_register_profile_buttons($wine) {

	$actions = array();

	// group owners
	/*if ($wine->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "wine/edit/{$wine->getGUID()}";
		$actions[$url] = 'wine:edit';
		
                $url = elgg_get_site_url() . "wine/invite/{$wine->getGUID()}";
		$actions[$url] = 'wine:invite';
	}*/

	// group members
	//if ($wine->isMember(elgg_get_logged_in_user_entity())) {
        if ($wine->canEdit()) {   
            // edit and invite
            $url = elgg_get_site_url() . "wine/edit/{$wine->getGUID()}";
            $actions[$url] = 'wine:edit';
            
            $url = elgg_normalize_url("degust/add/{$wine->getGUID()}/");
            $url = elgg_add_action_tokens_to_url($url);
            $actions[$url] = 'degust:add';
            
		/*if ($wine->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			// leave
			$url = elgg_get_site_url() . "action/wines/leave?wine_guid={$wine->getGUID()}";
			$url = elgg_add_action_tokens_to_url($url);
			$actions[$url] = 'wine:leave';
		}*/
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
        
        
        //elgg_load_js('lightbox');
        //elgg_load_css('lightbox');
        


	if ($actions) {
		foreach ($actions as $url => $text) {
                    
                    if ($text == 'degust:add'){
                        
                        $link_class='elgg-button elgg-button-action degust-add';
                        
                        
                        elgg_register_menu_item('title', array(
				'name' => $text,
				'href' => $url,
				'text' => elgg_echo($text),
				'link_class' => $link_class,
                                //'title'=>$text.':title'
                                //'target' =>"_blank",
                                //'rel'=>'#overlay',
			));}
                    
                    else{
			elgg_register_menu_item('title', array(
				'name' => $text,
				'href' => $url,
				'text' => elgg_echo($text),
				'link_class' => 'elgg-button elgg-button-action',
                                'title'=>elgg_echo($text.':title')
			));}
		}
	}
}

function wine_handle_addtocave_page($entity_guid){
 
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('wine:addtocave'));
        
        $entity=get_entity($entity_guid);
          
        $restobarnews= get_entity($guid);
	$content = elgg_view('wines/addtocave',array('entity'=>$entity));
	

	$params = array(
		'content' => $content,
		'title' => elgg_echo('wine:addtocave'),
		'filter' => '',
	);
	$body = elgg_view_layout('one_column', $params);
        
	echo elgg_view_page($title, $content,'overlay');   
    
}


       

?>
