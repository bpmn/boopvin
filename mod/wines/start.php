<?php
/**
 * Wines plugin
 *
 * @package Elggwine
 */

elgg_register_event_handler('init', 'system', 'wine_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'wine_fields_setup', 10000);

/**
 * Initialize the wine plugin.
 */
function wine_init() {

	elgg_register_library('wine', elgg_get_plugins_path() . 'wines/lib/wine.php');

	// register wine entities for search
	elgg_register_entity_type('group','wine');
        add_subtype('group', 'wine', 'ElggWine');

	// Set up the menu
	$item = new ElggMenuItem('wine', elgg_echo('wine'), 'wine/all');
	elgg_register_menu_item('site', $item);

	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('wine', 'wine_page_handler');

	// Register URL handlers for wine
	elgg_register_entity_url_handler('group', 'wine', 'wine_url');
	elgg_register_plugin_hook_handler('entity:icon:url', 'group', 'wine_icon_url_override');

	// Register an icon handler for wine
	elgg_register_page_handler('wineicon', 'wine_icon_handler');

	// Register some actions
	$action_base = elgg_get_plugins_path() . 'wines/actions/wine';
	elgg_register_action("wines/edit", "$action_base/edit.php");
	elgg_register_action("wines/delete", "$action_base/delete.php");
	elgg_register_action("wines/featured", "$action_base/featured.php", 'admin');
        
        $action_incave = $action_base.'/cave';
        elgg_register_action("wines/cave/addtocave", "$action_incave/addtocave.php");
        elgg_register_action("wines/cave/remove_cave", "$action_incave/remove.php");

	$action_base .= '/membership';
	elgg_register_action("wines/invite", "$action_base/invite.php");
	elgg_register_action("wines/join", "$action_base/join.php");
	elgg_register_action("wines/leave", "$action_base/leave.php");
	elgg_register_action("wines/remove", "$action_base/remove.php");
	elgg_register_action("wines/killrequest", "$action_base/delete_request.php");
	elgg_register_action("wines/killinvitation", "$action_base/delete_invite.php");
	elgg_register_action("wines/addtogroup", "$action_base/add.php");

	// Add some widgets
	elgg_register_widget_type('a_users_wines', elgg_echo('wine:widget:membership'), elgg_echo('wine:widgets:description'));

	// add group activity tool option
	//add_group_tool_option('activity', elgg_echo('wine:enableactivity'), true);
	//elgg_extend_view('wines/tool_latest', 'wines/profile/activity_module');

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'wine_activity_owner_block_menu');

	// group entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'wine_entity_menu_setup');
	
	// group user hover menu	
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'wine_user_entity_menu_setup');

	// delete and edit annotations for topic replies
	elgg_register_plugin_hook_handler('register', 'menu:annotation', 'wine_annotation_menu_setup');

	
	//elgg_extend_view('js/elgg', 'js/wine_map');
        
        elgg_register_ajax_view('wines/ajax/dist_restobar');
        
        // register the restobar's JavaScript
	$wine_map_js = elgg_get_simplecache_url('js', 'wine_map');
	elgg_register_simplecache_view('js/wine_map');
	elgg_register_js('elgg.wine', $wine_map_js,'footer');
        
        $wine_edit_js = elgg_get_simplecache_url('js', 'wine_edit');
	elgg_register_simplecache_view('js/wine_edit');
	elgg_register_js('elgg.wine_edit', $wine_edit_js,'footer');

        
        
        
        
	// Access permissions
        elgg_register_plugin_hook_handler('permissions_check', 'group', 'wine_override_permissions');
        elgg_register_plugin_hook_handler('container_permissions_check', 'group', 'wine_override_container_permissions');
        
	elgg_register_plugin_hook_handler('access:collections:write', 'all', 'wine_write_acl_plugin_hook');
	//elgg_register_plugin_hook_handler('access:collections:read', 'all', 'wine_read_acl_plugin_hook');

	// Register profile menu hook
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'forum_profile_menu');
	elgg_register_plugin_hook_handler('profile_menu', 'profile', 'wine_activity_profile_menu');

	// allow ecml in discussion and profiles
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'wine_ecml_views_hook');
	elgg_register_plugin_hook_handler('get_views', 'ecml', 'wineprofile_ecml_views_hook');

	// Register a handler for create wine
	elgg_register_event_handler('create', 'group', 'wine_create_event_listener');

	// Register a handler for delete wine
	elgg_register_event_handler('delete', 'group', 'wine_delete_event_listener');
	
	elgg_register_event_handler('join', 'group', 'wine_user_join_event_listener');
	elgg_register_event_handler('leave', 'group', 'wine_user_leave_event_listener');
	//elgg_register_event_handler('pagesetup', 'system', 'wine_setup_sidebar_menus');
	//elgg_register_event_handler('annotate', 'all', 'wine_object_notifications');

	elgg_register_plugin_hook_handler('access:collections:add_user', 'collection', 'wine_access_collection_override');

	elgg_register_event_handler('upgrade', 'system', 'wine_run_upgrades');
}

