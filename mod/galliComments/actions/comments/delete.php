<?php
/**
 * Elgg delete comment action
 *
 * @package Elgg
 */

// Ensure we're logged in
if (!elgg_is_logged_in()) {
	forward();
}

// Make sure we can get the comment in question
$annotation_id = (int) get_input('annotation_id');
$comment = elgg_get_annotation_from_id($annotation_id);
if ($comment && $comment->canEdit()) {
	$comment->delete();
	//system_message(elgg_echo("generic_comment:deleted"));
} else {
	register_error(elgg_echo("generic_comment:notdeleted"));
}

$page_owner_guid=get_input('page_owner_guid');
// list the last comment
$options = array(
	'container_guid' => $page_owner_guid,
	'annotation_name' => 'generic_comment',
	'pagination' => false,
	'reverse_order_by' => false,
	'limit' => 1000
);
$content=elgg_list_annotations($options);
echo $content;

forward(REFERER);