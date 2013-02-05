<?php
/**
 * Restobars plugin
 *
 * @package ElggRestobar
 */

elgg_register_event_handler('init', 'system', 'restobar_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'restobar_fields_setup', 10000);

/**
 * Initialize the restobars plugin.
 */
function restobar_init() {

	elgg_register_library('restobar', elgg_get_plugins_path() . 'restobars/lib/restobar.php');

	// register restobar entities for search
	elgg_register_entity_type('group','restobar');
        add_subtype('group', 'restobar', 'ElggRestobar');

	// Set up the menu
	$item = new ElggMenuItem('restobar', elgg_echo('restobar'), 'restobar/all');
	elgg_register_menu_item('site', $item);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('restobar', 'restobar_page_handler');

	// Register URL handlers for restobar
	elgg_register_entity_url_handler('group', 'restobar', 'restobar_url');
	elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'restobar_icon_url_override');
        
        // Extend avatar hover menu
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'restobar_user_hover_menu');
        
        // Extend edit permission to members
        elgg_register_plugin_hook_handler('permissions_check', 'group', 'restobar_override_permissions');

	// Register an icon handler for restobar
	elgg_register_page_handler('restobaricon', 'restobar_icon_handler');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'restobars/actions/restobar';
	elgg_register_action("restobars/edit", "$action_base/edit.php");
	elgg_register_action("restobars/delete", "$action_base/delete.php");
	elgg_register_action("restobars/featured", "$action_base/featured.php", 'admin');
        
        $action_friends = $action_base.'/friends';
        elgg_register_action("restobars/friends/add", "$action_friends/add.php");
        elgg_register_action("restobars/friends/remove", "$action_friends/remove.php");

	$action_membership = $action_base.'/membership';
	elgg_register_action("restobars/invite", "$action_membership/invite.php");
	elgg_register_action("restobars/join", "$action_membership/join.php");
	elgg_register_action("restobars/leave", "$action_membership/leave.php");
	elgg_register_action("restobars/remove", "$action_membership/remove.php");
	elgg_register_action("restobars/killrequest", "$action_membership/delete_request.php");
	elgg_register_action("restobars/killinvitation", "$action_membership/delete_invite.php");
	elgg_register_action("restobars/addmember", "$action_membership/add.php");

       
        elgg_register_ajax_view('restobars/ajax/showmap');
        elgg_register_ajax_view('restobars/ajax/restobar_around');
        
	// Add some widgets
	elgg_register_widget_type('a_users_restobars', elgg_echo('restobar:widget:membership'), elgg_echo('restobar:widgets:description'));

	// add group activity tool option
	//add_group_tool_option('activity', elgg_echo('restobar:enableactivity'), true);
	elgg_extend_view('restobars/tool_latest', 'restobars/profile/cave_module');

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'restobar_activity_owner_block_menu');

	// group entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'restobar_entity_menu_setup');
	
	// group user hover menu	
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'restobar_user_entity_menu_setup');

	// delete and edit annotations for topic replies
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'restobar_annotation_menu_setup');

	//extend some views
	elgg_extend_view('css/elgg', 'restobars/css');
        elgg_extend_view('js/elgg', 'restobars/js');
	
        // register the restobar's JavaScript
	$restobar_js = elgg_get_simplecache_url('js', 'restobar_map');
	elgg_register_simplecache_view('js/restobar_map');
	elgg_register_js('elgg.restobar', $restobar_js);
        
        
        $restobar_edit_js = elgg_get_simplecache_url('js', 'restobar_edit');
	elgg_register_simplecache_view('js/restobar_edit');
	elgg_register_js('elgg.restobar_edit', $restobar_edit_js,'footer');

	// Access permissions
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'restobar_write_acl_plugin_hook');
	//elgg_register_plugin_hook_handler('access:collections:read', 'all', 'restobar_read_acl_plugin_hook');

	// Register profile menu hook
	//elgg_register_plugin_hook_handler('profile_menu', 'profile', 'forum_profile_menu');
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'restobar_activity_profile_menu');

	// allow ecml in news and profiles
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'restobar_ecml_views_hook');
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'restobarprofile_ecml_views_hook');

	// Register a handler for create restobar
	elgg_register_event_handler('create', 'group', 'restobar_create_event_listener');

	// Register a handler for delete restobar
	elgg_register_event_handler('delete', 'group', 'restobar_delete_event_listener');
	
	elgg_register_event_handler('join', 'group', 'restobar_user_join_event_listener');
	elgg_register_event_handler('leave', 'group', 'restobar_user_leave_event_listener');
	elgg_register_event_handler('pagesetup', 'system', 'restobar_setup_sidebar_menus');
	elgg_register_event_handler('annotate', 'all', 'restobar_object_notifications');

	elgg_register_plugin_hook_handler('access:collections:add_user', 'collection', 'restobar_access_collection_override');


	elgg_register_event_handler('upgrade', 'system', 'restobar_run_upgrades');
}

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function restobar_fields_setup() {

	$profile_defaults = array(
                'briefdescription' => 'text',
		'description' => 'longtext',    //description de l'activité
                'location'=>'url',              //adresse de l'établissement lien google map
		'website' =>'url',             //lien vers le website de l'établissement
 
	);
        
    
        

	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'group', NULL, $profile_defaults);

	elgg_set_config('restobar', $profile_defaults);
    

	// register any tag metadata names
	foreach ($profile_defaults as $name => $type) {
		if ($type == 'tags') {
			elgg_register_tag_metadata_name($name);

			// only shows up in search but why not just set this in en.php as doing it here
			// means you cannot override it in a plugin
			add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("restobar:$name")));
		}
	}
}