/**
 * This function loads a set of default fields into the profile, then triggers
 * a hook letting other plugins to edit add and delete fields.
 *
 * Note: This is a system:init event triggered function and is run at a super
 * low priority to guarantee that it is called after all other plugins have
 * initialized.
 */
function wine_fields_setup() {

	$profile_defaults = array(
            
                'country'=>'dropdown',      //pays
		'appellation' => 'text',    //appellation
		'region' => 'text',         //région
                'cuvee'=>'text',            //cuvée
		'grapes' => 'text',         //cépage
                'maker'=>'text',            //vigneron
                'kind'=>'dropdown',         //style de vin blanc, rouge, moelleux
                'soil'=>'text',             //sol
           //     'dosage'=>'text',           //dosage pour champagne
                'info'=>'longtext',         //info complémentaires
		//'website' => 'url',
 
	);
        
        $profile_defaults_display = array(
                'cuvee'=>'text',            //cuvée
                'appellation' => 'text',    //appellation
                'region' => 'text',         //région
                'country'=>'dropdown',      //pays
		'grapes' => 'text',         //cépage
                'maker'=>'text',            //vigneron
                'kind'=>'dropdown',         //style de vin blanc, rouge, moelleux
                'soil'=>'text',             //sol
         //       'dosage'=>'text',           //dosage pour champagne
                'info'=>'longtext',         //info complémentaires
		//'website' => 'url',
 
	);
        
        

	$profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'group', NULL, $profile_defaults);

	elgg_set_config('wine', $profile_defaults);
        elgg_set_config('wine_display', $profile_defaults_display);

	// register any tag metadata names
	foreach ($profile_defaults as $name => $type) {
		if ($type == 'tags') {
			elgg_register_tag_metadata_name($name);

			// only shows up in search but why not just set this in en.php as doing it here
			// means you cannot override it in a plugin
			add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("wine:$name")));
		}
	}
}

/**
 * Configure the wine sidebar menu. Triggered on page setup
 *
 */
function wine_setup_sidebar_menus() {

	// Get the page owner entity
	$page_owner = elgg_get_page_owner_entity();
        $context=elgg_get_context();
	if (elgg_get_context() == 'wine') {
		if ($page_owner instanceof ElggGroup) {
			if (elgg_is_logged_in() && $page_owner->canEdit() && !$page_owner->isPublicMembership()) {
				$url = elgg_get_site_url() . "wine/requests/{$page_owner->getGUID()}";
				elgg_register_menu_item('page', array(
					'name' => 'membership_requests',
					'text' => elgg_echo('wine:membershiprequests'),
					'href' => $url,
				));
			}
		} else {
			elgg_register_menu_item('page', array(
				'name' => 'wine:all',
				'text' => elgg_echo('wine:all'),
				'href' => 'wine/all',
			));

			$user = elgg_get_logged_in_user_entity();
			if ($user) {
				$url =  "wine/owner/$user->username";
				$item = new ElggMenuItem('wine:owned', elgg_echo('wine:owned'), $url);
				elgg_register_menu_item('page', $item);
				$url = "wine/member/$user->username";
				$item = new ElggMenuItem('wine:member', elgg_echo('wine:yours'), $url);
				elgg_register_menu_item('page', $item);
				$url = "wine/invitations/$user->username";
				$item = new ElggMenuItem('wine:user:invites', elgg_echo('wine:invitations'), $url);
				elgg_register_menu_item('page', $item);
			}
		}
	}
}

