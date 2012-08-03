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
                  
                  
                  case 'country':
                       echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,          
                            'options_values' => array(
 'Australia' => elgg_echo('Australia'),
 'Chile' => elgg_echo('Chile'),
 'France' => elgg_echo('France'),
 'Germany' => elgg_echo('Germany'),
 'Italy' => elgg_echo('Italy'),
 'New Zealand' => elgg_echo('New Zealand'),
 'Portugal' => elgg_echo('Portugal'),
 'South Africa' => elgg_echo('South Africa'),
 'Spain' => elgg_echo('Spain'),
 'United Kingdom' => elgg_echo('United Kingdom'),
 'United States' => elgg_echo('United States'),   
 '' => elgg_echo(' '),                                                    
 'Afghanistan' => elgg_echo('Afghanistan'),
 'Åland Islands' => elgg_echo('Åland Islands'),
 'Albania' => elgg_echo('Albania'),
 'Algeria' => elgg_echo('Algeria'),
 'American Samoa' => elgg_echo('American Samoa'),
 'Andorra' => elgg_echo('Andorra'),
 'Angola' => elgg_echo('Angola'),
 'Anguilla' => elgg_echo('Anguilla'),
 'Antarctica' => elgg_echo('Antarctica'),
 'Antigua and Barbuda' => elgg_echo('Antigua and Barbuda'),
 'Argentina' => elgg_echo('Argentina'),
 'Armenia' => elgg_echo('Armenia'),
 'Aruba' => elgg_echo('Aruba'),
 'Australia' => elgg_echo('Australia'),
 'Austria' => elgg_echo('Austria'),
 'Azerbaijan' => elgg_echo('Azerbaijan'),
 'Bahamas' => elgg_echo('Bahamas'),
 'Bahrain' => elgg_echo('Bahrain'),
 'Bangladesh' => elgg_echo('Bangladesh'),
 'Barbados' => elgg_echo('Barbados'),
 'Belarus' => elgg_echo('Belarus'),
 'Belgium' => elgg_echo('Belgium'),
 'Belize' => elgg_echo('Belize'),
 'Benin' => elgg_echo('Benin'),
 'Bermuda' => elgg_echo('Bermuda'),
 'Bhutan' => elgg_echo('Bhutan'),
 'Bolivia' => elgg_echo('Bolivia'),
 'Bosnia and Herzegovina' => elgg_echo('Bosnia and Herzegovina'),
 'Botswana' => elgg_echo('Botswana'),
 'Bouvet Island' => elgg_echo('Bouvet Island'),
 'Brazil' => elgg_echo('Brazil'),
 'British Indian Ocean Territory' => elgg_echo('British Indian Ocean Territory'),
 'Brunei Darussalam' => elgg_echo('Brunei Darussalam'),
 'Bulgaria' => elgg_echo('Bulgaria'),
 'Burkina Faso' => elgg_echo('Burkina Faso'),
 'Burundi' => elgg_echo('Burundi'),
 'Cambodia' => elgg_echo('Cambodia'),
 'Cameroon' => elgg_echo('Cameroon'),
 'Canada' => elgg_echo('Canada'),
 'Cape Verde' => elgg_echo('Cape Verde'),
 'Cayman Islands' => elgg_echo('Cayman Islands'),
 'Central African Republic' => elgg_echo('Central African Republic'),
 'Chad' => elgg_echo('Chad'),
 'Chile' => elgg_echo('Chile'),
 'China' => elgg_echo('China'),
 'Christmas Island' => elgg_echo('Christmas Island'),
 'Cocos (Keeling) Islands' => elgg_echo('Cocos (Keeling) Islands'),
 'Colombia' => elgg_echo('Colombia'),
 'Comoros' => elgg_echo('Comoros'),
 'Congo' => elgg_echo('Congo'),
 'Congo, The Democratic Republic of The' => elgg_echo('Congo, The Democratic Republic of The'),
 'Cook Islands' => elgg_echo('Cook Islands'),
 'Costa Rica' => elgg_echo('Costa Rica'),
 'Cote D ivoire' => elgg_echo('Cote D ivoire'),
 'Croatia' => elgg_echo('Croatia'),
 'Cuba' => elgg_echo('Cuba'),
 'Cyprus' => elgg_echo('Cyprus'),
 'Czech Republic' => elgg_echo('Czech Republic'),
 'Denmark' => elgg_echo('Denmark'),
 'Djibouti' => elgg_echo('Djibouti'),
 'Dominica' => elgg_echo('Dominica'),
 'Dominican Republic' => elgg_echo('Dominican Republic'),
 'Ecuador' => elgg_echo('Ecuador'),
 'Egypt' => elgg_echo('Egypt'),
 'El Salvador' => elgg_echo('El Salvador'),
 'Equatorial Guinea' => elgg_echo('Equatorial Guinea'),
 'Eritrea' => elgg_echo('Eritrea'),
 'Estonia' => elgg_echo('Estonia'),
 'Ethiopia' => elgg_echo('Ethiopia'),
 'Falkland Islands (Malvinas)' => elgg_echo('Falkland Islands (Malvinas)'),
 'Faroe Islands' => elgg_echo('Faroe Islands'),
 'Fiji' => elgg_echo('Fiji'),
 'Finland' => elgg_echo('Finland'),
 'France' => elgg_echo('France'),
 'French Guiana' => elgg_echo('French Guiana'),
 'French Polynesia' => elgg_echo('French Polynesia'),
 'French Southern Territories' => elgg_echo('French Southern Territories'),
 'Gabon' => elgg_echo('Gabon'),
 'Gambia' => elgg_echo('Gambia'),
 'Georgia' => elgg_echo('Georgia'),
 'Germany' => elgg_echo('Germany'),
 'Ghana' => elgg_echo('Ghana'),
 'Gibraltar' => elgg_echo('Gibraltar'),
 'Greece' => elgg_echo('Greece'),
 'Greenland' => elgg_echo('Greenland'),
 'Grenada' => elgg_echo('Grenada'),
 'Guadeloupe' => elgg_echo('Guadeloupe'),
 'Guam' => elgg_echo('Guam'),
 'Guatemala' => elgg_echo('Guatemala'),
 'Guernsey' => elgg_echo('Guernsey'),
 'Guinea' => elgg_echo('Guinea'),
 'Guinea-bissau' => elgg_echo('Guinea-bissau'),
 'Guyana' => elgg_echo('Guyana'),
 'Haiti' => elgg_echo('Haiti'),
 'Heard Island and Mcdonald Islands' => elgg_echo('Heard Island and Mcdonald Islands'),
 'Holy See (Vatican City State)' => elgg_echo('Holy See (Vatican City State)'),
 'Honduras' => elgg_echo('Honduras'),
 'Hong Kong' => elgg_echo('Hong Kong'),
 'Hungary' => elgg_echo('Hungary'),
 'Iceland' => elgg_echo('Iceland'),
 'India' => elgg_echo('India'),
 'Indonesia' => elgg_echo('Indonesia'),
 'Iran, Islamic Republic of' => elgg_echo('Iran, Islamic Republic of'),
 'Iraq' => elgg_echo('Iraq'),
 'Ireland' => elgg_echo('Ireland'),
 'Isle of Man' => elgg_echo('Isle of Man'),
 'Israel' => elgg_echo('Israel'),
 'Italy' => elgg_echo('Italy'),
 'Jamaica' => elgg_echo('Jamaica'),
 'Japan' => elgg_echo('Japan'),
 'Jersey' => elgg_echo('Jersey'),
 'Jordan' => elgg_echo('Jordan'),
 'Kazakhstan' => elgg_echo('Kazakhstan'),
 'Kenya' => elgg_echo('Kenya'),
 'Kiribati' => elgg_echo('Kiribati'),
 'Korea, Democratic People Republic of' => elgg_echo('Korea, Democratic People Republic of'),
 'Korea, Republic of' => elgg_echo('Korea, Republic of'),
 'Kuwait' => elgg_echo('Kuwait'),
 'Kyrgyzstan' => elgg_echo('Kyrgyzstan'),
 'Lao People Democratic Republic' => elgg_echo('Lao People Democratic Republic'),
 'Latvia' => elgg_echo('Latvia'),
 'Lebanon' => elgg_echo('Lebanon'),
 'Lesotho' => elgg_echo('Lesotho'),
 'Liberia' => elgg_echo('Liberia'),
 'Libyan Arab Jamahiriya' => elgg_echo('Libyan Arab Jamahiriya'),
 'Liechtenstein' => elgg_echo('Liechtenstein'),
 'Lithuania' => elgg_echo('Lithuania'),
 'Luxembourg' => elgg_echo('Luxembourg'),
 'Macao' => elgg_echo('Macao'),
 'Macedonia, The Former Yugoslav Republic of' => elgg_echo('Macedonia, The Former Yugoslav Republic of'),
 'Madagascar' => elgg_echo('Madagascar'),
 'Malawi' => elgg_echo('Malawi'),
 'Malaysia' => elgg_echo('Malaysia'),
 'Maldives' => elgg_echo('Maldives'),
 'Mali' => elgg_echo('Mali'),
 'Malta' => elgg_echo('Malta'),
 'Marshall Islands' => elgg_echo('Marshall Islands'),
 'Martinique' => elgg_echo('Martinique'),
 'Mauritania' => elgg_echo('Mauritania'),
 'Mauritius' => elgg_echo('Mauritius'),
 'Mayotte' => elgg_echo('Mayotte'),
 'Mexico' => elgg_echo('Mexico'),
 'Micronesia, Federated States of' => elgg_echo('Micronesia, Federated States of'),
 'Moldova, Republic of' => elgg_echo('Moldova, Republic of'),
 'Monaco' => elgg_echo('Monaco'),
 'Mongolia' => elgg_echo('Mongolia'),
 'Montenegro' => elgg_echo('Montenegro'),
 'Montserrat' => elgg_echo('Montserrat'),
 'Morocco' => elgg_echo('Morocco'),
 'Mozambique' => elgg_echo('Mozambique'),
 'Myanmar' => elgg_echo('Myanmar'),
 'Namibia' => elgg_echo('Namibia'),
 'Nauru' => elgg_echo('Nauru'),
 'Nepal' => elgg_echo('Nepal'),
 'Netherlands' => elgg_echo('Netherlands'),
 'Netherlands Antilles' => elgg_echo('Netherlands Antilles'),
 'New Caledonia' => elgg_echo('New Caledonia'),
 'New Zealand' => elgg_echo('New Zealand'),
 'Nicaragua' => elgg_echo('Nicaragua'),
 'Niger' => elgg_echo('Niger'),
 'Nigeria' => elgg_echo('Nigeria'),
 'Niue' => elgg_echo('Niue'),
 'Norfolk Island' => elgg_echo('Norfolk Island'),
 'Northern Mariana Islands' => elgg_echo('Northern Mariana Islands'),
 'Norway' => elgg_echo('Norway'),
 'Oman' => elgg_echo('Oman'),
 'Pakistan' => elgg_echo('Pakistan'),
 'Palau' => elgg_echo('Palau'),
 'Palestinian Territory, Occupied' => elgg_echo('Palestinian Territory, Occupied'),
 'Panama' => elgg_echo('Panama'),
 'Papua New Guinea' => elgg_echo('Papua New Guinea'),
 'Paraguay' => elgg_echo('Paraguay'),
 'Peru' => elgg_echo('Peru'),
 'Philippines' => elgg_echo('Philippines'),
 'Pitcairn' => elgg_echo('Pitcairn'),
 'Poland' => elgg_echo('Poland'),
 'Portugal' => elgg_echo('Portugal'),
 'Puerto Rico' => elgg_echo('Puerto Rico'),
 'Qatar' => elgg_echo('Qatar'),
 'Reunion' => elgg_echo('Reunion'),
 'Romania' => elgg_echo('Romania'),
 'Russian Federation' => elgg_echo('Russian Federation'),
 'Rwanda' => elgg_echo('Rwanda'),
 'Saint Helena' => elgg_echo('Saint Helena'),
 'Saint Kitts and Nevis' => elgg_echo('Saint Kitts and Nevis'),
 'Saint Lucia' => elgg_echo('Saint Lucia'),
 'Saint Pierre and Miquelon' => elgg_echo('Saint Pierre and Miquelon'),
 'Saint Vincent and The Grenadines' => elgg_echo('Saint Vincent and The Grenadines'),
 'Samoa' => elgg_echo('Samoa'),
 'San Marino' => elgg_echo('San Marino'),
 'Sao Tome and Principe' => elgg_echo('Sao Tome and Principe'),
 'Saudi Arabia' => elgg_echo('Saudi Arabia'),
 'Senegal' => elgg_echo('Senegal'),
 'Serbia' => elgg_echo('Serbia'),
 'Seychelles' => elgg_echo('Seychelles'),
 'Sierra Leone' => elgg_echo('Sierra Leone'),
 'Singapore' => elgg_echo('Singapore'),
 'Slovakia' => elgg_echo('Slovakia'),
 'Slovenia' => elgg_echo('Slovenia'),
 'Solomon Islands' => elgg_echo('Solomon Islands'),
 'Somalia' => elgg_echo('Somalia'),
 'South Africa' => elgg_echo('South Africa'),
 'South Georgia and The South Sandwich Islands' => elgg_echo('South Georgia and The South Sandwich Islands'),
 'Spain' => elgg_echo('Spain'),
 'Sri Lanka' => elgg_echo('Sri Lanka'),
 'Sudan' => elgg_echo('Sudan'),
 'Suriname' => elgg_echo('Suriname'),
 'Svalbard and Jan Mayen' => elgg_echo('Svalbard and Jan Mayen'),
 'Swaziland' => elgg_echo('Swaziland'),
 'Sweden' => elgg_echo('Sweden'),
 'Switzerland' => elgg_echo('Switzerland'),
 'Syrian Arab Republic' => elgg_echo('Syrian Arab Republic'),
 'Taiwan, Province of China' => elgg_echo('Taiwan, Province of China'),
 'Tajikistan' => elgg_echo('Tajikistan'),
 'Tanzania, United Republic of' => elgg_echo('Tanzania, United Republic of'),
 'Thailand' => elgg_echo('Thailand'),
 'Timor-leste' => elgg_echo('Timor-leste'),
 'Togo' => elgg_echo('Togo'),
 'Tokelau' => elgg_echo('Tokelau'),
 'Tonga' => elgg_echo('Tonga'),
 'Trinidad and Tobago' => elgg_echo('Trinidad and Tobago'),
 'Tunisia' => elgg_echo('Tunisia'),
 'Turkey' => elgg_echo('Turkey'),
 'Turkmenistan' => elgg_echo('Turkmenistan'),
 'Turks and Caicos Islands' => elgg_echo('Turks and Caicos Islands'),
 'Tuvalu' => elgg_echo('Tuvalu'),
 'Uganda' => elgg_echo('Uganda'),
 'Ukraine' => elgg_echo('Ukraine'),
 'United Arab Emirates' => elgg_echo('United Arab Emirates'),
 'United Kingdom' => elgg_echo('United Kingdom'),
 'United States' => elgg_echo('United States'),
 'United States Minor Outlying Islands' => elgg_echo('United States Minor Outlying Islands'),
 'Uruguay' => elgg_echo('Uruguay'),
 'Uzbekistan' => elgg_echo('Uzbekistan'),
 'Vanuatu' => elgg_echo('Vanuatu'),
 'Venezuela' => elgg_echo('Venezuela'),
 'Viet Nam' => elgg_echo('Viet Nam'),
 'Virgin Islands, British' => elgg_echo('Virgin Islands, British'),
 'Virgin Islands, U.S.' => elgg_echo('Virgin Islands, U.S.'),
 'Wallis and Futuna' => elgg_echo('Wallis and Futuna'),
 'Western Sahara' => elgg_echo('Western Sahara'),
 'Yemen' => elgg_echo('Yemen'),
 'Zambia' => elgg_echo('Zambia'),
 'Zimbabwe' => elgg_echo('Zimbabwe'),
                                
                                
                                
				
                            
                            )));
                      
                       
                     break; 

                  
                  
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
	$delete_url = 'action/wine/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('wine:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('wine:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>
