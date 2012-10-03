<?php

/*
 * wine vintages selection
 *
 */


$year=date('Y');
$years=array();
$years[]=" ";
$years['nv']=elgg_echo('wine:nv');
while ($year>1920) {
    
    $years[$year]=$year;
    $year--;
   
}

echo elgg_view('input/dropdown', array(
                            'name' => "annee",
                            'value' => $value,          
                            'options_values' => $years,
                           
                            ));

?>





            