/**
 * Wine page handler
 *
 * URLs take the form of
 *  All wine:           wine/all
 *  User's owned wine:  wine/owner/<username>
 *  User's member wine: wine/member/<username>
 *  wine profile:        wine/profile/<guid>/<title>
 *  New wine:            wine/add/<guid>
 *  Edit wine:           wine/edit/<guid>
 *  wine invitations:    wine/invitations/<username>
 *  Invite to wine:      wine/invite/<guid>
 *  Membership requests:  wine/requests/<guid>
 *  wine activity:       wine/activity/<guid>
 *  wine members:        wine/members/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function wine_page_handler($page) {

	elgg_load_library('wine');

	elgg_push_breadcrumb(elgg_echo('wine'), "wine/all");

	switch ($page[0]) {
		case 'all':
			wine_handle_all_page();
			break;
		case 'search':
			wine_search_page();
			break;
		case 'owner':
			wine_handle_owned_page();
			break;
		case 'member':
			set_input('username', $page[1]);
			wine_handle_mine_page();
			break;
		case 'invitations':
			set_input('username', $page[1]);
			wine_handle_invitations_page();
			break;
		case 'add':
			wine_handle_edit_page('add');
			break;
		case 'edit':
			wine_handle_edit_page('edit', $page[1]);
			break;
		case 'profile':
                        elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'addtocave_owner_block_menu');
			wine_handle_profile_page($page[1],$page[3]);
			break;
		case 'activity': 
			wine_handle_activity_page($page[1]);
			break;
		case 'members':
			wine_handle_members_page($page[1]);
			break;
		case 'invite':
			wine_handle_invite_page($page[1]);
			break;
		case 'requests':
			wine_handle_requests_page($page[1]);
			break;
                case 'addtocave':
			wine_handle_addtocave_page($page[1]);
			break;        
		default:
			return false;
	}
	return true;
}

/**
 * Handle wine icons.
 *
 * @param array $page
 * @return void
 */
function wine_icon_handler($page) {

	// The username should be the file we're getting
	if (isset($page[0])) {
		set_input('wine_guid', $page[0]);
	}
	if (isset($page[1])) {
		set_input('size', $page[1]);
	}
	// Include the standard profile index
	$plugin_dir = elgg_get_plugins_path();
	include("$plugin_dir/wines/icon.php");
	return true;
}

/**
 * Populates the ->getUrl() method for wine objects
 *
 * @param ElggEntity $entity File entity
 * @return string File URL
 */
function wine_url($entity) {
	$title = elgg_get_friendly_title($entity->name);

	return "wine/profile/{$entity->guid}/$title";
}

/**
 * Override the default entity icon for wine
 *
 * @return string Relative URL
 */
function wine_icon_url_override($hook, $type, $returnvalue, $params) {
/* @var ElggGroup $group */
	$wine = $params['entity'];
	$size = $params['size'];
        if (elgg_instanceof ($wine,'group','wine')) {
            $icontime = $wine->icontime;
            // handle missing metadata (pre 1.7 installations)
            if (null === $icontime) {
                    $file = new ElggFile();
                    $file->owner_guid = $wine->owner_guid;
                    $file->setFilename("wines/" . $wine->guid . "large.jpg");
                    $icontime = $file->exists() ? time() : 0;
                    create_metadata($wine->guid, 'icontime', $icontime, 'integer', $wine->owner_guid, ACCESS_PUBLIC);
            }
            if ($icontime) {
                    // return thumbnail
                	return "wineicon/$wine->guid/$size/$icontime.jpg";
            }

            return "mod/wines/graphics/default{$size}.gif";
        }
}

/**
 * Add owner block link
 */
