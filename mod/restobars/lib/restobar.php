<?php
/**
 * Restobar function library
 */

/**
 * List all restobar
 */
function restobar_handle_all_page() {
        //gatekeeper();
	// all Restobar doesn't get link to self
	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('restobar'));
        gatekeeper();
        elgg_load_js('search.auto_other');
	//elgg_register_title_button();
       
        
        // extend view for header restobar search box
	//elgg_extend_view('page/layouts/content/header', 'restobars/sidebar/find');

	$selected_tab = get_input('filter', 'newest');

	switch ($selected_tab) {
		case 'around':
			/*$content = elgg_list_entities_from_relationship_count(array(
				//'type_subtype_pairs' =>array('group' => 'restobar'),
                                'type'=>'group',
                                'subtype'=>'restobar',
				'relationship' => 'member',
				'inverse_relationship' => false,
				'full_view' => false,
			));*/
			elgg_load_js('elgg.restobar');
                        $content= '<div id="list-around"></div>';
                        if (!$content) {
				$content = elgg_echo('restobar:none');
			}
			break;
		
		case 'newest':
		default:
			$content = elgg_list_entities(array(
				'type_subtype_pairs' =>array('group' => 'restobar'),
				'full_view' => false,
                                'list_class'=>'list-style-all-resto'
			));
			if (!$content) {
				$content = elgg_echo('restobar:none');
			}
			break;
	}

	$filter = elgg_view('restobars/restobar_sort_menu', array('selected' => $selected_tab));
	//$content .=elgg_view('restobars/sidebar/find');
	//$sidebar = elgg_view('restobars/sidebar/find');
	$sidebar .= elgg_view('restobars/sidebar/featured');

	$title=elgg_echo('restobar');
        
        elgg_push_context('restobar');
        $search_box= elgg_view('search/entity/find');
        elgg_pop_context();
        
        $params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => $filter,
                'title'=> $title,
                'search_box'=>$search_box
	);
	$body = elgg_view_layout('content_with_search', $params);
        
        //elgg_view('restobars/sidebar/find');
	echo elgg_view_page($title, $body);
        //echo elgg_view_page('', $body);
}

