<?php
/**
 * Edit/create a group wrapper
 *
 * @uses $vars['entity'] ElggGroup object
 */

$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt', //permet de visualiser la fiche ds un pop up lors de l'action "save"
        'id'=>"addtocaveform"
        );
$body_vars = array('entity'=>$vars['entity']);;

echo elgg_view_form('wines/cave/addtocave', $form_vars, $body_vars);
?>