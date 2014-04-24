<?php

/*
 * gestion des fichiers des requête ajax filtres sous la page cave d'un restobar
 */
//require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

$kind = get_input('kind');
$country = get_input('country');
$region = get_input('region');
$appellation = get_input('appellation');
$metadata_name_value_pairs = array();
$relationship = 'incave';
$relationship_guid =get_input('guid');
elgg_set_page_owner_guid($relationship_guid);
$inverse_relationship = false;
$getter = 'elgg_get_entities_from_relationship';

$base_url ='action/restobars/cave_filter?guid='.$relationship_guid;

elgg_set_context('restobar_cave');


if ($kind != "all") {
    $metadata_name_value_pairs[0] = array('name' => 'kind',
        'value' => "$kind",
        'operand' => '=',
        'case_sensitive' => False);
}
if ($country != "all") {
    array_push($metadata_name_value_pairs, array('name' => 'country',
        'value' => "$country",
        'operand' => '=',
        'case_sensitive' => False));

    if (isset($region) && $region != "all") {
        array_push($metadata_name_value_pairs, array('name' => 'region',
            'value' => '%' . $region . '%',
            'operand' => 'like',
            'case_sensitive' => False));
        if (isset($appellation) && $appellation != "all") {
            $pattern = '(VdlT|DOCG|DOC|DO|IGT|VP|VC)';
            $appellation = preg_replace($pattern, '', $appellation);
            array_push($metadata_name_value_pairs, array('name' => 'appellation',
                'value' => '%' . $appellation . '%',
                'operand' => 'like',
                'case_sensitive' => False));
        }
    }
}

//if (!empty($metadata_name_value_pairs)) {
$content = elgg_list_entities(array(
    'type_subtype_pairs' => array('group' => 'wine'),
    'full_view' => false,
    'list_class' => 'list-style-all',
    'pagination' => true,
    'base_url' => $base_url,
    'relationship' => $relationship,
    'relationship_guid' => $relationship_guid,
    'inverse_relationship' => $inverse_relationship,
    'metadata_name_value_pairs' => $metadata_name_value_pairs), $getter);


$count = $getter(array(
    'type_subtype_pairs' => array('group' => 'wine'),
    'relationship' => $relationship,
    'relationship_guid' => $relationship_guid,
    'inverse_relationship' => $inverse_relationship,
    'count'=>true,
    'metadata_name_value_pairs' => $metadata_name_value_pairs));



if (!$content) {
    $content = '<ul class="elgg-list">' . elgg_echo('wine:none') . '</ul>';
}
/* } else {
  $content = elgg_list_entities(array(
  'type_subtype_pairs' => array('group' => 'wine'),
  'full_view' => false,
  'list_class' => 'list-style-all',
  'pagination' => true,
  'base_url' => 'action/wines/filter'));

  if (!$content) {
  $content = '<ul class="elgg-list">' . elgg_echo('wine:none') . '</ul>';
  }
  }; */

$result=array("content"=>$content,"count"=>elgg_echo("wine:count",array($count)));


echo json_encode($result);
exit;