/**
 * Configure the restobar sidebar menu. Triggered on page setup
 *
 */
function restobar_setup_sidebar_menus() {

	// Get the page owner entity
	$page_owner = elgg_get_page_owner_entity();
        $context=elgg_get_context();
	if (elgg_get_context() == 'restobar' && elgg_is_logged_in()) {
		/*if ( elgg_instanceof($page_owner,'group','restobar','ElggRestobar')) {
			if (elgg_is_logged_in() && $page_owner->canEdit() && !$page_owner->isPublicMembership()) {
				$url = elgg_get_site_url() . "restobar/requests/{$page_owner->getGUID()}";
				elgg_register_menu_item('page', array(
					'name' => 'membership_requests',
					'text' => elgg_echo('restobar:membershiprequests'),
					'href' => $url,
				));
			}
		} else {*/
			elgg_register_menu_item('page', array(
				'name' => 'restobar:all',
				'text' => elgg_echo('restobar:all'),
				'href' => 'restobar/all',
			));

			$user = elgg_get_logged_in_user_entity();
			if ($user->pro=='yes' || $user->isAdmin() ) {
				/*$url =  "restobar/owner/$user->username";
				$item = new ElggMenuItem('restobar:owned', elgg_echo('restobar:owned'), $url);
				elgg_register_menu_item('page', $item);*/
				$url = "restobar/member/$user->username";
				$item = new ElggMenuItem('restobar:member', elgg_echo('restobar:yours'), $url);
				elgg_register_menu_item('page', $item);
				/*$url = "restobar/invitations/$user->username";
				$item = new ElggMenuItem('restobar:user:invites', elgg_echo('restobar:invitations'), $url);
				elgg_register_menu_item('page', $item);*/
			
                                
                                if ($user && $user->canWriteToContainer()) {
                                $guid = $user->getGUID();
                                elgg_register_menu_item('page', array(
				'name' => 'add',
				'href' => "restobar/add/$guid",
				'text' => elgg_echo("restobar:add"),
				
			));
		}
                                
                        }
                        
		//}
            }
}

