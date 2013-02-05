<?php
/**
 * restobar profile fields
 */

$restobar = $vars['entity'];

$profile_fields = elgg_get_config('restobar');

if (is_array($profile_fields) && count($profile_fields) > 0) {

	$even_odd = 'odd';
	foreach ($profile_fields as $key => $valtype) {
		// do not show the name
		if ($key == 'name') {
			continue;
		}
                
                
		$value = $restobar->$key;
		if (empty($value)) {
			continue;
		}

		$options = array('value' => $restobar->$key);
		if ($valtype == 'tags') {
			$options['tag_names'] = $key;
		}
                
                if ($key == 'location'){
                    $options=array( 'href'=>'#',
                                    'data-lat'=>$restobar->getLatitude(),
                                    'data-lng'=>$restobar->getLongitude(),
                                    'text'=>$restobar->getLocation(),
                                    'id'=>'showmap',
                                    'title'=>elgg_echo('restobar:clickmap'));
                }

		echo "<div class=\"{$even_odd}\">";
		echo "<b>";
		echo elgg_echo("restobar:profile:$key");
		echo ": </b>";
		echo elgg_view("output/$valtype", $options);
         
                    
		echo "</div>";

		$even_odd = ($even_odd == 'even') ? 'odd' : 'even';
	}

        
} ?>




