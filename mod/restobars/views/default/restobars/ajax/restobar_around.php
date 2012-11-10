<?php

/*
 * construction de la vue pour la liste des restobars 
 * des alentours contenant le vin visualisé.
 */



elgg_push_context('distance');
/*$lat_user=$vars['latitude'];
$long_user=$vars['longitude'];
$wine_guid=$vars['guid'];*/
$lat_user=(float)get_input('latitude');
$long_user=(float)get_input('longitude');
$dist_max=60;

$restobars = elgg_get_entities(array(
        'types'=>'group',
        'subtypes'=>'restobar',
	'limit' => 10000,

));

$list_restobar=array();
foreach($restobars as $elts){
    //todo rajouter le test paiement effectué
    if(($dist=$elts->distance($lat_user,$long_user))<$dist_max){
        $elts->dist=$dist; // on crée une metadata temporelle (dist) pour l'affichage de la distance ds la vue de l'entité, elle est ensuite supprimée
        $list_restobar[]=$elts;     
    }
}

    if (empty($list_restobar)) {
        echo elgg_echo("wine:restobar:nosuggestion");
    } else {
        usort($list_restobar, "dist_cmp");
        echo elgg_view_entity_list($list_restobar, array("limit" => 10000, 'full_view' => FALSE, 'pagination' => true,'list_class'=>'list-style-all-resto'));
    }


elgg_pop_context();


function dist_cmp($a, $b) {
    $al = (int) $a->dist;
    $bl = (int) $b->dist;
    if ($al == $bl) {
        return 0;
    }
    return ($al < $bl) ? -1 : +1;
}

?>