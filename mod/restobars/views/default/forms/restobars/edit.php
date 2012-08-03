<?php
/**
 * restobar edit form
 * 
 * @package ElggRestobars
 */

// new restobars default to open membership
if (isset($vars['entity'])) {
	$membership = $vars['entity']->membership;
	$access = $vars['entity']->access_id;
	if ($access != ACCESS_PUBLIC && $access != ACCESS_LOGGED_IN) {
		// restobar only - this is done to handle access not created when restobar is created
		$access = ACCESS_PRIVATE;
	}
} else {
	$membership = ACCESS_PUBLIC;
	$access = ACCESS_PUBLIC;
}

?>
<div>
	<label><?php echo elgg_echo("restobar:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array('name' => 'icon')); ?>
</div>
<div>
	<label><?php echo elgg_echo("restobar:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
		'value' => $vars['entity']->name,
	));
	?>
</div>
<?php

$restobar_profile_fields = elgg_get_config('restobar');
if ($restobar_profile_fields > 0) {
	foreach ($restobar_profile_fields as $shortname => $valtype) {
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo '<div><label>';
		echo elgg_echo("restobar:{$shortname}");
		echo "</label>$line_break";
                
              switch ($shortname) {         
             
                default:
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,
                    ));
                    break;
                }
		echo '</div>';
	}
}
?>

<div>
	<label>
		<?php echo elgg_echo('restobar:membership'); ?><br />
		<?php echo elgg_view('input/access', array(
			'name' => 'membership',
			'value' => $membership,
			'options_values' => array(
				ACCESS_PRIVATE => elgg_echo('restobar:access:private'),
				ACCESS_PUBLIC => elgg_echo('restobar:access:public')
			)
		));
		?>
	</label>
</div>
	
<?php

if (elgg_get_plugin_setting('hidden_groups', 'restobars') == 'yes') {
	$this_owner = $vars['entity']->owner_guid;
	if (!$this_owner) {
		$this_owner = elgg_get_logged_in_user_guid();
	}
	$access_options = array(
		ACCESS_PRIVATE => elgg_echo('restobar:access:restobar'),
		ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
		ACCESS_PUBLIC => elgg_echo("PUBLIC")
	);
?>

<div>
	<label>
			<?php echo elgg_echo('restobar:visibility'); ?><br />
			<?php echo elgg_view('input/access', array(
				'name' => 'vis',
				'value' =>  $access,
				'options_values' => $access_options,
			));
			?>
	</label>
</div>

<?php 	
}

$tools = elgg_get_config('group_tool_options');
if ($tools) {
	usort($tools, create_function('$a,$b', 'return strcmp($a->label,$b->label);'));
	foreach ($tools as $restobar_option) {
		$restobar_option_toggle_name = $restobar_option->name . "_enable";
		if ($restobar_option->default_on) {
			$restobar_option_default_value = 'yes';
		} else {
			$restobar_option_default_value = 'no';
		}
		$value = $vars['entity']->$restobar_option_toggle_name ? $vars['entity']->$restobar_option_toggle_name : $restobar_option_default_value;
?>	
<div>
	<label>
		<?php echo $restobar_option->label; ?><br />
	</label>
		<?php echo elgg_view("input/radio", array(
			"name" => $restobar_option_toggle_name,
			"value" => $value,
			'options' => array(
				elgg_echo('restobar:yes') => 'yes',
				elgg_echo('restobar:no') => 'no',
			),
		));
		?>
</div>
<?php
	}
}
?>
<div class="elgg-foot">
<?php

if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'restobar_guid',
		'value' => $vars['entity']->getGUID(),
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if (isset($vars['entity'])) {
	$delete_url = 'action/restobar/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('restobar:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('restobar:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>