/**
 * restobar page handler
 *
 * URLs take the form of
 *  All restobar:           restobar/all
 *  User's owned restobar:  restobar/owner/<username>
 *  User's member restobar: restobar/member/<username>
 *  restobar profile:        restobar/profile/<guid>/<title>
 *  New restobar:            restobar/add/<guid>
 *  Edit restobar:           restobar/edit/<guid>
 *  restobar invitations:    restobar/invitations/<username>
 *  Invite to restobar:      restobar/invite/<guid>
 *  Membership requests:     restobar/requests/<guid>
 *  restobar activity:       restobar/activity/<guid>
 *  restobar members:        restobar/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function restobar_page_handler($page) {

	elgg_load_library('restobar');

	elgg_push_breadcrumb(elgg_echo('restobar'), "restobar/all");

	switch ($page[0]) {
		case 'all':
			restobar_handle_all_page();
			break;
		case 'search':
			restobar_search_page();
			break;
		case 'owner':
			restobar_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			restobar_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			restobar_handle_invitations_page();
			break;
		case 'add':
			restobar_handle_edit_page('add');
			break;
		case 'edit':
			restobar_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
			restobar_handle_profile_page($page[1],$page[3]);
			break;
		case 'activity':
			restobar_handle_activity_page($page[1]);
			break;
		case 'members':
			restobar_handle_members_page($page[1]);
			break;
		case 'invite':
			restobar_handle_invite_page($page[1]);
			break;
		case 'requests':
			restobar_handle_requests_page($page[1]);
			break;
                case 'cave':
                        restobar_handle_cave_page($page[1]);
			break;
                case 'addmember':
                        restobar_handle_addmember_page($page[1]);
			break;
                case 'map':
                    
                        $content = elgg_view('restobars/map',array());
                        $title=elgg_echo('restobar:map');
                        $params = array(
                            'content' => $content,
                            'title' => $title,
                            'filter' => '',
                        );
                        $body = elgg_view_layout('one_column', $params);
        
	//echo elgg_view_page($title, $body,'overlay');
                        echo elgg_view_page($title, $content,'overlay');
                        break;
		default:
			return false;
	}
	return true;
}

/**
 * Handle restobar icons.
 *
 * @param array $page
 * @return void
 */
function restobar_icon_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('restobar_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/restobars/icon.php");
	return true;
}

/**
 * Populates the ->getUrl() method for restobar objects
 *
 * @param ElggEntity $entity File entity
 * @return string File URL
 */
function restobar_url($entity) {
	$title = elgg_get_friendly_title($entity->name);

	return "restobar/profile/{$entity->guid}/$title";
}

/**
 * Override the default entity icon for restobar
 *
 * @return string Relative URL
 */
function restobar_icon_url_override($hook, $type, $returnvalue, $params) {
    /* @var ElggGroup $group */
    $restobar = $params['entity'];
    $size = $params['size'];
    if (elgg_instanceof($restobar, 'group', 'restobar')) {
        $icontime = $restobar->icontime;
        // handle missing metadata (pre 1.7 installations)
        if (null === $icontime) {
            $file = new ElggFile();
            $file->owner_guid = $restobar->owner_guid;
            $file->setFilename("restobars/" . $restobar->guid . "large.jpg");
            $icontime = $file->exists() ? time() : 0;
            create_metadata($restobar->guid, 'icontime', $icontime, 'integer', $restobar->owner_guid, ACCESS_PUBLIC);
        }
        if ($icontime) {
            // return thumbnail
            return "restobaricon/$restobar->guid/$size/$icontime.jpg";
        }

        return "mod/restobars/graphics/default{$size}.gif";
    }
}

 /* Add owner block link
 */
