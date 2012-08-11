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

   <div class="error" style="display:none;">
      <img src="images/warning.gif" alt="Warning!" width="24" height="24" style="float:left; margin: -5px 10px 0px 0px; " />

      <span></span>.<br clear="all"/>
    </div>


    <div id="vtab">
        <ul>
		<li class="home"></li>
		<li class="support"></li>
	</ul>
        
        
	<div id="vtab-1"><h4>Degustation</h4>
<?php



                      
            
// creation de la liste
foreach ($degust_profile_fields as $section => $elts) {
     echo '<div><fieldset id="testfield"><legend><div class="legend_class">';
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
            echo '</label>';
            echo '</h2>';
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
        </div> <!-- for Tab 1-->
        <div id="vtab-2"><h4>Help</h4>
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
    </div> <!-- for Tabs-->

