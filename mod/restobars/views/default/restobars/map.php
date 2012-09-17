<?php
/**
 * Map restobar application
 *
 * @uses $vars['entity'] ElggGroup object
 */



$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
        'id'=>  "MapForm"
);

$body_vars=array();

echo elgg_view_form('restobars/map', $form_vars, $body_vars);
