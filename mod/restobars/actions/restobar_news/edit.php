<?php
/**
 * Topic save action
 */

// Get variables

$desc = get_input("description");
$guid = (int) get_input('restobarnews_guid');
$restobarnews=get_entity($guid);
$container=$restobarnews->getContainerEntity();

elgg_make_sticky_form('restobarnews');

// validation of inputs
if (!$desc) {
	register_error(elgg_echo('news:error:missing'));
	forward(REFERER);
}

if (!$container || !$container->canWriteToContainer(0, 'object', 'restobarnews')) {
	register_error(elgg_echo('news:error:permissions'));
	forward(REFERER);
}

$restobarnews->description=$desc;
$restobarnews->save();

// topic saved so clear sticky form
elgg_clear_sticky_form('restobarnews');


// handle results differently for new topics and topic edits
if ($new_topic) {
	system_message(elgg_echo('discussion:topic:created'));
	add_to_river('river/object/restobarforumtopic/create', 'create', elgg_get_logged_in_user_guid(), $topic->guid);
} else {
	system_message(elgg_echo('discussion:topic:updated'));
}

system_message(elgg_echo('restobarnews:updated'));

forward($container->getURL());
