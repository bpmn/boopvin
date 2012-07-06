<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Load configuration
function profile_array_decoder(&$v) {
	$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
}

// Get wine fields
$input = array();
foreach ($CONFIG->degust as $index => $elts) {
    foreach ($elts as $shortname => $valuetype) {
	// another work around for Elgg's encoding problems: #561, #1963
	$input[$shortname] = get_input($shortname);
	if (is_array($input[$shortname])) {
		array_walk_recursive($input[$shortname], 'profile_array_decoder');
	} else {
		$input[$shortname] = html_entity_decode($input[$shortname], ENT_COMPAT, 'UTF-8');
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}
}

$container_guid=get_input('container_guid');
$annee=get_input('annee');



$user = elgg_get_logged_in_user_entity();

$degust_guid = (int)get_input('degust_guid');
$new_degust_flag = $degust_guid == 0;

$degust = new ElggDegust($degust_guid); // load if present, if not create a new wine
if (($degust_guid) && (!$degust->canEdit())) {
	register_error(elgg_echo("degust:cantedit"));

	forward(REFERER);
}

// Assume we can edit or this is a new wine
if (sizeof($input) > 0) {
	foreach($input as $shortname => $value) {
            if ($value)
		$degust->$shortname = $value;
	}


}

$degust->container_guid=$container_guid;
$degust->annee=$annee;
$degust->access_id=ACCESS_PUBLIC;

$degust->save();

// wine creator needs to be member of new wine and river entry created
//if ($new_degust_flag) {
	
//	add_to_river('river/degust/create', 'create', $user->guid, $wine->guid, $wine->access_id);
//}

system_message(elgg_echo("degust:saved"));

forward($degust->getUrl());










?>
