<?php

/*
 * addtocave edit form
 * form pour l'ajout d'un vin à un businness
 */


$user_login =  elgg_get_logged_in_user_entity();
$user = $vars['entity'];

$options=array('type_subtype_pairs' => (array('group' => 'restobar')),'owner_guids'=>array($user_login->getGUID()));
$list_restobars= elgg_get_entities($options);
$list_empty=TRUE;
//echo '<div id="addcave">';

if (count($list_restobars) != 0){
    foreach($list_restobars as $restobar){
        if (!$restobar->isMember($user))
            $checkboxes_options[$restobar->name]=$restobar->getGUID();
    }
    
   if($checkboxes_options){
       $list_options=array('name'=>'restobar_guid','options'=>$checkboxes_options,'class'=>'input-addcave');
       $list_empty=FALSE;
       echo (elgg_view('input/checkboxes',$list_options));
       
   }else{
       echo (elgg_echo('restobar:addmember:inallbusiness'));
   }
    
}else {
    
    echo (elgg_echo('restobar:addmember:nobusiness'));
}

//echo '<div>';


?>
<div class="elgg-foot">
<?php

if ($user) {
	echo elgg_view('input/hidden', array(
		'name' => 'user_guid',
		'value' => $user->getGUID(),
	));
}


if(!$list_empty)
    echo elgg_view('input/submit', array('value' => elgg_echo('add')));


?>
</div>