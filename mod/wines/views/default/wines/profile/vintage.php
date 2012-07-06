<?php

/*
 * wine vintages selection
 *
 */


$year=date('Y');
$years=array();
while ($year>1920) {
    
    $years[$year]=$year;
    $year--;
   
}

$entity=  elgg_get_page_owner_entity();
$url=$entity->getURL();
$value=  get_input('annee');

    

if ($entity->vintage=='v'){
echo elgg_view('input/dropdown', array(
                            'name' => "year",
                            'value' => $value,          
                            'options_values' => $years,
                            'data-url'=>$url,
                            'id'=>'vintage'
                            ));


}else {
   echo elgg_echo('wine:nv');
}
?>





            

