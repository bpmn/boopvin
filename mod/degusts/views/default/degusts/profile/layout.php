<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



$degust_profile_fields = elgg_get_config('degust_profile');

/*initialisation des options pour les couleurs en fonction du type de vins (blanc, rouge etc..)*/
$degust=$vars['entity'];
$container=get_entity($vars['entity']->container_guid);
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/fiche/{$container->kind}.php");
?>
<!--<fieldset>-->
<div id="degust-fiche-left">

<?php
/*
<table border="1">
<tr>
<td>row 1, cell 1</td>
<td>row 1, cell 2</td>
</tr>
<tr>
<td>row 2, cell 1</td>
<td>row 2, cell 2</td>
</tr>
</table>
*/

//echo ('<table>');

foreach ($degust_profile_fields as $section => $elts) {
    echo ('<div class="degust-feuille-header">');
               // echo ('<td>');

    echo ('<h1>'.elgg_echo("degust:{$section}").'</h1>');
     //echo "<div class='degust-profile-fiche'>";
                // echo ('</td>');

  
     foreach($elts as $shortname=>$valtype){
         $val=$degust->$shortname;
         if ($val){
            echo ('<div class="degust-feuille-content">');
            eval('$options=$options_'.$shortname.';');
            if(isset($options) || $valtype=='hidden' || $valtype=='text' || $valtype=='longtext' || $shortname=='note' || $shortname=='price'){ 
            //if(isset($options)|| $valtype=='text' || $valtype=='longtext' || $shortname=='note'){ 
                //echo '<label>';
             
                //echo ('<td>');
                echo ('<div class="degust-feuille-content-title">');

                echo elgg_echo("degust:{$shortname}").': ';
                //echo '</label>';
                //echo ('</td>');
                echo ('</div>');
            

                //echo ('<td>');


                echo ('<div class="degust-feuille-content-value">');
            
                if ($valtype=='text' || $valtype=='longtext' || $shortname=='note' || $shortname=='price'){
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
            
                /* complexité*/
                if ($valtype=='hidden'){
                    $valtype='text';
                } 
         
                echo elgg_view("output/{$valtype}",$variables);

                echo ('</div>');
                echo ('<div class="degust-feuille-content-clear"></div>');

                //echo ('</td>');
                  
                echo ('</div>');
            }
         }  

        }
    echo "</div>";
    echo '<div class="vigne_separator"></div>';
    
}

//echo ('</table>');

//echo "<div>";	
?>


<div class="elgg-foot">
<?php

echo elgg_view_menu('edit_degust', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));



?>
</div>
<!--</fieldset>-->




