<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(dirname(__FILE__) . "/engine/start.php");
$options = array(
    'type_subtype_pairs' => array('object' => 'degust'),
    'limit' => 0,
);
$ia=elgg_set_ignore_access(true);
set_time_limit(0);
$degusts = new ElggBatch('elgg_get_entities', $options, 'update_degust',100);
elgg_set_ignore_access($ia);
function update_degust($degust, $getter, $options){
    $wine=$degust->getContainerEntity();
    $degust->kind=$wine->kind;
    $degust->country=$wine->country;
    $degust->region=$wine->region;
    $degust->appellation=$wine->appellation;
    
    print_r("$degust->title: $degust->kind $degust->country $degust->region  $degust->appellation</br>");
}