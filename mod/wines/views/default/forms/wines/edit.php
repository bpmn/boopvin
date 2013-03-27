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

if (!isset($vars['entity'])){
echo "<div> <label>";
echo elgg_echo("wine:photo").'</label><br />';
echo elgg_view("input/file", array('name' => 'photo')); 
echo '</div>';
}



?>



<div>
	<label><?php echo elgg_echo("wine:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(

		'name' => 'domaine',
		'value' => $vars['entity']->domaine,
                'class' => "required"

	));
	?>
</div>
<?php

$wine_profile_fields = elgg_get_config('wine');


if ($wine_profile_fields > 0) {
	foreach ($wine_profile_fields as $shortname => $valtype) {
                $id="id_".$shortname;
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo "<div class=\"ui-widget\">";
                echo "<div class=\"validate_error_label\">";
                echo "<label for=\"$id\">";
		echo elgg_echo("wine:{$shortname}");
		echo "</label>$line_break";
                echo "</div>";
                
              switch ($shortname) {       
                  
                  
                  case 'country':
                      
                       echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,    
                            'id' => $id,
                            'class' => "required",
                            'options_values' => array(

 '' => elgg_echo(''),                               
'France' => elgg_echo('France'),
'Italia' => elgg_echo('Italia'),
'Spain' => elgg_echo('Spain'),
'Germany' => elgg_echo('Germany'),
'Portugal' => elgg_echo('Portugal'),                                
'Australia' => elgg_echo('Australia'),
'South Africa' => elgg_echo('South Africa'),                             
'United States' => elgg_echo('United States'),
'New Zealand' => elgg_echo('New Zealand'),
'Argentina' => elgg_echo('Argentina'),
'Chile' => elgg_echo('Chile'),
'Austria' => elgg_echo('Austria'),
'Hungary' => elgg_echo('Hungary'),                                
'Switzerland' => elgg_echo('Switzerland'),
                                
//'' => elgg_echo(''),
'Algeria' => elgg_echo('Algeria'),
'Uruguay' => elgg_echo('Uruguay'),
'Belgium' => elgg_echo('Belgium'),
'Bosnia and Herzegovina' => elgg_echo('Bosnia and Herzegovina'),
'Brazil' => elgg_echo('Brazil'),
'Bulgaria' => elgg_echo('Bulgaria'),
'Canada' => elgg_echo('Canada'),
'China' => elgg_echo('China'),
'Colombia' => elgg_echo('Colombia'),
'Croatia' => elgg_echo('Croatia'),
'Cyprus' => elgg_echo('Cyprus'),
'Czech Republic' => elgg_echo('Czech Republic'),
'Egypt' => elgg_echo('Egypt'),
'Georgia' => elgg_echo('Georgia'),
'Greece' => elgg_echo('Greece'),
'India' => elgg_echo('India'),
'Israel' => elgg_echo('Israel'),
'Japan' => elgg_echo('Japan'),
'Kazakhstan' => elgg_echo('Kazakhstan'),
'Liban' => elgg_echo('Liban'),
'Luxembourg' => elgg_echo('Luxembourg'),
'Macedonia' => elgg_echo('Macedonia'),
'Mexico' => elgg_echo('Mexico'),
'Moldova' => elgg_echo('Moldova'),
'Montenegro' => elgg_echo('Montenegro'),
'Morocco' => elgg_echo('Morocco'),
'Namibia' => elgg_echo('Namibia'),
'Peru' => elgg_echo('Peru'),
'Romania' => elgg_echo('Romania'),
'Russia' => elgg_echo('Russia'),
'Slovakia' => elgg_echo('Slovakia'),
'Slovenia' => elgg_echo('Slovenia'),
'Tunisia' => elgg_echo('Tunisia'),
'Turkey' => elgg_echo('Turkey'),
'Ukraine' => elgg_echo('Ukraine'),
'United Kingdom' => elgg_echo('United Kingdom'),
    

                                
                            )));
                      
                       
                     break; 

                  
		case 'kind':
                    $option_kind=array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname, 
                            'id' => $id,
                            'class' => "required",
                            'options_values' => array(''=> elgg_echo(''),
				'red' => elgg_echo('wine:red'),
				'white' => elgg_echo('wine:white'),
                                'rose' => elgg_echo('wine:rose'),
                                'white_sparkling' => elgg_echo('wine:white_sparkling'),
                                'rose_sparkling' => elgg_echo('wine:rose_sparkling'),
                                'moelleux' => elgg_echo('wine:moelleux'),
                                'vdn_blanc' => elgg_echo('wine:vdn_blanc'),
                                'vdn_rouge' => elgg_echo('wine:vdn_rouge')
                            ));
                     if (isset($vars['entity'])&& (!elgg_is_admin_logged_in() && ($vars['entity']->getOwnerGUID() != elgg_get_logged_in_user_guid()) )) {
                         $option_kind['disabled']="disabled";
                     }
                     echo elgg_view("input/{$valtype}",$option_kind );
                     break;
                 

                case 'appellation':
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,
                            'id' => $id,
                            'class' => "required"

                    ));
                    break;    
                
                default:
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,
                            'id' => $id
                    ));
                    break;
                }
		echo '</div>';
	}
}
?>



<div class="elgg-foot">
<?php

// variable pour détecter si l'appellation a été rentrée  " à la main"
echo elgg_view('input/hidden', array(
		'name' => 'error_autocomplete',
		'value' => '',
	));


if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'wine_guid',
		'value' => $vars['entity']->getGUID(),
	));
        if (!elgg_is_admin_logged_in() && ($vars['entity']->getOwnerGUID() != elgg_get_logged_in_user_guid())){
            echo elgg_view('input/hidden', array(
                    'name' => 'kind',
                    'value' => $vars['entity']->kind,
            ));
        
        }

        
}


echo elgg_view('input/submit', array('value' => elgg_echo('save')));

if (isset($vars['entity'])&& elgg_is_admin_logged_in()) {
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
