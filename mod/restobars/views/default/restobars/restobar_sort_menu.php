<?php
/**
 * All groups listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */

$tabs = array(
	'newest' => array(
		'text' => elgg_echo('restobar:newest'),
		'href' => 'restobar/all?filter=newest',
		'priority' => 200,
	),
	'popular' => array(
		'text' => elgg_echo('restobar:popular'),
		'href' => 'restobar/all?filter=popular',
		'priority' => 300,
	),
	'discussion' => array(
		'text' => elgg_echo('restobar:latestdiscussion'),
		'href' => 'restobar/all?filter=discussion',
		'priority' => 400,
	),
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
