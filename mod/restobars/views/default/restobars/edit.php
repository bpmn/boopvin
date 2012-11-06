
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
        'id'    => 'id_restobarform'
);
$body_vars = array('entity' => $entity);
echo elgg_view_form('restobars/edit', $form_vars, $body_vars);
