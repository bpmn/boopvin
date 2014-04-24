<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$kind = get_input('kind');
$country = get_input('country');
$region = get_input('region');
$appellation = get_input('appellation');
$metadata_name_value_pairs = array();

$getter = 'elgg_get_entities_from_metadata';
$owner_guid = get_input('owner_guid');
$base_url = 'action/profile/degust_filter';


elgg_set_context('profile');



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
    'type_subtype_pairs' => array('object' => 'degust'),
    'full_view' => false,
    //'list_class' => 'list-style-all',
    'pagination' => true,
    'limit'=>14,
    'base_url' => $base_url,
    'owner_guid'=>$owner_guid,
    'metadata_name_value_pairs' => $metadata_name_value_pairs), $getter);


$count = elgg_get_entities_from_metadata(array(
    'type_subtype_pairs' => array('object' => 'degust'),
    'owner_guid'=>$owner_guid,
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


$result=array("content"=>$content,"count"=>"<sup>".elgg_echo("profile:degust:count",array($count))."</sup>");


echo json_encode($result);
exit;