<?php
/**
 * All groups listing page navigation
 *
 * @uses $vars['selected'] Name of the tab that has been selected
 */

$tabs = array(
	'newest' => array(
		'text' => elgg_echo('wine:newest'),
		'href' => 'wine/all?filter=newest',
		'priority' => 200,
	),
	'mine' => array(
		'text' => elgg_echo('wine:mine'),
		'href' => 'wine/all?filter=mine',
		'priority' => 300,
	),
	/*'discussion' => array(
		'text' => elgg_echo('wine:latestdiscussion'),
		'href' => 'wine/all?filter=discussion',
		'priority' => 400,
	),*/
);

foreach ($tabs as $name => $tab) {
	$tab['name'] = $name;

	if ($vars['selected'] == $name) {
		$tab['selected'] = true;
	}

	elgg_register_menu_item('filter', $tab);
}

echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