function restobar_activity_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'restobar')) {
		if ($params['entity']->activity_enable != "no") {
			$url = "restobar/activity/{$params['entity']->guid}";
			$item = new ElggMenuItem('activity', elgg_echo('restobar:activity'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add links/info to entity menu particular to restobar entities
 */
function restobar_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}

	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'restobar') {
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
		$mem = elgg_echo("restobar:open");
	} else {
		$mem = elgg_echo("restobar:closed");
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
	$members_string = elgg_echo('restobar:member');
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
			$url = "action/restobar/featured?restobar_guid={$entity->guid}&action_type=unfeature";
			$wording = elgg_echo("restobar:makeunfeatured");
		} else {
			$url = "action/restobar/featured?restobar_guid={$entity->guid}&action_type=feature";
			$wording = elgg_echo("restobar:makefeatured");
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

/**
 * Add a remove user link to user hover menu when the page owner is a restobar
 */
function restobar_user_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$restobar = elgg_get_page_owner_entity();
		
		// Check for valid restobar
		if (!elgg_instanceof($restobar, 'group','restobar','ElggRestobar')) {
			return $return;
		}
	
		$entity = $params['entity'];
		
		// Make sure we have a user and that user is a member of the restobar
		if (!elgg_instanceof($entity, 'user') || !$restobar->isMember($entity)) {
			return $return;
		}

		// Add remove link if we can edit the restobar, and if we're not trying to remove the restobar owner
		if ($restobar->canEdit() && $restobar->getOwnerGUID() != $entity->guid) {
			$remove = elgg_view('output/confirmlink', array(
				'href' => "action/restobars/remove?user_guid={$entity->guid}&restobar_guid={$restobar->guid}",
				'text' => elgg_echo('restobar:removeuser'),
			));

			$options = array(
				'name' => 'removeuser',
				'text' => $remove,
				'priority' => 999,
			);
			$return[] = ElggMenuItem::factory($options);
		} 
	}

	return $return;
}

/**
 * Add edit and delete links for forum replies
 */
function restobar_annotation_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
	
	$annotation = $params['annotation'];

	if ($annotation->name != 'restobar_topic_post') {
		return $return;
	}

	if ($annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/restobar_news/reply/delete', array(
			'annotation_id' => $annotation->id,
		));

		$options = array(
			'name' => 'delete',
			'href' => $url,
			'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
			'confirm' => elgg_echo('deleteconfirm'),
			'encode_text' => false
		);
		$return[] = ElggMenuItem::factory($options);

		$url = elgg_http_add_url_query_elements('restobar_news', array(
			'annotation_id' => $annotation->id,
		));

		$options = array(
			'name' => 'edit',
			'href' => "#edit-annotation-$annotation->id",
			'text' => elgg_echo('edit'),
			'encode_text' => false,
			'rel' => 'toggle',
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

/**
 * restobar created so create an access list for it
 */
function restobar_create_event_listener($event, $object_type, $object) {
    
    if (elgg_instanceof($object, 'group','restobar' )){
	$ac_name = elgg_echo('restobar:restobar') . ": " . $object->name;
	$restobar_id = create_access_collection($ac_name, $object->guid);
	if ($restobar_id) {
		$object->group_acl = $restobar_id;
	} else {
		// delete restobar if access creation fails
		return false;
	}
    }
	return true;
}

/**
 * Hook to listen to read access control requests and return all the restobar you are a member of.
 */
function restobar_read_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	//error_log("READ: " . var_export($returnvalue));
	$user = elgg_get_logged_in_user_entity();
	if ($user) {
		// Not using this because of recursion.
		// Joining a restobar automatically add user to ACL,
		// So just see if they're a member of the ACL.
		//$membership = get_users_membership($user->guid);

		$members = get_members_of_access_collection($restobar->group_acl);
		print_r($members);
		exit;

		if ($membership) {
			foreach ($membership as $restobar)
				$returnvalue[$user->guid][$restobar->group_acl] = elgg_echo('restobar:restobar') . ": " . $restobar->name;
			return $returnvalue;
		}
	}
}

/**
 * Return the write access for the current restobar if the user has write access to it.
 */
function restobar_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$page_owner = elgg_get_page_owner_entity();
	$user_guid = $params['user_id'];
	$user = get_entity($user_guid);
	if (!$user) {
		return $returnvalue;
	}

	// only insert restobar access for current restobar
	if (elgg_instanceof($page_owner, 'group')) {
		if (($page_owner->canWriteToContainer($user_guid)) && (elgg_instanceof($page_owner, 'group', 'restobar'))) {
			$returnvalue[$page_owner->group_acl] = elgg_echo('restobar:restobar') . ': ' . $page_owner->name;

			unset($returnvalue[ACCESS_FRIENDS]);
		}
	} else {
		// if the user owns the restobar, remove all access collections manually
		// this won't be a problem once the restobar itself owns the acl.
		$restobar = elgg_get_entities_from_relationship(array(
					'relationship' => 'member',
					'relationship_guid' => $user_guid,
					'inverse_relationship' => FALSE,
					'limit' => 999
				));

		if ($restobar) {
			foreach ($restobar as $bar) {
				unset($returnvalue[$bar->group_acl]);
			}
		}
	}

	return $returnvalue;
}

