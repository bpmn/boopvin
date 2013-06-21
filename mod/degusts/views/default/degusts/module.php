<?php
/**
 * Latest forum posts
 *
 * @uses $vars['entity']
 */


$wine = $vars['entity'];


$all_link = elgg_view('output/url', array(
	'href' => "degust/wine/{$wine->getGUID()}/",
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'degust',
	'container_guid' => $wine->getGUID(),
	'limit' => 15,
	'full_view' => false,
	'pagination' => true,
        
);
$ia=elgg_set_ignore_access(true);
$content = "<div class=\"degust_list\">".elgg_list_entities($options)."</div>";
elgg_set_ignore_access($ia);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('degust:none') . '</p>';
}

/*$new_link = elgg_view('output/url', array(
	'href' => "wine_discussion/add/" . $wine->getGUID(),
	'text' => elgg_echo('wine:addtopic'),
	'is_trusted' => true,
));*/

echo elgg_view('wines/profile/module', array(
	'title' => elgg_echo('degust:wine'),
	'content' => $content,
	'all_link' => $all_link,
	//'add_link' => $new_link,
       
));