function wine_activity_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'wine')) {
		if ($params['entity']->activity_enable != "no") {
			$url = "wine/activity/{$params['entity']->guid}";
			$item = new ElggMenuItem('activity', elgg_echo('wine:activity'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Add links/info to entity menu particular to wine entities
 */
function wine_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
        
        $page_owner=  elgg_get_page_owner_entity();
        
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'wine') {
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
	}*/
       if (elgg_in_context('restobar')&& $page_owner->canEdit()) {

        // delete link
		$options = array(
			'name' => 'removecave',
			'text' => elgg_view_icon('delete'),
			'title' => elgg_echo('removecave:this'),
			'href' => "action/wines/cave/remove_cave?wine_guid={$entity->getGUID()}&restobar_guid={$page_owner->getGUID()}",
			'confirm' => elgg_echo('removecaveconfirm'),
			'priority' => 300,
		);
		$return[] = ElggMenuItem::factory($options);
                
                }
                
        if (elgg_in_context('my_wine')) {
                
                $user_guid=  elgg_get_logged_in_user_guid();
        // delete link
		$options = array(
			'name' => 'removewine',
			'text' => elgg_view_icon('delete'),
			'title' => elgg_echo('removewine:this'),
			'href' => "action/wines/leave?wine_guid={$entity->getGUID()}&user_guid={$user_guid}",
			'confirm' => elgg_echo('removewineconfirm'),
			'priority' => 300,
		);
		$return[] = ElggMenuItem::factory($options);
                
                }
                
	return $return;
}

/**
 * Add a remove user link to user hover menu when the page owner is a wine
 */
function wine_user_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_is_logged_in()) {
		$wine = elgg_get_page_owner_entity();
		
		// Check for valid wine
		if (!elgg_instanceof($wine, 'group','wine')) {
			return $return;
		}
	
		$entity = $params['entity'];
		
		// Make sure we have a user and that user is a member of the wine
		if (!elgg_instanceof($entity, 'user') || !$wine->isMember($entity)) {
			return $return;
		}

                $loggedin_user= elgg_get_logged_in_user_entity();
		// Add remove link if we are an admin
		if ($loggedin_user->isAdmin()) {
			$remove = elgg_view('output/confirmlink', array(
				'href' => "action/wines/remove?user_guid={$entity->guid}&wine_guid={$wine->guid}",
				'text' => elgg_echo('wine:removeuser'),
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
function wine_annotation_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
	
	$annotation = $params['annotation'];

	if ($annotation->name != 'wine_topic_post') {
		return $return;
	}

	if ($annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/wine_discussion/reply/delete', array(
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

		$url = elgg_http_add_url_query_elements('wine_discussion', array(
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
 * wine created so create an access list for it
 */
function wine_create_event_listener($event, $object_type, $object) {
        
        if (elgg_instanceof($object, 'group','wine' )){
            $ac_name = elgg_echo('wine:wine') . ": " . $object->name;
            $wine_id = create_access_collection($ac_name, $object->guid);
            if ($wine_id) {
		$object->group_acl = $wine_id;
            } else {
		// delete wine if access creation fails
		return false;
            }
        }
	return true;
}

/**
 * Hook to listen to read access control requests and return all the wine you are a member of.
 */
function wine_read_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	//error_log("READ: " . var_export($returnvalue));
	$user = elgg_get_logged_in_user_entity();
	if ($user) {
		// Not using this because of recursion.
		// Joining a wine automatically add user to ACL,
		// So just see if they're a member of the ACL.
		//$membership = get_users_membership($user->guid);

		$members = get_members_of_access_collection($wine->group_acl);
		print_r($members);
		exit;

		if ($membership) {
			foreach ($membership as $wine)
				$returnvalue[$user->guid][$wine->group_acl] = elgg_echo('wine:wine') . ": " . $wine->name;
			return $returnvalue;
		}
	}
}

/**
 * Return the write access for the current wine if the user has write access to it.
 */
function wine_write_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$page_owner = elgg_get_page_owner_entity();
	$user_guid = $params['user_id'];
	$user = get_entity($user_guid);
	if (!$user) {
		return $returnvalue;
	}

	// only insert wine access for current wine
	if (elgg_instanceof($page_owner, 'group')) {
		if ($page_owner->canWriteToContainer($user_guid)&& elgg_instanceof($page_owner, 'group', 'wine')) {
			$returnvalue[$page_owner->group_acl] = elgg_echo('wine:wine') . ': ' . $page_owner->name;

			unset($returnvalue[ACCESS_FRIENDS]);
		}
	} else {
		// if the user owns the wine, remove all access collections manually
		// this won't be a problem once the wine itself owns the acl.
		$wine = elgg_get_entities_from_relationship(array(
					'relationship' => 'member',
					'relationship_guid' => $user_guid,
					'inverse_relationship' => FALSE,
					'limit' => 999
				));

		if ($wine) {
			foreach ($wine as $vin) {
				unset($returnvalue[$vin->group_acl]);
			}
		}
	}

	return $returnvalue;
}

/**
 * wine deleted, so remove access lists.
 */
function wine_delete_event_listener($event, $object_type, $object) {
	if (elgg_instanceof($wine, 'group','wine'))
            delete_access_collection($object->group_acl);

	return true;
}

/**
 * Listens to a wine join event and adds a user to the wine's access control
 *
 */
function wine_user_join_event_listener($event, $object_type, $object) {

	$wine = $object['group'];
	$user = $object['user'];
	$acl = $wine->group_acl;
        
        if (elgg_instanceof($wine, 'group','wine'))
	 add_user_to_access_collection($user->guid, $acl);
         //add_entity_relationship($user->guid, 'notify'.'email', $wine->getGuid());
         add_entity_relationship($user->guid, 'notify'.'notifier', $wine->getGuid());
	return true;
}

/**
 * Make sure users are added to the access collection
 */
function wine_access_collection_override($hook, $entity_type, $returnvalue, $params) {
	if (isset($params['collection'])) {
		if (elgg_instanceof(get_entity($params['collection']->owner_guid), 'group','wine')) {
			return true;
		}
	}
}

/**
 * Listens to a wine leave event and removes a user from the wine's access control
 *
 */
function wine_user_leave_event_listener($event, $object_type, $object) {

	$wine = $object['group'];
	$user = $object['user'];
	$acl = $wine->group_acl;
        if (elgg_instanceof($wine, 'group','wine'))
            remove_user_from_access_collection($user->guid, $acl);
            remove_entity_relationship($user->guid, 'notify'.'site',$wine->getGuid());
            remove_entity_relationship($user->guid, 'notify'.'email',$wine->getGuid());
	return true;
}

/**
 * Grabs wine by invitations
 * Have to override all access until there's a way override access to getter functions.
 *
 * @param int  $user_guid    The user's guid
 * @param bool $return_guids Return guids rather than ElggGroup objects
 *
 * @return array Elggwine or guids depending on $return_guids
 */
function wine_get_invited_wine($user_guid, $return_guids = FALSE) {
	$ia = elgg_set_ignore_access(TRUE);
	$wine = elgg_get_entities_from_relationship(array(
		'relationship' => 'invited',
		'relationship_guid' => $user_guid,
		'inverse_relationship' => TRUE,
		'limit' => 0,
	));
	elgg_set_ignore_access($ia);

	if ($return_guids) {
		$guids = array();
		foreach ($wine as $vin) {
			$guids[] = $vin->getGUID();
		}

		return $guids;
	}

	return $wine;
}

/**
 * Join a user to a wine, add river event, clean-up invitations
 *
 * @param ElggWine $wine
 * @param ElggUser  $user
 * @return bool
 */
function wines_join_wine($wine, $user) {

	// access ignore so user can be added to access collection of invisible wine
	$ia = elgg_set_ignore_access(TRUE);
	$result = $wine->join($user);
	elgg_set_ignore_access($ia);
	
	if ($result) {
		// flush user's access info so the collection is added
		get_access_list($user->guid, 0, true);

		// Remove any invite or join request flags
		remove_entity_relationship($wine->guid, 'invited', $user->guid);
		remove_entity_relationship($user->guid, 'membership_request', $wine->guid);

		//add_to_river('river/relationship/member/create', 'join', $user->guid, $wine->guid);

		return true;
	}

	return false;
}

/**
 * Function to use on wine for access. It will house private, loggedin, public,
 * and the wine itself. This is when you don't want other wine or access lists
 * in the access options available.
 *
 * @return array
 */
function wine_access_options($wine) {
    if (elgg_instanceof($wine, 'group', 'wine')){
	$access_array = array(
		ACCESS_PRIVATE => 'private',
		ACCESS_LOGGED_IN => 'logged in users',
		ACCESS_PUBLIC => 'public',
		$wine->group_acl => elgg_echo('wine:acl', array($wine->name)),
	);
        
        return $access_array;
    }
	
}

function wine_activity_profile_menu($hook, $entity_type, $return_value, $params) {

	if ($params['owner'] instanceof ElggGroup) {
		$return_value[] = array(
			'text' => elgg_echo('Activity'),
			'href' => "wine/activity/{$params['owner']->getGUID()}"
		);
	}
	return $return_value;
}

/**
 * Parse ECML on group discussion views
 */
function wine_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['forum/viewposts'] = elgg_echo('wine:ecml:discussion');

	return $return_value;
}

/**
 * Parse ECML on wine profiles
 */
function wineprofile_ecml_views_hook($hook, $entity_type, $return_value, $params) {
	$return_value['wine/wineprofile'] = elgg_echo('wine:ecml:wineprofile');

	return $return_value;
}



/**
 * Discussion
 *
 */

elgg_register_event_handler('init', 'system', 'wine_discussion_init');

/**
 * Initialize the discussion component
 */
function wine_discussion_init() {

	elgg_register_library('elgg:wine_discussion', elgg_get_plugins_path() . 'wines/lib/wine_discussion.php');

	elgg_register_page_handler('wine_discussion', 'wine_discussion_page_handler');

	elgg_register_entity_url_handler('object', 'wineforumtopic', 'wine_discussion_override_topic_url');

	// commenting not allowed on discussion topics (use a different annotation)
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', 'wine_discussion_comment_override');
	
	$action_base = elgg_get_plugins_path() . 'wines/actions/wine_discussion';
	elgg_register_action('wine_discussion/save', "$action_base/save.php");
	elgg_register_action('wine_discussion/delete', "$action_base/delete.php");
	elgg_register_action('wine_discussion/reply/save', "$action_base/reply/save.php");
	elgg_register_action('wine_discussion/reply/delete', "$action_base/reply/delete.php");

	// add link to owner block
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'wine_discussion_owner_block_menu');
        //elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'addtocave_owner_block_menu');

        	// Access permissions
        elgg_register_plugin_hook_handler('permissions_check', 'object', 'wineforumtopic_override_permissions');
        // winetopic entity menu
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'wineforumtopic_entity_menu_setup');
        
	// Register for search.
	elgg_register_entity_type('object', 'wineforumtopic');

	// because replies are not comments, need of our menu item
	//elgg_register_plugin_hook_handler('register', 'menu:river', 'wine_discussion_add_to_river_menu');

	// add the forum tool option
	//add_group_tool_option('forum', elgg_echo('wine:enableforum'), true);
	elgg_extend_view('wines/tool_latest', 'wine_discussion/module');

	
	// notifications
	register_notification_object('object', 'wineforumtopic', elgg_echo('discussion:notification:topic:subject'));
	elgg_register_plugin_hook_handler('object:notifications', 'object', 'wineforumtopic_notifications');
        //elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'wineforumtopic_notify_message');
	//elgg_register_event_handler('create', 'annotation', 'wine_discussion_reply_notifications');
	//elgg_register_plugin_hook_handler('notify:annotation:message', 'wine_topic_post', 'wine_discussion_create_reply_notification');
        
}

/**
 * Discussion page handler
 *
 * URLs take the form of
 *  All topics in site:    discussion/all
 *  List topics in forum:  discussion/owner/<guid>
 *  View discussion topic: discussion/view/<guid>
 *  Add discussion topic:  discussion/add/<guid>
 *  Edit discussion topic: discussion/edit/<guid>
 *
 * @param array $page Array of url segments for routing
 * @return bool
 */
function wine_discussion_page_handler($page) {

	elgg_load_library('elgg:wine_discussion');

	elgg_push_breadcrumb(elgg_echo('discussion'), 'wine_discussion/all');

	switch ($page[0]) {
		case 'all':
			wine_discussion_handle_all_page();
			break;
		case 'owner':
			wine_discussion_handle_list_page($page[1]);
			break;
		case 'add':
			wine_discussion_handle_edit_page('add', $page[1]);
			break;
		case 'edit':
			wine_discussion_handle_edit_page('edit', $page[1]);
			break;
		case 'view':
			wine_discussion_handle_view_page($page[1]);
			break;
		default:
			return false;
	}
	return true;
}

/**
 * Override the wine_discussion topic url
 *
 * @param ElggObject $entity Discussion topic
 * @return string
 */
function wine_discussion_override_topic_url($entity) {
	return 'wine_discussion/view/' . $entity->guid;
}

/**
 * We don't want people commenting on topics in the river
 */
function wine_discussion_comment_override($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'object', 'wineforumtopic')) {
		return false;
	}
}

/**
 * Add owner block link
 */
function wine_discussion_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'group','wine') && elgg_is_logged_in()) {
		if ($params['entity']->forum_enable != "no") {
			$url = "wine_discussion/owner/{$params['entity']->guid}";
			$item = new ElggMenuItem('wine_discussion', elgg_echo('discussion:wine'), $url);
			$return[] = $item;
		}
	}

	return $return;
}

