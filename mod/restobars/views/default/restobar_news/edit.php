<?php
/**
 * Edit/create an object wrapper
 *
 * @uses $vars['entity'] ElggObject
 */

$entity = elgg_extract('entity', $vars, null);

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
        'id'=> 'restobar_news'
);
$body_vars = array('entity' => $entity);
echo elgg_view_form('restobar_news/edit', $form_vars, $body_vars);