/**
 * restobar deleted, so remove access lists.
 */
function restobar_delete_event_listener($event, $object_type, $object) {
	if (elgg_instanceof($object, 'group','restobar'))
         delete_access_collection($object->group_acl);

	return true;
}

/**
 * Listens to a restobar join event and adds a user to the restobar's access control
 *
 */
function restobar_user_join_event_listener($event, $object_type, $object) {

	$restobar = $object['group'];
	$user = $object['user'];
	$acl = $restobar->group_acl;
        if (elgg_instanceof($restobar, 'group','restobar'))
	 add_user_to_access_collection($user->guid, $acl);

	return true;
}

/**
 * Make sure users are added to the access collection
 */
function restobar_access_collection_override($hook, $entity_type, $returnvalue, $params) {
	if (isset($params['collection'])) {
		if (elgg_instanceof(get_entity($params['collection']->owner_guid), 'group','restobar')) {
			return true;
		}
	}
}

/**
 * Listens to a restobar leave event and removes a user from the restobar's access control
 *
 */
function restobar_user_leave_event_listener($event, $object_type, $object) {

	$restobar = $object['group'];
	$user = $object['user'];
	$acl = $restobar->group_acl;
        if (elgg_instanceof($restobar, 'group','restobar'))
	 remove_user_from_access_collection($user->guid, $acl);

	return true;
}

/**
 * Grabs restobar by invitations
 * Have to override all access until there's a way override access to getter functions.
 *
 * @param int  $user_guid    The user's guid
 * @param bool $return_guids Return guids rather than ElggGroup objects
 *
 * @return array ElggRestobar or guids depending on $return_guids
 */
function restobar_get_invited_restobar($user_guid, $return_guids = FALSE) {
	$ia = elgg_set_ignore_access(TRUE);
	$restobar = elgg_get_entities_from_relationship(array(
		'relationship' => 'invited',
		'relationship_guid' => $user_guid,
		'inverse_relationship' => TRUE,
		'limit' => 0,
	));
	elgg_set_ignore_access($ia);

	if ($return_guids) {
		$guids = array();
		foreach ($restobar as $bar) {
			$guids[] = $bar->getGUID();
		}

		return $guids;
	}

	return $restobar;
}

/**
 * Join a user to a restobar, add river event, clean-up invitations
 *
 * @param ElggRestobar $restobar
 * @param ElggUser  $user
 * @return bool
 */
function restobars_join_restobar($restobar, $user) {

	// access ignore so user can be added to access collection of invisible restobar
	$ia = elgg_set_ignore_access(TRUE);
	$result = $restobar->join($user);
	elgg_set_ignore_access($ia);
	
	if ($result) {
		// flush user's access info so the collection is added
		get_access_list($user->guid, 0, true);

		// Remove any invite or join request flags
		remove_entity_relationship($restobar->guid, 'invited', $user->guid);
		remove_entity_relationship($user->guid, 'membership_request', $restobar->guid);

		//add_to_river('river/relationship/member/create', 'join', $user->guid, $restobar->guid);

		return true;
	}

	return false;
}

/**
 * Function to use on restobar for access. It will house private, loggedin, public,
 * and the restobar itself. This is when you don't want other restobar or access lists
 * in the access options available.
 *
 * @return array
 */
function restobar_access_options($restobar) {
  if (elgg_instanceof($restobar, 'group', 'resobar')){	
        $access_array = array(
		ACCESS_PRIVATE => 'private',
		ACCESS_LOGGED_IN => 'logged in users',
		ACCESS_PUBLIC => 'public',
		$restobar->group_acl => elgg_echo('restobar:acl', array($restobar->name)),
	);
	return $access_array;
    }
}
function restobar_activity_profile_menu($hook, $entity_type, $return_value, $params) {
 
	if ($params['owner'] instanceof ElggGroup) {
		$return_value[] = array(
			'text' => elgg_echo('Activity'),
			'href' => "restobar/activity/{$params['owner']->getGUID()}"
		);
	}
	return $return_value;
}

