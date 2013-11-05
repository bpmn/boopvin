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
 <div class="ui-widget">
 
	<label><?php echo elgg_echo("restobar:icon"); ?></label><br />
	<?php echo elgg_view("input/file", array('name' => 'icon')); ?>

</div>
<div class="ui-widget">
<div class="validate_error_label">
	<label><?php echo elgg_echo("restobar:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
                'class' => "required",
		'value' => $vars['entity']->name,
	));
	?>
</div>
</div>
<?php

$restobar_profile_fields = elgg_get_config('restobar');
if ($restobar_profile_fields > 0) {
	foreach ($restobar_profile_fields as $shortname => $valtype) {
                $id="id_".$shortname;

		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
                
                echo "<div class=\"ui-widget\">";
                echo "<div class=\"validate_error_label\">";
                echo "<label for=\"$id\">";
		echo elgg_echo("restobar:{$shortname}");
		echo "</label>$line_break";
                echo "</div>";
                
                
		//echo '<div><label>';
		//echo elgg_echo("restobar:{$shortname}");
		//echo "</label>$line_break";
                
              switch ($shortname) { 
                case 'location': 
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'id'=>$id,
                            'class' => "required",
                            'value' => $vars['entity']->$shortname,
                    ));
                    
                    /* création de bouton pour confirmer l'adresse*/
                    $url = 'restobar/map';
                    $text = elgg_echo('restobar:address');
                    $name = 'confirm_address';
                                   
                    $item = new ElggMenuItem($name, $text, $url);
                    echo($item->getContent(array('id'=>'GetMaps','class' => 'elgg-button elgg-button-action ')));
                    
             
                    break;
                
                case 'website':
                     echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'id'=>$id,
                            'value' => $vars['entity']->$shortname,
                    ));
                    break;                   
                    
               
                default:
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'id'=>$id,
                            'class' => "required",
                            'value' => $vars['entity']->$shortname,
                    ));
                    break;
                }
		echo '</div>';
	}
}
?>



<div class="elgg-foot">
<?php



echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'restobar_guid',
		'value' => $vars['entity']->getGUID(),
	));

        $lat_value=$vars['entity']->getLatitude();
        $long_value=$vars['entity']->getLongitude();
               
}else{
    $lat_value='';
    $long_value='';
}

echo elgg_view('input/hidden', array('name' => 'latitude','id'=>'lat','value' => $lat_value));
echo elgg_view('input/hidden', array('name' => 'longitude','id'=>'long','value' => $long_value));

if (isset($vars['entity'])) {
	$delete_url = 'action/restobars/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('restobar:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('restobar:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>
