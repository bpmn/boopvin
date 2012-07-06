<?php
/**
 * degust edit form
 * 
 * @package ElggWines
 */

if (!elgg_extract('entity', $vars, null,false)){
    $container=get_entity($vars['container_guid']);
    $annee=get_input('annee');
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


for ($note=1;$note<=20;$note++) {   
    $notes[]=$note;
 }

 $options_note=$notes;
 
 
 ?>



<?php



                      
            
// creation de la liste
foreach ($degust_profile_fields as $section => $elts) {
     echo '<div><fieldset id="testfield"><legend>';
     echo elgg_echo("degust:{$section}");
     echo '</legend>';
     foreach($elts as $shortname=>$valtype){
         eval('$options=$options_'.$shortname.';');
         eval('$option_values=$option_values_'.$shortname.';');
         
         if ($options || $option_values || $valtype=='text' || $valtype=='longtext'){
            
            echo "<center>" ;
            echo '<label>';
            echo elgg_echo("degust:{$shortname}");
            echo '</label>';
            echo "</center>" ;


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
}
echo elgg_view('input/hidden', array(
		'name' => 'container_guid',
		'value' => $container->getGUID(),
	));

echo elgg_view('input/hidden', array(
		'name' => 'annee',
		'value' => $annee
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
