<?php
/**
 * Elgg groups invite form
 *
 * @package ElggGroups
 */

$restobar = $vars['entity'];
$owner = $restobar->getOwnerEntity();
$forward_url = $restobar->getURL();
$friends = elgg_get_logged_in_user_entity()->getFriends('', 0);

if ($friends) {
	echo elgg_view('input/friendspicker', array('entities' => $friends, 'name' => 'user_guid', 'highlight' => 'all'));
	echo '<div class="elgg-foot">';
	echo elgg_view('input/hidden', array('name' => 'forward_url', 'value' => $forward_url));
	echo elgg_view('input/hidden', array('name' => 'restobar_guid', 'value' => $restobar->guid));
	echo elgg_view('input/submit', array('value' => elgg_echo('invite')));
	echo '</div>';
} else {
	echo elgg_echo('restobar:nofriendsatall');
}