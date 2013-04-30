<?php
/**
 * Elgg add comment action
 *
 * @package Elgg.Core
 * @subpackage Comments
 */

$entity_guid = (int) get_input('entity_guid');
$comment_text = get_input('generic_comment');

if (empty($comment_text)) {
	register_error(elgg_echo("generic_comment:blank"));
	forward(REFERER);
}

// Let's see if we can get an entity with the specified GUID
$entity = get_entity($entity_guid);
if (!$entity) {
	register_error(elgg_echo("generic_comment:notfound"));
	forward(REFERER);
}

$user = elgg_get_logged_in_user_entity();

$annotation = create_annotation($entity->guid,
								'generic_comment',
								$comment_text,
								"",
								$user->guid,
								$entity->access_id);

// tell user annotation posted
if (!$annotation) {
	register_error(elgg_echo("generic_comment:failure"));
	forward(REFERER);
}




// notify if poster wasn't owner
/*if ($entity->owner_guid != $user->guid) {

	notify_user($entity->owner_guid,
				$user->guid,
				elgg_echo('generic_comment:email:subject'),
				elgg_echo('generic_comment:email:body', array(
					$entity->title,
					$user->name,
					$comment_text,
					$entity->getURL(),
					$user->name,
					$user->getURL()
				))
			);
        //add_to_river('river/annotation/generic_comment/create','comment', $user->guid, $entity->guid, "", 0, $annotation);
}*/

// notifier les participants qui ont commenté la même dégustation

/*$comments = $entity->getAnnotations('generic_comment', 1000);
if ($comments) {
    $participants = array();
    foreach ($comments as $comment) {
        if (!in_array($comment->owner_guid, $participants) && ($comment->owner_guid != $entity->owner_guid ) && ($comment->owner_guid != $user->getGUID() )) {
            $participants[] = $comment->owner_guid;
        }
    }
    if ($participants) {
        foreach ($participants as $participant) {
            notify_user($participant, $user->guid, elgg_echo('generic_comment:email:subject'),
                        elgg_echo('generic_comment:email:body', array(
                        $entity->title,
                        $user->name,
                        $comment_text,
                        $entity->getURL(),
                        $user->name,
                        $user->getURL()
                    ))
            );
        }
    }
}*/

// list the last comment
$options = array(
	'guid' => $entity_guid,
	'annotation_name' => 'generic_comment',
	'pagination' => false,
	'reverse_order_by' => true,
	'limit' => 1
);
echo elgg_list_annotations($options);

system_message(elgg_echo("generic_comment:posted"));

//add to river


// Forward to the page the action occurred on
forward(REFERER);
