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
	$(function() {
                            
                var array = [];
                
                array[0] = [
"ajaccio",
"aloxe-corton",
"alsace grand cru",
"alsace ou vin d'Alsace",
"anjou",
"anjou villages",
"anjou villages brissac",
"anjou-coteaux-de-la-loire",
"arbois",
"auxey-duresses",
"bandol",
"banyuls",
"banyuls grand cru",
"barsac",
"beaujolais",
"beaujolais-villages",
"beaumes-de-venise",
"beaune",
"bellet ou vin de Bellet",
"bergerac",
"bienvenues-bâtard-montrachet",
"blagny",
"blaye",
"bonnes-mares",
"bonnezeaux",
"bordeaux",
"bordeaux supérieur",
"bourgogne",
"bourgogne aligoté",
"bourgogne mousseux",
"bourgogne passe-tout-grains",
"bourgogne-ordinaire ou bourgogne grand ordinaire",
"bourgueil",
"bouzeron",
"brouilly",
"bugey",
"buzet",
"bâtard-montrachet",
"béarn",
"cabardès",
"cabernet d'Anjou",
"cabernet de Saumur",
"cadillac",
"cahors",
"canon-fronsac",
"cassis",
"chablis",
"chablis grand cru",
"chambertin",
"chambertin-clos-de-bèze",
"chambolle-musigny",
"champagne",
"chapelle-chambertin",
"charlemagne",
"charmes-chambertin",
"chassagne-montrachet",
"chevalier-montrachet",
"cheverny",
"chinon",
"chiroubles",
"chorey-lès-beaune",
"château-chalon",
"château-grillet",
"châteaumeillant",
"châteauneuf-du-pape",
"châtillon-en-diois",
"chénas",
"clairette de Bellegarde",
"clairette de Die",
"clairette du Languedoc",
"clos-de-la-roche",
"clos-de-tart",
"clos-de-vougeot ou clos-vougeot",
"clos-des-lambrays",
"clos-saint-denis",
"collioure",
"condrieu",
"corbières",
"corbières-boutenac",
"cornas",
"corse ou vin de Corse",
"corton",
"corton-charlemagne",
"costières-de-nîmes",
"coteaux-champenois",
"coteaux-d'aix-en-provence",
"coteaux-de-die",
"coteaux-de-l'aubance",
"coteaux-de-saumur",
"coteaux-du-giennois",
"coteaux-du-layon",
"coteaux-du-loir",
"coteaux-du-lyonnais",
"coteaux-du-vendômois",
"coteaux-varois-en-provence",
"cour-cheverny",
"criots-bâtard-montrachet",
"crozes-hermitage ou crozes-ermitage",
"crémant d'Alsace",
"crémant de Bordeaux",
"crémant de Bourgogne",
"crémant de Die",
"crémant de Limoux",
"crémant de Loire",
"crémant du Jura",
"cérons",
"côte-de-beaune",
"côte-de-beaune-villages",
"côte-de-brouilly",
"côte-de-nuits-villages",
"côte-roannaise",
"côte-rôtie",
"côtes-de-bergerac",
"côtes-de-blaye",
"côtes-de-bordeaux",
"côtes-de-bordeaux-saint-macaire",
"côtes-de-bourg ou bourg ou bourgeais",
"côtes-de-duras",
"côtes-de-montravel",
"côtes-de-provence",
"côtes-de-toul",
"côtes-du-forez",
"côtes-du-jura",
"côtes-du-marmandais",
"côtes-du-rhône",
"Côtes-du-rhône villages",
"côtes-du-roussillon",
"Côtes-du-roussillon villages",
"côtes-du-vivarais",
"entre-deux-mers",
"faugères",
"fiefs-vendéens",
"fitou",
"fixin",
"fleurie",
"fronsac",
"fronton",
"gaillac",
"gaillac-premières-côtes",
"gevrey-chambertin",
"gigondas",
"givry",
"grands-échezeaux",
"graves",
"graves-de-vayres",
"graves-supérieures",
"grignan-les-adhémar",
"griotte-chambertin",
"haut-montravel",
"haut-médoc",
"hermitage ou ermitage",
"irancy",
"irouléguy",
"jasnières",
"juliénas",
"jurançon",
"l'étoile",
"la-grande-rue",
"la-romanée",
"la-tâche",
"ladoix",
"lalande-de-pomerol",
"languedoc",
"latricières-chambertin",
"les-baux-de-provence",
"limoux",
"lirac",
"listrac-médoc",
"loupiac",
"luberon",
"lussac-saint-émilion",
"madiran",
"malepère",
"maranges",
"marcillac",
"margaux",
"marsannay",
"maury",
"mazis-chambertin",
"mazoyères-chambertin",
"menetou-salon",
"mercurey",
"meursault",
"minervois",
"minervois-la-livinière",
"monbazillac",
"montagne-saint-émilion",
"montagny",
"monthélie",
"montlouis-sur-loire",
"montrachet",
"montravel",
"morey-saint-denis",
"morgon",
"moselle4",
"moulin-à-vent",
"moulis ou moulis-en-médoc",
"muscadet",
"muscadet-coteaux-de-la-loire",
"muscadet-côtes-de-grandlieu",
"muscadet-sèvre-et-maine",
"muscat de Beaumes-de-Venise",
"muscat de Frontignan ou vin de Frontignan",
"muscat de Lunel",
"muscat de Mireval",
"muscat de Rivesaltes",
"muscat de Saint-Jean-de-Minervois",
"muscat du Cap-Corse",
"musigny",
"mâcon",
"médoc",
"nuits-saint-georges",
"néac",
"orléans",
"orléans-cléry",
"pacherenc-du-vic-bilh",
"palette",
"patrimonio",
"pauillac",
"pernand-vergelesses",
"pessac-léognan",
"petit-chablis",
"pierrevert",
"pomerol",
"pommard",
"pouilly-fuissé",
"pouilly-fumé ou blanc-fumé de Pouilly",
"pouilly-loché",
"pouilly-sur-loire",
"pouilly-vinzelles",
"premières-côtes-de-bordeaux",
"puisseguin-saint-émilion",
"puligny-montrachet",
"pécharmant",
"quarts-de-chaume",
"quincy",
"rasteau",
"reuilly",
"richebourg",
"rivesaltes",
"romanée-conti",
"romanée-saint-vivant",
"rosette",
"rosé d'Anjou",
"rosé de Loire",
"rosé des Riceys",
"roussette de Savoie",
"roussette du Bugey",
"ruchottes-chambertin",
"rully",
"régnié",
"saint-amour",
"saint-aubin",
"saint-bris",
"saint-chinian",
"saint-estèphe",
"saint-georges-saint-émilion",
"saint-joseph",
"saint-julien",
"saint-nicolas-de-bourgueil",
"saint-pourçain",
"saint-péray",
"saint-romain",
"saint-véran",
"saint-émilion",
"saint-émilion grand cru",
"sainte-croix-du-mont",
"sainte-foy-bordeaux",
"sancerre",
"santenay",
"saumur",
"saumur-champigny",
"saussignac",
"sauternes",
"savennières",
"savigny-lès-beaune",
"seyssel",
"tavel",
"touraine",
"touraine-noble-joué",
"vacqueyras",
"valençay",
"ventoux",
"vin de Savoie ou savoie",
"vinsobres",
"viré-clessé",
"volnay",
"vosne-romanée",
"vougeot",
"vouvray",
"échezeaux"
                

               ];
               
               array[1] = [
                    
                    "Corse",
"Bourgogne",
"Alsace",
"Alsace",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"Jura",
"Bourgogne",
"Provence",
"Languedoc-Roussillon",
"Languedoc-Roussillon",
"Bordeaux",
"Beaujolais",
"Beaujolais",
"vallée du Rhône",
"Bourgogne",
"Provence",
"Sud-Ouest",
"Bourgogne",
"Bourgogne",
"Bordeaux",
"Bourgogne",
"vallée de la Loire",
"Bordeaux",
"Bordeaux",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",
"Beaujolais",
"Bugey",
"Sud-Ouest",
"Bourgogne",
"Sud-Ouest",
"Languedoc",
"vallée de la Loire",
"vallée de la Loire",
"Bordeaux",
"Sud-Ouest",
"Bordeaux",
"Provence",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Champagne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"vallée de la Loire",
"Beaujolais",
"Bourgogne",
"Jura",
"vallée du Rhône",
"vallée de la Loire",
"vallée du Rhône",
"vallée du Rhône",
"Beaujolais",
"vallée du Rhône",
"vallée du Rhône",
"Languedoc",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Roussillon",
"vallée du Rhône",
"Languedoc",
"Languedoc",
"vallée du Rhône",
"Corse",
"Bourgogne",
"Bourgogne",
"vallée du Rhône",
"Champagne",
"Provence",
"vallée du Rhône",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"Lyonnais",
"vallée de la Loire",
"Provence",
"vallée de la Loire",
"Bourgogne",
"vallée du Rhône",
"Alsace",
"Bordeaux",
"Bourgogne",
"vallée du Rhône",
"Languedoc",
"vallée de la Loire",
"Jura",
"Bordeaux",
"Bourgogne",
"Bourgogne",
"Beaujolais",
"Bourgogne",
"vallée de la Loire",
"vallée du Rhône",
"Sud-Ouest",
"Bordeaux",
"Bordeaux",
"Bordeaux",
"Bordeaux",
"Sud-Ouest",
"Sud-Ouest",
"Provence",
"Lorraine",
"vallée de la Loire",
"Jura",
"Sud-Ouest",
"vallée du Rhône",
"vallée du Rhône",
"Roussillon",
"Roussillon",
"vallée du Rhône",
"Bordeaux",
"Languedoc",
"vallée de la Loire",
"Languedoc",
"Bourgogne",
"Beaujolais",
"Bordeaux",
"Sud-Ouest",
"Sud-Ouest",
"Sud-Ouest",
"Bourgogne",
"vallée du Rhône",
"Bourgogne",
"Bourgogne",
"Bordeaux",
"Bordeaux",
"Bordeaux",
"vallée du Rhône",
"Bourgogne",
"Sud-Ouest",
"Bordeaux",
"vallée du Rhône",
"Bourgogne",
"Sud-Ouest",
"vallée de la Loire",
"Beaujolais",
"Sud-Ouest",
"Jura",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bordeaux",
"Languedoc",
"Bourgogne",
"Provence",
"Languedoc",
"vallée du Rhône",
"Bordeaux",
"Bordeaux",
"vallée du Rhône",
"Bordeaux",
"Sud-Ouest",
"Languedoc",
"Bourgogne",
"Sud-Ouest",
"Bordeaux",
"Bourgogne",
"Roussillon",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",
"Bourgogne",
"Languedoc",
"Languedoc",
"Sud-Ouest",
"Bordeaux",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",
"Sud-Ouest",
"Bourgogne",
"Beaujolais",
"Lorraine",
"Beaujolais",
"Bordeaux",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"vallée de la Loire",
"vallée du Rhône",
"Languedoc",
"Languedoc",
"Languedoc",
"Roussillon",
"Languedoc",
"Corse",
"Bourgogne",
"Bourgogne",
"Bordeaux",
"Bourgogne",
"Bordeaux",
"vallée de la Loire",
"vallée de la Loire",
"Sud-Ouest",
"Provence",
"Corse",
"Bordeaux",
"Bourgogne",
"Bordeaux",
"Bourgogne",
"Provence",
"Bordeaux",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",
"Bordeaux",
"Bordeaux",
"Bourgogne",
"Sud-Ouest",
"vallée de la Loire",
"vallée de la Loire",
"vallée du Rhône",
"vallée de la Loire",
"Bourgogne",
"Roussillon",
"Bourgogne",
"Bourgogne",
"Sud-Ouest",
"vallée de la Loire",
"vallée de la Loire",
"Champagne",
"Savoie",
"Bugey",
"Bourgogne",
"Bourgogne",
"Beaujolais",
"Beaujolais",
"Bourgogne",
"Bourgogne",
"Languedoc",
"Bordeaux",
"Bordeaux",
"vallée du Rhône",
"Bordeaux",
"vallée de la Loire",
"vallée de la Loire",
"vallée du Rhône",
"Bourgogne",
"Bourgogne",
"Bordeaux",
"Bordeaux",
"Bordeaux",
"Bordeaux",
"vallée de la Loire",
"Bourgogne",
"vallée de la Loire",
"vallée de la Loire",
"Sud-Ouest",
"Bordeaux",
"vallée de la Loire",
"Bourgogne",
"Savoie et Bugey",
"vallée du Rhône",
"vallée de la Loire",
"vallée de la Loire",
"vallée du Rhône",
"vallée de la Loire",
"vallée du Rhône",
"Savoie",
"vallée du Rhône",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"Bourgogne",
"vallée de la Loire",
"Bourgogne",

               ];
                
                var accentMap = {
			"é": "e",
			"è": "e",
                        "î": "i",
                        "â": "a"

		};
                
         
                
                var normalize = function( term ) {
			var ret = "";
			for ( var i = 0; i < term.length; i++ ) {
				ret += accentMap[ term.charAt(i) ] || term.charAt(i);
			}
			return ret;
		};
                
               
                
                
                $( "#id_description" ).autocomplete({
			source: function( request, response ) {
                                
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
                                if ($('#id_country').val() == "France") {
				response( $.grep( array[0], function( value ) {
					value = value.label || value.value || value;
                                        return matcher.test( value ) || matcher.test( normalize( value ) );
				}) );
                                }

                               
			},
                        
                        close: function(event, ui) {
                            
                                $('#id_region').val("");
                                
                                if ($('#id_country').val() == "France") {

                                var returned = $('#id_description').val();
                                var index = jQuery.inArray(returned, array[0]);

                               
                                $('#id_region').val($('#id_region').val() + array[1][index]);
                                }
                            }
		});

                
                
	});
</script>


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
                $id="id_".$shortname;
		$line_break = '<br />';
		if ($valtype == 'longtext') {
			$line_break = '';
		}
		echo "<div class=\"ui-widget\"><label for=\"$id\">";
		echo elgg_echo("wine:{$shortname}");
		echo "</label>$line_break";
                
              switch ($shortname) {       
                  
                  
                  case 'country':
                      
                       echo elgg_view("input/{$valtype}", array(
                            'name' => $shortname,
                            'value' => $vars['entity']->$shortname,    
                            'id' => $id,
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
                            'id' => $id
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
