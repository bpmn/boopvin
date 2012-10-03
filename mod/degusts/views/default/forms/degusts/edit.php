<?php
/**
 * degust edit form
 * 
 * @package ElggWines
 */

if (!elgg_extract('entity', $vars, null,false)){
    $container=get_entity($vars['container_guid']);
    
    if (!($container instanceof ElggGroup))
       echo 'erreur'; 
} else {
    $degust=elgg_extract('entity', $vars, null);
    $container=get_entity($degust->container_guid);
    $annee=$degust->annee;
}


$degust_profile_fields = elgg_get_config('degust');



/*initialisation des options pour les couleurs en fonction du type de vins (blanc, rouge etc..)*/


require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/fiche/{$container->kind}.php");

$notes[]=" ";
for ($note=1;$note<=20;$note++) {   
    $notes[]=$note;
 }

 $options_note=$notes;
 
 
 ?>

   
<?php
// groups and other users get owner block
// si la fiche degust n'existe pas elgg_get_page_owner_entity(); renvoie l'entité vin cas création d'une degust
// dans le cas où la fiche degust existe déjà elgg_get_page_owner_entity(); renvoie l'entité degust


$metadata=$container->kind;

echo "<div data-winetype=\"{$metadata}\" id=\"metadatafield\"></div>";
echo "<div data-overlay=\"overlay_degustation\" id=\"metadatafield_overlay\"></div>";

// entête de la dégustation

echo '<div class="degust-side-head">';

echo elgg_view_entity_icon($container, 'medium');
echo "$container->name <br/>";
if ($container->cuvee)
    echo "$container->cuvee <br/>";

// affichage du millésime     

echo elgg_echo("wine:vintage") . ': ' ;
if (isset($degust->annee)) {    // la fiche degust existe déjà (profile ou edit
    if ($degust->annee != 'nv') {
        echo $degust->annee;
    } else {
        echo elgg_echo("wine:nv");
    }
} else {
    $year = date('Y');
    $years = array();
    $years[] = " ";
    $years['nv'] = elgg_echo('wine:nv');
    while ($year > 1920) {

        $years[$year] = $year;
        $year--;
    }
echo '<fielset>';
    echo elgg_view('input/dropdown', array(
        'name' => "annee",
        'options_values' => $years,
        'class'=>'required'
    ));
echo '</fielset>';
};


echo '</div>';




//champ de la degustation
            
// creation de la liste
foreach ($degust_profile_fields as $section => $elts) {
     echo "<div><fieldset><legend><div class=\"legend_class\">";
     echo elgg_echo("degust:{$section}");

     echo '</div></legend>';
     

     foreach($elts as $shortname=>$valtype){
         eval('$options=$options_'.$shortname.';');
         eval('$option_values=$option_values_'.$shortname.';');
         
         if ($options || $option_values || $valtype=='text' || $valtype=='longtext'){
            
            //echo "<center>" ;
            echo "<div class=\"validate_error_label\">";
                
            echo '<label>';
            echo '<h2>';
            echo elgg_echo("degust:{$shortname}");
            echo '</h2>';
            echo '</label>';
            
            echo "</div>";

            //echo "</center>" ;


            $variables=array('name'=>$shortname,
                        'value'=>$degust->$shortname,
                        'align'=>'horizontal',
                        'options'=>$options,
                        'option_values'=>$option_values,
                        'class'=>'input-degust'
              );
            
            
            echo '<div id="button_select'.$shortname.'">';
         
            echo elgg_view("input/{$valtype}",$variables);
            
            echo "</div>";


            
            
            }
         
         }
           


         
    echo '</fieldset>
</div>';          
}	

?>


<div class="elgg-foot">
<?php

if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'degust_guid',
		'value' => $degust->getGUID(),
	));
        
        echo elgg_view('input/hidden', array(
		'name' => 'annee',
		'value' => $annee
	));
}
echo elgg_view('input/hidden', array(
		'name' => 'container_guid',
		'value' => $container->getGUID(),
	));



echo elgg_view('input/submit', array('value' => elgg_echo('save')));



if (isset($vars['entity']) && $degust->canEdit()) {
	$delete_url = 'action/degusts/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/confirmlink', array(
		'text' => elgg_echo('degust:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('degust:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>

