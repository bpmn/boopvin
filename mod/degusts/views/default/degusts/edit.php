<?php
/**
 * Edit/create a group wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$entity = elgg_extract('entity', $vars, null);
$container_guid=elgg_extract('container_guid',$vars,null);
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt elgg-overlay', //permet de visualiser la fiche ds un pop up lors de l'action "save"
);
$body_vars = array('entity' => $entity,'container_guid'=>$container_guid);

echo elgg_view_form('degusts/edit', $form_vars, $body_vars);
?>