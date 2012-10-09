<?php
/**
 * Edit/create a group wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$entity = elgg_extract('entity', $vars, null);

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
        'id' => 'id_wineform'
        
);
$body_vars = array('entity' => $entity);
echo elgg_view_form('wines/edit', $form_vars, $body_vars);
