
<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$restobars=elgg_get_entities(array('type'=>'group','subtype'=>'restobar','limit'=>200));

foreach ($restobars as $restobar) {
echo $restobar->name.'</br>' ;
if($restobar->name == "Vincent&Co"){	
    echo $restobar->name.'</br>' ;
    echo $restobar->getLatitude().'</br>'; 
    echo $restobar->getLongitude().'</br>';
}    
	
        
}
?>

