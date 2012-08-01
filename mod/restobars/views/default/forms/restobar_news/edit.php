<?php
/**
 * Discussion topic add/edit form body
 * 
 */


$restobarnews = elgg_extract('entity', $vars, null);
$desc=$restobarnews->description;
?>

<div>
	<label><?php echo elgg_echo('restobarnews:message'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>

<div class="elgg-foot">
<?php

$guid=$restobarnews->getGUID();

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'restobarnews_guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>
