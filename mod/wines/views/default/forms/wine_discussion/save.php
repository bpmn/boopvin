<?php
/**
 * Discussion topic add/edit form body
 * 
 */

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
//$status = elgg_extract('status', $vars, '');
//$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);

?>
<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label><?php echo elgg_echo('wine:topicmessage'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>

<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'topic_guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>
