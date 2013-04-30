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
		$input[$shortname] = _elgg_html_decode($input[$shortname]);
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}
}

$container_guid=get_input('container_guid');
$annee=get_input('annee');
//$complexity=get_input('complexity');

$price = _elgg_html_decode(get_input('price'));
$currency=_elgg_html_decode(get_input('currency'));


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
$container=  get_entity($container_guid);
$title= $container->name." ".$annee;

$description= elgg_get_logged_in_user_entity()->name;

$degust->container_guid=$container_guid;
$degust->annee=$annee;
$degust->access_id=ACCESS_LOGGED_IN;
$degust->title=$title;
$degust->description=$description;
$degust->price=$price;
$degust->currency=$currency;
//$degust->complexity=$complexity;
$degust->save();

// wine creator needs to be member of new wine and river entry created
if ($new_degust_flag) {
	
	add_to_river('river/object/degust/create','create', $user->guid, $degust->guid);
}

system_message(elgg_echo("degust:saved"));

$page_owner_guid=get_input('page_owner_guid');
$page_owner_entity = get_entity($page_owner_guid);


$options = array(
                 'type' => 'object',
                 'subtype' => 'degust',
                 'limit' => 10,
                 'full_view' => false,
                 'pagination' => true,
         );
if (elgg_instanceof($page_owner_entity,'user')){
   $options['owner_guid'] =$page_owner_guid;
}else{
   $options['container_guid'] =$page_owner_guid; 
}

echo elgg_list_entities($options);

// Forward to the page the action occurred on
//forward(REFERER);



