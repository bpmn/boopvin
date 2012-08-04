<?php
/**
 * wine edit form
 * 
 * @package ElggWines
 */

// new wines default to open membership
if (isset($vars['entity'])) {
	$membership = $vars['entity']->membership;
	$access = $vars['entity']->access_id;
	if ($access != ACCESS_PUBLIC && $access != ACCESS_LOGGED_IN) {
		// wine only - this is done to handle access not created when wine is created
		$access = ACCESS_PRIVATE;
	}
} else {
	$membership = ACCESS_PUBLIC;
	$access = ACCESS_PUBLIC;
}

?>
<div>
	<label><?php echo elgg_echo("wine:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array('name' => 'icon')); ?>
</div>
<div>
	<label><?php echo elgg_echo("wine:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
		'value' => $vars['entity']->name,
	));
	?>
</div>
<?php

$wine_profile_fields = elgg_get_config('wine');
if ($wine_profile_fields > 0) {
	foreach ($wine_profile_fields as $shortname => $valtype) {
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo '<div><label>';
		echo elgg_echo("wine:{$shortname}");
		echo "</label>$line_break";
                
              switch ($shortname) {         
                case 'vintage':
                     echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,          
                            'options' => array(
				elgg_echo('wine:v') =>'v' ,
				elgg_echo('wine:nv') =>'nv' ,
                            )));
                     break;
		case 'kind':
                     echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,          
                            'options_values' => array(
				'red' => elgg_echo('wine:red'),
				'white' => elgg_echo('wine:white'),
                                'rose' => elgg_echo('wine:rose')
                            )));
                     break;
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
		<?php echo elgg_echo('wine:membership'); ?><br />
		<?php echo elgg_view('input/access', array(
			'name' => 'membership',
			'value' => $membership,
			'options_values' => array(
				ACCESS_PRIVATE => elgg_echo('wine:access:private'),
				ACCESS_PUBLIC => elgg_echo('wine:access:public')
			)
		));
		?>
	</label>
</div>
	
<?php

if (elgg_get_plugin_setting('hidden_groups', 'wines') == 'yes') {
	$this_owner = $vars['entity']->owner_guid;
	if (!$this_owner) {
		$this_owner = elgg_get_logged_in_user_guid();
	}
	$access_options = array(
		ACCESS_PRIVATE => elgg_echo('wine:access:wine'),
		ACCESS_LOGGED_IN => elgg_echo("LOGGED_IN"),
		ACCESS_PUBLIC => elgg_echo("PUBLIC")
	);
?>

<div>
	<label>
			<?php echo elgg_echo('wine:visibility'); ?><br />
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
	foreach ($tools as $wine_option) {
		$wine_option_toggle_name = $wine_option->name . "_enable";
		if ($wine_option->default_on) {
			$wine_option_default_value = 'yes';
		} else {
			$wine_option_default_value = 'no';
		}
		$value = $vars['entity']->$wine_option_toggle_name ? $vars['entity']->$wine_option_toggle_name : $wine_option_default_value;
?>	
<div>
	<label>
		<?php echo $wine_option->label; ?><br />
	</label>
		<?php echo elgg_view("input/radio", array(
			"name" => $wine_option_toggle_name,
			"value" => $value,
			'options' => array(
				elgg_echo('wine:yes') => 'yes',
				elgg_echo('wine:no') => 'no',
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
		'name' => 'wine_guid',
		'value' => $vars['entity']->getGUID(),
	));
}

echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if (isset($vars['entity'])) {
	$delete_url = 'action/wines/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('wine:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('wine:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>
