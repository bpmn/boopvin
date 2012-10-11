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

<script>
 $(document).ready(function(){

       jQuery.validator.messages.required = "";

        $("#id_wineform").validate({
    
            highlight: function(element, errorClass) {
                $(element).parent().css({
                    "border-radius":"0px"
                });
                $(element).parent().css({
                    "box-shadow":"0px 0px 10px #ff0000"
                });

       
            },
        
            unhighlight: function(element, errorClass) {
                $(element).parent().css({
                    "box-shadow":"none"
                });

        
            },
            invalidHandler: function(e, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted below'
                    : 'You missed ' + errors + ' fields.  They have been highlighted below';
                    alert(message);
                    //$("div.error span").html(message);
                    //$("div.error").show();
                    //$("div.validate_error_label label").css("color", "red");
                                                             

                } else {
                     alert("no errors found");

                    //$("div.error").hide();
                    //$("div.validate_error_label label").css("color", "black");

                }
            }
        });
        
      
 });

</script>
<div>
	<label><?php echo elgg_echo("wine:name"); ?></label><br />
	<?php echo elgg_view("input/text", array(
		'name' => 'name',
		'value' => $vars['entity']->name,
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
'Australia' => elgg_echo('Australia'),
'France' => elgg_echo('France'),
'Germany' => elgg_echo('Germany'),
'Portugal' => elgg_echo('Portugal'),
'South Africa' => elgg_echo('South Africa'),
'Spain' => elgg_echo('Spain'),                                
'United States' => elgg_echo('United States'),
'New Zealand' => elgg_echo('New Zealand'),
'Italia' => elgg_echo('Italia'),
'' => elgg_echo(''),
'Algeria' => elgg_echo('Algeria'),
'Argentina' => elgg_echo('Argentina'),
'Austria' => elgg_echo('Austria'),
'Belgium' => elgg_echo('Belgium'),
'Bosnia and Herzegovina' => elgg_echo('Bosnia and Herzegovina'),
'Brazil' => elgg_echo('Brazil'),
'Bulgaria' => elgg_echo('Bulgaria'),
'Canada' => elgg_echo('Canada'),
'Chile' => elgg_echo('Chile'),
'China' => elgg_echo('China'),
'Colombia' => elgg_echo('Colombia'),
'Croatia' => elgg_echo('Croatia'),
'Cyprus' => elgg_echo('Cyprus'),
'Czech Republic' => elgg_echo('Czech Republic'),
'Egypt' => elgg_echo('Egypt'),
'Georgia' => elgg_echo('Georgia'),
'Greece' => elgg_echo('Greece'),
'Hungary' => elgg_echo('Hungary'),
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
'Switzerland' => elgg_echo('Switzerland'),
'Tunisia' => elgg_echo('Tunisia'),
'Turkey' => elgg_echo('Turkey'),
'Ukraine' => elgg_echo('Ukraine'),
'United Kingdom' => elgg_echo('United Kingdom'),
'Uruguay' => elgg_echo('Uruguay'),    

                                
                            )));
                      
                       
                     break; 

                  
		case 'kind':
                     echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname, 
                            'id' => $id,
                            'class' => "required",
                            'options_values' => array(''=> elgg_echo(''),
				'red' => elgg_echo('wine:red'),
				'white' => elgg_echo('wine:white'),
                                'rose' => elgg_echo('wine:rose')
                            )));
                     break;
                 
                 
                default:
                    echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,
                            'id' => $id,
                            'class' => "required"

                    ));
                    break;
                }
		echo '</div>';
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