/**
 * Parse ECML on group news views
 */
function restobar_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['forum/viewposts'] = elgg_echo('restobar:ecml:news');

	return $return_value;
}

/**
 * Parse ECML on restobar profiles
 */
function restobarprofile_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['restobar/restobarprofile'] = elgg_echo('restobar:ecml:restobarprofile');

	return $return_value;
}



/**
 * News
 *
 */

elgg_register_event_handler('init', 'system', 'restobar_news_init');

/**
 * Initialize the News component
 */
function restobar_news_init() {

	elgg_register_library('elgg:restobar_news', elgg_get_plugins_path() . 'restobars/lib/restobar_news.php');

	elgg_register_page_handler('restobar_news', 'restobar_news_page_handler');

	elgg_register_entity_url_handler('object', 'restobarnews', 'restobar_news_override_url');

	// commenting not allowed on News topics (use a different annotation)
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', 'restobar_news_comment_override');
	
	$action_base = elgg_get_plugins_path() . 'restobars/actions/restobar_news';
	elgg_register_action('restobar_news/save', "$action_base/save.php");
	elgg_register_action('restobar_news/edit', "$action_base/edit.php");
	

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'restobar_news_owner_block_menu');

	// Register for search.
	elgg_register_entity_type('object', 'restobarnews');
        add_subtype('object', 'restobarnews', 'ElggRestobarnews');

	// because replies are not comments, need of our menu item
	//elgg_register_plugin_hook_handler('register', 'menu:river', 'restobar_news_add_to_river_menu');

	// add the forum tool option
	//add_group_tool_option('forum', elgg_echo('restobar:enableforum'), true);
	elgg_extend_view('restobars/tool_latest', 'restobar_news/module');

	// notifications
	register_notification_object('object', 'restobarnews', elgg_echo('restobarnews:new'));
	elgg_register_plugin_hook_handler('object:notifications', 'object', 'restobar_object_notifications_intercept');
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'restobarnews_notify_message');
}

/**
 * news page handler
 *
 * URLs take the form of
 *  All topics in site:    news/all
 *  List topics in forum:  news/owner/<guid>
 *  View news topic: news/view/<guid>
 *  Add news topic:  news/add/<guid>
 *  Edit news topic: news/edit/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function restobar_news_page_handler($page) {

	elgg_load_library('elgg:restobar_news');

	elgg_push_breadcrumb(elgg_echo('news'), 'restobar_news/edit');

	switch ($page[0]) {
		
		case 'edit':
			restobar_news_handle_edit_page($page[1]);
			break;
		
		default:
			return false;
	}
	return true;
}

/**
 * Override the restobar_news topic url
 *
 * @param ElggObject $entity News topic
 * @return string
 */
function restobar_news_override_topic_url($entity) {
	return 'restobar_news/view/' . $entity->guid;
}

/**
 * We don't want people commenting on topics in the river
 */
function restobar_news_comment_override($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'object', 'restobarnews')) {
		return false;
	}
}



/**
 * Add the reply button for the river
 */
function restobar_news_add_to_river_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in() && !elgg_in_context('widgets')) {
		$item = $params['item'];
		$object = $item->getObjectEntity();
		if (elgg_instanceof($object, 'object', 'restobarnews')) {
			if ($item->annotation_id == 0) {
				$restobar = $object->getContainerEntity();
				if ($restobar && ($restobar->canWriteToContainer() || elgg_is_admin_logged_in())) {
					$options = array(
						'name' => 'reply',
						'href' => "#restobar-reply-$object->guid",
						'text' => elgg_view_icon('speech-bubble'),
						'title' => elgg_echo('reply:this'),
						'rel' => 'toggle',
						'priority' => 50,
					);
					$return[] = ElggMenuItem::factory($options);
				}
			}
		}
	}

	return $return;
}

