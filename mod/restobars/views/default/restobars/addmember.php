<?php
/**
 * Edit/create a group wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt', //permet de visualiser la fiche ds un pop up lors de l'action "save"
        'id'=>"addmemberform"
        );

$body_vars = array('entity'=>$vars['entity']);;

echo elgg_view_form('restobars/addmember', $form_vars, $body_vars);

?>