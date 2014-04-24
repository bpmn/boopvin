


<?php
/**
 * sidebar filter 
 * for the wine/all page
 * 
 */


$action="action/profile/degust_filter";
$form_vars = array(
	'enctype' => 'multipart/form-data',
	'class' => 'elgg-form-alt',
        'id' => 'filter',
        'action'=>$action
);

//echo elgg_view_form("wines/filter?filter=$selected_tab",$form_vars,array());

echo elgg_view_form('profile/degust_filter',$form_vars,$vars);



