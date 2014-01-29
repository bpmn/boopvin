<?php
/**
 * Wine Discussion function library
 */

/**
 * List all discussion topics
 */
function wine_discussion_handle_all_page() {

	elgg_pop_breadcrumb();
	elgg_push_breadcrumb(elgg_echo('discussion'));

	$content = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'wineforumtopic',
		'order_by' => 'e.last_action desc',
		'limit' => 40,
		'full_view' => false,
	));

	$params = array(
		'content' => $content,
		'title' => elgg_echo('discussion:latest'),
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($title, $body);
}

/**
 * List discussion topics in a group
 *
 * @param int $guid Group entity GUID
 */
function wine_discussion_handle_list_page($guid) {

	elgg_set_page_owner_guid($guid);

	$wine = get_entity($guid);
        
        if (!elgg_instanceof($wine, 'group','wine')) {
		forward('', '404');
	}
	elgg_push_breadcrumb($wine->name);

	elgg_register_title_button();

	group_gatekeeper();

	$title = elgg_echo('item:object:wineforumtopic');
	
	$options = array(
		'type' => 'object',
		'subtype' => 'wineforumtopic',
		'limit' => 20,
		'order_by' => 'e.last_action desc',
		'container_guid' => $guid,
		'full_view' => false,
	);
	$content = elgg_list_entities($options);
	if (!$content) {
		$content = elgg_echo('discussion:none');
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
 * Edit or add a discussion topic
 *
 * @param string $type 'add' or 'edit'
 * @param int    $guid GUID of group or topic
 */
function wine_discussion_handle_edit_page($type, $guid) {
	gatekeeper();

	if ($type == 'add') {
		$wine = get_entity($guid);
		if (!$wine) {
			register_error(elgg_echo('wine:notfound'));
			forward();
		}

		// make sure user has permissions to add a topic to container
		if (!$wine->canWriteToContainer(0, 'object', 'wineforumtopic')) {
			register_error(elgg_echo('wine:permissions:error'));
			forward($wine->getURL());
		}

		$title = elgg_echo('wine:addtopic');

		elgg_push_breadcrumb($wine->name, "wine_discussion/owner/$wine->guid");
		elgg_push_breadcrumb($title);

		$body_vars = wine_discussion_prepare_form_vars();
		$content = elgg_view_form('wine_discussion/save', array(), $body_vars);
	} else {
		$topic = get_entity($guid);
		if (!$topic || !$topic->canEdit()) {
			register_error(elgg_echo('discussion:topic:notfound'));
			forward();
		}
		$wine = $topic->getContainerEntity();
		if (!$wine) {
			register_error(elgg_echo('wine:notfound'));
			forward();
		}

		$title = elgg_echo('wine:edittopic');

		elgg_push_breadcrumb($wine->name, "discussion/owner/$wine->guid");
		elgg_push_breadcrumb($topic->title, $topic->getURL());
		elgg_push_breadcrumb($title);

		$body_vars = wine_discussion_prepare_form_vars($topic);
                        
		$content = elgg_view_form('wine_discussion/save', array(), $body_vars);
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
 * View a discussion topic
 *
 * @param int $guid GUID of topic
 */
function wine_discussion_handle_view_page($guid) {
	// We now have RSS on topics
	global $autofeed;
	$autofeed = true;

	$topic = get_entity($guid);
		if (!$topic) {
		register_error(elgg_echo('noaccess'));
		$_SESSION['last_forward_from'] = current_page_url();
		forward('');
	}

	$group = $topic->getContainerEntity();
	if (!$group) {
		register_error(elgg_echo('wine:notfound'));
		forward();
	}

	elgg_set_page_owner_guid($group->getGUID());

	group_gatekeeper();

	elgg_push_breadcrumb($group->name, "wine_discussion/owner/$group->guid");
	elgg_push_breadcrumb($topic->title);

	$content = elgg_view_entity($topic, array('full_view' => true));
	if ($topic->status == 'closed') {
		$content .= elgg_view('wine_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => false,
		));
		$content .= elgg_view('wine_discussion/closed');
	} elseif ($group->canWriteToContainer(0, 'object', 'wineforumtopic') || elgg_is_admin_logged_in()) {
		$content .= elgg_view('wine_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => true,
		));
	} else {
		$content .= elgg_view('wine_discussion/replies', array(
			'entity' => $topic,
			'show_add_form' => false,
		));
	}

	$params = array(
		'content' => $content,
		'title' => $topic->title,
		'filter' => '',
	);
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($topic->title, $body);
}

/**
 * Prepare discussion topic form variables
 *
 * @param ElggObject $topic Topic object if editing
 * @return array
 */
function wine_discussion_prepare_form_vars($topic = NULL) {
	// input names => defaults
	$values = array(
		'title' => '',
		'description' => '',
		'status' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $topic,
	);

	if ($topic) {
		foreach (array_keys($values) as $field) {
			if (isset($topic->$field)) {
				$values[$field] = $topic->$field;
			}
		}
	}

	if (elgg_is_sticky_form('topic')) {
		$sticky_values = elgg_get_sticky_values('topic');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('topic');

	return $values;
}