/**
 * Event handler for restobar forum posts
 *
 */
function restobar_object_notifications($event, $object_type, $object) {

	static $flag;
	if (!isset($flag))
		$flag = 0;

	if (is_callable('object_notifications'))
		if ($object instanceof ElggObject) {
			if ($object->getSubtype() == '$restobarforumtopic') {
				//if ($object->countAnnotations('restobar_topic_post') > 0) {
				if ($flag == 0) {
					$flag = 1;
					object_notifications($event, $object_type, $object);
				}
				//}
			}
		}
}

/**
 * Intercepts the notification on restobar topic creation and prevents a notification from going out
 * (because one will be sent on the annotation)
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 * @return unknown
 */
function restobar_object_notifications_intercept($hook, $entity_type, $returnvalue, $params) {
	if (isset($params)) {
		if ($params['event'] == 'create' && $params['object'] instanceof ElggObject) {
			if ($params['object']->getSubtype() == 'restobarforumtopic') {
				return true;
			}
		}
	}
	return null;
}

/**
 * Returns a more meaningful message
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function restobarnews_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];
	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'restobarforumtopic')) {

		$descr = $entity->description;
		$title = $entity->title;
		$url = $entity->getURL();

		$msg = get_input('topicmessage');
		if (empty($msg))
			$msg = get_input('topic_post');
		if (!empty($msg))
			$msg = $msg . "\n\n"; else
			$msg = '';

		$owner = get_entity($entity->container_guid);
		if ($method == 'sms') {
			return elgg_echo("restobarforumtopic:new") . ': ' . $url . " ({$owner->name}: {$title})";
		} else {
			return elgg_get_logged_in_user_entity()->name . ' ' . elgg_echo("restobar:viarestobar") . ': ' . $title . "\n\n" . $msg . "\n\n" . $entity->getURL();
		}
	}
	return null;
}

/**
 * A simple function to see who can edit a restobar news post
 * @param the comment $entity
 * @param user who owns the restobar $restobar_owner
 * @return boolean
 */
function restobar_can_edit_news($entity, $restobar_owner) {

	//logged in user
	$user = elgg_get_logged_in_user_guid();

	if (($entity->owner_guid == $user) || $restobar_owner == $user || elgg_is_admin_logged_in()) {
		return true;
	} else {
		return false;
	}
}

/**
 * Process upgrades for the restobar plugin
 */
/*function restobar_run_upgrades() {
	$path = elgg_get_plugins_path() . 'restobars/upgrades/';
	$files = elgg_get_upgrade_files($path);
	foreach ($files as $file) {
		include "$path{$file}";
	}
}*/

function restobar_override_permissions($hook, $entity_type, $returnvalue, $params){
    $restobar=elgg_extract('entity', $params);
    $user=elgg_extract('user', $params);
    if ($restobar->getSubtype()== 'restobar'){
	if ($restobar->isMember($user)) {
			return true;
	}
    }
}

function restobar_user_hover_menu($hook, $type, $return, $params) {
	$user = $params['entity'];
        $login_user=  elgg_get_logged_in_user_entity();
        
	if (elgg_is_logged_in() && ($login_user->getGUID() != $user->getGUID()) && ($login_user->pro == "yes" )) {
	
            $options=array('type_subtype_pairs' => (array('group' => 'restobar')),'owner_guids'=>array($login_user->getGUID()));
                    $list_restobars= elgg_get_entities($options);
                    $list_empty=TRUE;
    
                    if (count($list_restobars) != 0){
                        foreach($list_restobars as $restobar){
                            if (!$restobar->isMember($user))
                                $list_empty=FALSE;
                                }
                    }
                                      
                if(!$list_empty){	          
                    $url = "restobar/addmember/{$user->getGUID()}";
                    $text= 'restobar:addmember';				
                    $menu_item=array('name' => 'addmember','text' => elgg_echo($text,array("{$user->name}")),'href' => $url,'link_class' => 'elgg-overlay');
                    $item = ElggMenuItem::factory($menu_item);
                    $item->setSection('action');
                    $return[] = $item;
                
                }
	}

	return $return;
}