function restobar_search_page() {
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

	$sidebar = elgg_view('restobars/sidebar/find');
	$sidebar .= elgg_view('restobars/sidebar/featured');

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
function restobar_handle_owned_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('restobar:owned');
	elgg_push_breadcrumb($title);

	//elgg_register_title_button();

	$content = elgg_list_entities(array(
		'types' => 'group',
                'subtypes' => 'restobar',
		'owner_guid' => elgg_get_page_owner_guid(),
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('restobar:none');
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
function restobar_handle_mine_page() {

	$page_owner = elgg_get_page_owner_entity();

	$title = elgg_echo('restobar:yours');
	elgg_push_breadcrumb($title);

	elgg_register_title_button();

	$content = elgg_list_entities_from_relationship_count(array(
		'type' => 'group',
                'subtypes'=>'restobar',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_page_owner_guid(),
		'inverse_relationship' => false,
		'full_view' => false,
	));
	if (!$content) {
		$content = elgg_echo('restobar:none');
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
function restobar_handle_edit_page($page, $guid = 0) {
        gatekeeper();
        elgg_load_js('elgg.googlemap');
        elgg_load_js('elgg.restobar');
        elgg_load_js('elgg.modal');
        elgg_load_js('elgg.popup');
        
        elgg_load_js('elgg.restobar_edit');
        elgg_load_js('elgg.validate');
	
	if ($page == 'add') {
		elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
		$title = elgg_echo('restobar:add');
		elgg_push_breadcrumb($title);
		$content = elgg_view('restobars/edit');
	} else {
		$title = elgg_echo("restobar:edit");
		$restobar = get_entity($guid);

		if ($restobar && $restobar->canEdit()) {
			elgg_set_page_owner_guid($restobar->getGUID());
			elgg_push_breadcrumb($restobar->name, $restobar->getURL());
			elgg_push_breadcrumb($title);
			$content = elgg_view("restobars/edit", array('entity' => $restobar));
		} else {
			$content = elgg_echo('restobar:noaccess');
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
function restobar_handle_invitations_page() {
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
function restobar_handle_profile_page($guid) {
       elgg_load_js('elgg.googlemap');
       elgg_load_js('elgg.restobar');
       elgg_load_js('elgg.modal');
       elgg_load_js('elgg.popup');
       
	elgg_set_page_owner_guid($guid);

	elgg_push_context('restobar');
       

	// turn this into a core function
	global $autofeed;
	$autofeed = true;

	$restobar = get_entity($guid);
	if (!$restobar) {
		forward('restobar/all');
	}

	elgg_push_breadcrumb($restobar->name);

	$content = elgg_view('restobars/profile/layout', array('entity' => $restobar));
	if (group_gatekeeper(false)) {
		$sidebar = '';
		/*if (elgg_is_active_plugin('search')) {
			$sidebar .= elgg_view('restobars/sidebar/search', array('entity' => $restobar));
		}*/
		$sidebar .= elgg_view('restobars/sidebar/members', array('entity' => $restobar));
	} else {
		$sidebar = '';
	}

	restobar_register_profile_buttons($restobar);
        

	$params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'title' => $restobar->name,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($restobar->name, $body);
}

/**
 * Group activity page
 *
 * @param int $guid Group entity GUID
 */
function restobar_handle_activity_page($guid) {

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
function restobar_handle_members_page($guid) {

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
function restobar_handle_invite_page($guid) {
	gatekeeper();

	elgg_set_page_owner_guid($guid);

	$restobar = get_entity($guid);

	$title = elgg_echo('restobar:invite:title');

	elgg_push_breadcrumb($restobar->name, $restobar->getURL());
	elgg_push_breadcrumb(elgg_echo('restobar:invite'));

	if ($restobar && $restobar->canEdit()) {
		$content = elgg_view_form('restobars/invite', array(
			'id' => 'invite_to_group',
			'class' => 'elgg-form-alt mtm',
		), array(
			'entity' => $restobar,
		));
	} else {
		$content .= elgg_echo('restobar:noaccess');
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
function restobar_handle_requests_page($guid) {

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
function restobar_handle_cave_page($restobar_guid) {
        elgg_set_page_owner_guid($restobar_guid);
        elgg_push_context('restobar');
             $content = elgg_list_entities_from_relationship(array(
                            'types'=>'group',
                            'subtypes'=>'wine',
                            'limit' => 100,
                            'pagination' => true,
                            'relationship' => 'incave',
                            'relationship_guid' => $restobar_guid,
                            'inverse_relationship' => FALSE,
                            'full_view'=>FALSE,
                            'list_type' => 'gallery'
                    ));

        elgg_pop_context('restobar');
        $restobar=get_entity($restobar_guid);
        $title=elgg_echo('restobar:cave',array("{$restobar->name}"));
        $params = array(
		'content' => $content,
		'sidebar' => $sidebar,
		'filter' => false,
		'title' => $title,
	);
        
        $body = elgg_view_layout('content', $params);
        

	echo elgg_view_page($title, $body);

}


function restobar_handle_addmember_page($user_guid) {
        elgg_set_page_owner_guid($restobar_guid);
    
        $user=get_entity($user_guid);
        $title=elgg_echo('restobar:addmember',array("{$user->name}"));
      
	$content = elgg_view('restobars/addmember',array('entity'=>$user));
	

	$params = array(
		'content' => $content,
		'title' => $title,
		'filter' => '',
	);
	$body = elgg_view_layout('one_column', $params);
        
	echo elgg_view_page($title, $body,'overlay');   

}

/**
 * Registers the buttons for title area of the restobar profile page
 *
 * @param ElggGroup $group
 */
function restobar_register_profile_buttons($restobar) {

	$actions = array();

	// group owners
	if ($restobar->canEdit()) {
		// edit and invite
		$url = elgg_get_site_url() . "restobar/edit/{$restobar->getGUID()}";
		$actions[$url] = 'restobar:edit';
		
              /*  $url = elgg_get_site_url() . "restobar/invite/{$restobar->getGUID()}";
		$actions[$url] = 'restobar:invite';*/
	}

	// group members
	if ($restobar->isMember(elgg_get_logged_in_user_entity())) {
            
		if ($restobar->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
			// leave
			$url = elgg_get_site_url() . "action/restobars/leave?restobar_guid={$restobar->getGUID()}";
			$url = elgg_add_action_tokens_to_url($url);
			$actions[$url] = 'restobar:leave';
		}
	} /*elseif (elgg_is_logged_in()) {
		// join - admins can always join.
		$url = elgg_get_site_url() . "action/restobars/join?restobar_guid={$restobar->getGUID()}";
		$url = elgg_add_action_tokens_to_url($url);
		if ($restobar->isPublicMembership() || $restobar->canEdit()) {
			$actions[$url] = 'restobar:join';
		} else {
			// request membership
			$actions[$url] = 'restobar:joinrequest';
		}
	}*/
        
        
        //elgg_load_js('lightbox');
        //elgg_load_css('lightbox');
        

        

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
}?>
