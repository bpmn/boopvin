<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$degust_profile_fields = elgg_get_config('degust');

/*initialisation des options pour les couleurs en fonction du type de vins (blanc, rouge etc..)*/
$degust=$vars['entity'];
$container=get_entity($vars['entity']->container_guid);
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/fiche/{$container->kind}.php");
?>
<fieldset>
<?php
foreach ($degust_profile_fields as $section => $elts) {
    
     echo ('<h1>'.elgg_echo("degust:{$section}").'</h1>');
     echo "<div class='degust-profile-sections'>";
    
    
  
     foreach($elts as $shortname=>$valtype){
         eval('$options=$options_'.$shortname.';');
         if(isset($options) || $valtype=='text' || $valtype=='longtext' || $shortname=='note'){ 
            echo '<label>';
            echo elgg_echo("degust:{$shortname}").': ';
            echo '</label>';

            $val=$degust->$shortname;
            
            if ($valtype=='text' || $valtype=='longtext' || $shortname=='note'){
              $value=$val;  
            }else{
                if(is_array($val)){
                    $value=array();
                     foreach($val as $elt){
                        $value[]=elgg_echo("degust:$shortname:$elt");
                     }
            }else{
                    $value=elgg_echo("degust:$shortname:$val");
                 }
            }
                
               
        
            
            $variables=array(
                        'value'=>$value,
                        );
         
         
            echo elgg_view("output/{$valtype}",$variables).'</br>';
            }
         
        }
    echo "</div>";
}


//echo "<div>";			
?>


<div class="elgg-foot">
<?php

echo elgg_view_menu('edit_degust', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));



?>
</div>

</fieldset>




