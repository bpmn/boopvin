<?php
/**
 * Wine profile fields
 */

$wine = $vars['entity'];

$profile_fields = elgg_get_config('wine_display');

if (is_array($profile_fields) && count($profile_fields) > 0) {

	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}
                
               
           

		$value = $wine->$key;
		if (empty($value)) {
			continue;
		}

		$options = array('value' => $wine->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}
                
                if ($key == 'kind') {
			$options['value'] = elgg_echo("wine:profile:{$wine->$key}");
		}

		echo "<div class=\"{$even_odd}\">";
		echo "<b>";
		echo elgg_echo("wine:$key");
		echo ": </b>";
		echo elgg_view("output/$valtype", $options);
		echo "</div>";

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}

        
} ?>




