


<?php
/**
 * sidebar filter 
 * for the wine/all page
 * 
 */

$entity_guid=$vars['entity_guid'];
$wine_number=$vars['wine_number'];
$action="action/restobars/cave_filter?guid=".$entity_guid;
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
        'id' => 'filter',
        'action'=>$action
);

//echo elgg_view_form("wines/filter?filter=$selected_tab",$form_vars,array());

echo "<h3 id=\"wine_search_filter\">".elgg_echo('wine:filter')."</h3>";
echo elgg_view_form('restobars/filter',$form_vars,array()); 

//nombre de vins trouvés, div rempli par le résultat de la requête ajax.
echo '<div ><h2 class="wine_count">'.elgg_echo("wine:count",array($wine_number)). '<h2></div>';

