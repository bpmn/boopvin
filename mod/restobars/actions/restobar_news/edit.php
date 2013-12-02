<?php
/**
 * Topic save action
 */

// Get variables


$desc=_elgg_html_decode(get_input("description"));

$guid = (int) get_input('restobarnews_guid');
$restobarnews=get_entity($guid);
$container=$restobarnews->getContainerEntity();
$container_guid=$container->getGUID();

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
//if ($new_topic) {
	//system_message(elgg_echo('discussion:topic:created'));
	//add_to_river('river/object/restobarforumtopic/create', 'create', elgg_get_logged_in_user_guid(), $topic->guid);
//} else {
//	system_message(elgg_echo('discussion:topic:updated'));
//}

add_to_river('river/object/restobarnews/create', 'update', $container_guid, $restobarnews->guid);
//system_message(elgg_echo('restobarnews:updated'));

// notifications

$contacts = elgg_get_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => $container_guid,
	'inverse_relationship' => true,
	'types' => 'user',
	'limit' => false,
	
));


if ($contacts) {
    foreach ($contacts as $contact) {
        notify_user($contact->getGUID(),$container_guid, elgg_echo('restobarnews:email:subject',array($container->name)), elgg_echo('restobarnews:email:body', array(
                    $container->name,
                    $container->getURL()
                ))
        );
    }
}



$content= elgg_view('output/longtext',array('value'=>$restobarnews->description));
echo $content;

forward($container->getURL());