function addtocave_owner_block_menu($hook, $type, $return, $params) {
        $user=  elgg_get_logged_in_user_entity();
        $context=elgg_get_context();
	if (elgg_instanceof($params['entity'], 'group','wine') ) {
		if ($user->pro != "no" && elgg_is_logged_in()) {
              
                    
			$url = "wine/addtocave/{$params['entity']->guid}";
                        $text= elgg_echo('wine:addtocave');				
			$menu_item=array('name' => $text,'text' => elgg_echo($text),'href' => $url,'link_class' => 'elgg-overlay');
			$item = ElggMenuItem::factory($menu_item);
                        $return[] = $item;}
		
	}

	return $return;
}

/**
 * Add the reply button for the river
 */
function wine_discussion_add_to_river_menu($hook, $type, $return, $params) {
	if (elgg_is_logged_in() && !elgg_in_context('widgets')) {
		$item = $params['item'];
		$object = $item->getObjectEntity();
		if (elgg_instanceof($object, 'object', 'wineforumtopic')) {
			if ($item->annotation_id == 0) {
				$wine = $object->getContainerEntity();
				if ($wine && ($wine->canWriteToContainer() || elgg_is_admin_logged_in())) {
					$options = array(
						'name' => 'reply',
						'href' => "#wine-reply-$object->guid",
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
 * Add links/info to entity menu particular to wine entities
 */
function wineforumtopic_entity_menu_setup($hook, $type, $return, $params) {
	if (elgg_in_context('widgets')) {
		return $return;
	}
        
        $page_owner=  elgg_get_page_owner_entity();
        
	$entity = $params['entity'];
	$handler = elgg_extract('handler', $params, false);
	if ($handler != 'wine_discussion') {
		return $return;
	}

	foreach ($return as $index => $item) {
		if (in_array($item->getName(), array('access', 'likes'))) {
			unset($return[$index]);
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
function wineforumtopic_notifications($event, $type, $return, $param) {
	
        global $CONFIG, $NOTIFICATION_HANDLERS;
        $topic=$param['object'];
        

	if ($topic->getSubtype() !== 'wineforumtopic') {
		return ;
	}

	// Have we registered notifications for this type of entity?
	$object_type = 'object';
	$object_subtype = 'wineforumtopic';

	

	$poster = $topic->getOwnerEntity();
	if (!$poster) {
		return $return;
	}

	if (isset($CONFIG->register_objects[$object_type][$object_subtype])) {
		$subject = $poster->name." ".$CONFIG->register_objects[$object_type][$object_subtype];
		$string = $subject . ": " . $topic->getURL();

		// Get users interested in content from this person and notify them
		// (Person defined by container_guid so we can also subscribe to groups if we want)
	// on adapte les notifications de degust qu'au notifier
        //foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
			/*$interested_users = elgg_get_entities_from_relationship(array(
				//'relationship' => 'notify' . $method,
                                'relationship' => 'notify' . 'notifier',
				'relationship_guid' => $degust->getOwnerGUID(),
				'inverse_relationship' => true,
				'types' => 'user',
				'limit' => 999999,
			));*/
                        
                        $interested_users = elgg_get_entities_from_relationship(array(
					'site_guids' => ELGG_ENTITIES_ANY_VALUE,
					'relationship' => 'notify' . 'notifier',					
                                        'relationship_guid' => $topic->container_guid,
  					'inverse_relationship' => TRUE,
					'types' => 'user',
					'limit' => 99999
				));
                        
                        
                       /*if ($interested_users_bis && is_array($interested_users_bis)) {
                           if ($interested_users && is_array($interested_users))
                               $interested_users=array_merge($interested_users,$interested_users_bis);
                           else {
                               $interested_users=$interested_users_bis;
                           }
                       }*/
                       

	if ($interested_users && is_array($interested_users)) {
					foreach ($interested_users as $user) {
						if ($user instanceof ElggUser && !$user->isBanned()) {
							if (($user->guid != elgg_get_logged_in_user_guid()) && has_access_to_entity($topic, $user)
							&& $topic->access_id != ACCESS_PRIVATE) {
								$body = elgg_trigger_plugin_hook('notify:entity:message', $topic->getType(), array(
									'entity' => $topic,
									'to_entity' => $user,
									'method' => 'notifier'), $string);
								if (empty($body) && $body !== false) {
									$body = $string;
								}
								if ($body !== false) {
									notify_user($user->guid, $topic->owner_guid, $subject, $body,
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





/**
 * Create winediscussion notification body
 *
 * @todo namespace method with 'discussion'
 *
 * @param string $hook
 * @param string $type
 * @param string $message
 * @param array  $params
 */
/*function wineforumtopic_notify_message($hook, $type, $message, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];

	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'wineforumtopic')) {
		$descr = $entity->description;
		$title = $entity->title;
		$url = $entity->getURL();
		$owner = $entity->getOwnerEntity();
		$group = $entity->getContainerEntity();

		return elgg_echo('wine:notification', array(
			$owner->name,
			$group->name,
			$entity->title,
			$entity->description,
			$entity->getURL()
		));
	}

	return null;
}*/

/**
 * Create discussion reply notification body
 *
 * @param string $hook
 * @param string $type
 * @param string $message
 * @param array  $params
 */
/*function wine_discussion_create_reply_notification($hook, $type, $message, $params) {
	$reply = $params['annotation'];
	$method = $params['method'];
	$topic = $reply->getEntity();
	$poster = $reply->getOwnerEntity();
	$group = $topic->getContainerEntity();

	return elgg_echo('discussion:notification:reply:body', array(
		$poster->name,
		$topic->title,
		$group->name,
		$reply->value,
		$topic->getURL(),
	));
}*/

/**
 * Catch reply to discussion topic and generate notifications
 *
 * @todo this will be replaced in Elgg 1.9 and is a clone of object_notifications()
 *
 * @param string         $event
 * @param string         $type
 * @param ElggAnnotation $annotation
 * @return void
 */
/*function wine_discussion_reply_notifications($event, $type, $annotation) {
	global $CONFIG, $NOTIFICATION_HANDLERS;

	if ($annotation->name !== 'wine_topic_post') {
		return;
	}

	// Have we registered notifications for this type of entity?
	$object_type = 'object';
	$object_subtype = 'wineforumtopic';

	$topic = $annotation->getEntity();
	if (!$topic) {
		return;
	}

	$poster = $annotation->getOwnerEntity();
	if (!$poster) {
		return;
	}

	if (isset($CONFIG->register_objects[$object_type][$object_subtype])) {
		$subject = $CONFIG->register_objects[$object_type][$object_subtype];
		$string = $subject . ": " . $topic->getURL();
                $subject =elgg_echo('discussion:notification:reply:subject',array($poster->name));
		// Get users interested in content from this person and notify them
		// (Person defined by container_guid so we can also subscribe to groups if we want)
		foreach ($NOTIFICATION_HANDLERS as $method => $foo) {
			$interested_users = elgg_get_entities_from_relationship(array(
				'relationship' => 'notify' . $method,
				'relationship_guid' => $topic->getContainerGUID(),
				'inverse_relationship' => true,
				'types' => 'user',
				'limit' => 0,
			));

			if ($interested_users && is_array($interested_users)) {
				foreach ($interested_users as $user) {
					if ($user instanceof ElggUser && !$user->isBanned()) {
						if (($user->guid != $poster->guid) && has_access_to_entity($topic, $user) && $topic->access_id != ACCESS_PRIVATE) {
							$body = elgg_trigger_plugin_hook('notify:annotation:message', $annotation->getSubtype(), array(
								'annotation' => $annotation,
								'to_entity' => $user,
								'method' => $method), $string);
							if (empty($body) && $body !== false) {
								$body = $string;
							}
							if ($body !== false) {
								notify_user($user->guid, $poster->guid, $subject, $body, null, array($method));
							}
						}
					}
				}
			}
		}
	}
}*/
/**
 * A simple function to see who can edit a wine discussion post
 * @param the comment $entity
 * @param user who owns the wine $wine_owner
 * @return boolean
 */
function wine_can_edit_discussion($entity, $wine_owner) {

	//logged in user
	$user = elgg_get_logged_in_user_guid();

	if (($entity->owner_guid == $user) || $wine_owner == $user || elgg_is_admin_logged_in()) {
		return true;
	} else {
		return false;
	}
}

/**
 * Process upgrades for the wine plugin
 */
function wine_run_upgrades() {
	$path = elgg_get_plugins_path() . 'wines/upgrades/';
	$files = elgg_get_upgrade_files($path);
	foreach ($files as $file) {
		include "$path{$file}";
	}
}


function wine_override_permissions($hook, $entity_type, $returnvalue, $params){
    $wine=elgg_extract('entity', $params);
    $user=elgg_extract('user', $params);
    if ($wine->getSubtype()== 'wine'){
            if($wine->isMember())
			return true;
            
            // test pour créer un vin éviter Fatal erreur owner = toujours admin et non login user
            if (elgg_get_context()=='create_wine')
                        return true;
	}

    }
    
    
    
function wine_override_container_permissions($hook, $entity_type, $returnvalue, $params){
            
            // test pour créer un vin éviter Fatal erreur owner = toujours admin et non login user
            if (elgg_get_context()=='create_wine')
                        return true;
	

    }
    
    
    
function wineforumtopic_override_permissions($hook, $entity_type, $returnvalue, $params){
    $wine_discussion=elgg_extract('entity', $params);
    $user=elgg_extract('user', $params);
    
    if ($wine_discussion->getSubtype()== 'wineforumtopic'){
            if(($wine_discussion->getOwnerGUID()== $user->getGUID()) || $user->isAdmin()){
                return true;
	}else{
                return false;
        }

    }
}