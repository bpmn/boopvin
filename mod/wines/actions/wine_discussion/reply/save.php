<?php
/**
 * Post a reply to discussion topic
 *
 */

// Get input
$entity_guid = (int) get_input('entity_guid');
$text = get_input('wine_topic_post');
$annotation_id = (int) get_input('annotation_id');

// reply cannot be empty
if (empty($text)) {
	register_error(elgg_echo('winepost:nopost'));
	forward(REFERER);
}

$topic = get_entity($entity_guid);
if (!$topic) {
	register_error(elgg_echo('winepost:nopost'));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

$wine = $topic->getContainerEntity();
if (!$wine->canWriteToContainer()) {
	register_error(elgg_echo('wine:notmember'));
	forward(REFERER);
}

// if editing a reply, make sure it's valid
if ($annotation_id) {
	$annotation = elgg_get_annotation_from_id($annotation_id);
	if (!$annotation->canEdit()) {
		register_error(elgg_echo('wine:notowner'));
		forward(REFERER);
	}

	$annotation->value = $text;
	if (!$annotation->save()) {
		system_message(elgg_echo('wine:forumpost:error'));
		forward(REFERER);
	}
	system_message(elgg_echo('wine:forumpost:edited'));
} else {
	// add the reply to the forum topic
	$reply_id = $topic->annotate('wine_topic_post', $text, $topic->access_id, $user->guid);
	if ($reply_id == false) {
		system_message(elgg_echo('winespost:failure'));
		forward(REFERER);
	}

	add_to_river('river/annotation/wine_topic_post/reply', 'reply', $user->guid, $topic->guid, "", 0, $reply_id);
	system_message(elgg_echo('winepost:success'));
}

forward(REFERER);
