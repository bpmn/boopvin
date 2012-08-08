<?php

/*
 * addtocave edit form
 * form pour l'ajout d'un vin à un businness
 */



$user =  elgg_get_logged_in_user_entity();
$wine = $vars['entity'];

$options=array('type_subtype_pairs' => (array('group' => 'restobar')),'relationship_guid'=>$user->getGUID(),'relationship' => 'member');
$list_restobars= elgg_get_entities_from_relationship($options);
$list_empty=TRUE;
//echo '<div id="addcave">';

if (is_array($list_restobars)){
    foreach($list_restobars as $restobar){
        if (! $restobar->isIncave($wine))
            $checkboxes_options[$restobar->name]=$restobar->getGUID();
    }
    
   if($checkboxes_options){
       $list_options=array('name'=>'restobar_guid','options'=>$checkboxes_options,'class'=>'input-addcave');
       $list_empty=FALSE;
       echo (elgg_view('input/checkboxes',$list_options));
       
   }else{
       echo (elgg_echo('restobar:addcave:inallbusiness'));
   }
    
}else {
    
    echo (elgg_echo('restobar:addcave:nobusiness'));
}

//echo '<div>';


?>
<div class="elgg-foot">
<?php

if ($wine) {
	echo elgg_view('input/hidden', array(
		'name' => 'wine_guid',
		'value' => $wine->getGUID(),
	));
}


if(!$list_empty)
    echo elgg_view('input/submit', array('value' => elgg_echo('add')));


?>
</div>