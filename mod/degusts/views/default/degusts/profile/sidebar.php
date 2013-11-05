<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*désactiver le tinymce pour les comments*/
elgg_unextend_view('input/longtext', 'tinymce/init');
elgg_unregister_plugin_hook_handler('register', 'menu:longtext', 'tinymce_longtext_menu');

$user=$vars['entity']->getOwnerEntity();
$degust=$vars['entity'];

$poster_icon = elgg_view_entity_icon($user, 'tiny');
$poster_link = elgg_view('output/url', array(
	'href' => $user->getURL(),
	'text' => $user->name,
	'is_trusted' => true,
));

$date = elgg_view_friendly_time($degust->time_updated);

echo elgg_echo('degust:post_wine', array($date,$poster_link)) ;

echo elgg_view_comments($degust);

?>
