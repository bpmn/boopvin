<?php
/**
 * degust edit form
 * 
 * @package ElggWines
 */

if (!elgg_extract('entity', $vars, null,false)){
    $container=get_entity($vars['container_guid']);
    
    if (!($container instanceof ElggGroup))
       echo 'erreur'; 
} else {
    $degust=elgg_extract('entity', $vars, null);
    $container=get_entity($degust->container_guid);
    $annee=$degust->annee;
}


$degust_profile_fields = elgg_get_config('degust');



/*initialisation des options pour les couleurs en fonction du type de vins (blanc, rouge etc..)*/


require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/fiche/{$container->kind}.php");

$notes[]=" ";
for ($note=1;$note<=20;$note=$note+0.5) {   
    $notes[]=$note;
 }

 $options_note=$notes;
 
 /***init des tableaux pour les prix*/
 
$options_currency=array("€"=>"euro","$"=>"dollar","£"=>"livre");
$array_euro=array("","&lt;6€","6€-10€","10€-15€","15€-20€","20€-25€","25€-30€","30€-40€","40€-50€","60€-70€","70€-80€","80€-100€","&gt;100€");
$array_dollar=array("","&lt;$10","$10-$15","$15-$20","$20-$25","$25-$30","$30-$40","$40-$50","$60-$70","$70-$80","$80-$100","&lt;$100");
$array_livre=array("","&lt;£10","£10-£15","£15-£20","£20-£25","£25-£30","£30-£40","£40-£50","£60-£70","£70-£80","£80-£100","&gt;£100");
 
 if ($degust->currency){
     $currency_value=$degust->currency;
     eval('$options_price=$array_'.$degust->currency.';');
     
     }
 else {
     $currency_value='euro';
     $options_price=$array_euro;
}
 

 
?>






   
<?php
// groups and other users get owner block
// si la fiche degust n'existe pas elgg_get_page_owner_entity(); renvoie l'entitÃ© vin cas crÃ©ation d'une degust
// dans le cas oÃ¹ la fiche degust existe dÃ©jÃ  elgg_get_page_owner_entity(); renvoie l'entitÃ© degust


$metadata=$container->kind;

echo "<div data-winetype=\"{$metadata}\" id=\"metadatafield\"></div>";
echo "<div data-overlay=\"overlay_degustation\" id=\"metadatafield_overlay\"></div>";

// entÃªte de la dÃ©gustation

echo '<div class="degust-side-head">';
//echo "$container->name <br/>";
echo elgg_view_entity($container);
//echo elgg_view_entity_icon($container, 'medium');



// affichage du millÃ©sime     

echo elgg_echo("wine:vintage") . ': ' ;
if (isset($degust->annee)) {    // la fiche degust existe dÃ©jÃ  (profile ou edit
    if ($degust->annee != 'nv') {
        echo $degust->annee;
    } else {
        echo elgg_echo("wine:nv");
    }
} else {
    $year = date('Y');

    $years[''] = "";
    $years['nv'] = elgg_echo('wine:nv');
    while ($year > 1920) {

        $years[$year] = $year;
        $year--;
    }
echo '<fielset>';
echo "<div class=\"validate_error_label\">";

echo '<label for="id_years"></label>';

    echo elgg_view('input/dropdown', array(
        'name' => "annee",
        'options_values' => $years,
        'class' => "required",
        'id' => "id_years"
    ));
echo '</div>';

echo '</fielset>';
};


echo '</div>';




//champ de la degustation
            
// creation de la liste
foreach ($degust_profile_fields as $section => $elts) {
     echo "<div><fieldset><legend><div class=\"legend_class\">";
     echo elgg_echo("degust:{$section}");

     echo '</div></legend>';
     

     foreach($elts as $shortname=>$valtype){
         eval('$options=$options_'.$shortname.';');
         eval('$option_values=$option_values_'.$shortname.';');
         
         if ($options || $option_values || $valtype=='text' || $valtype=='hidden'|| $valtype=='longtext'){
            
            //echo "<center>" ;
            echo "<div class=\"validate_error_label\">";
    
            echo '<label>';
            echo '<h2>';
            echo elgg_echo("degust:{$shortname}");
            echo '</h2>';
            echo '</label>';
            
            echo "</div>";

            //echo "</center>" ;


            $variables=array('name'=>$shortname,
                        'value'=>$degust->$shortname,
                        'align'=>'horizontal',
                        'options'=>$options,
                        'option_values'=>$option_values,
                        'class'=>'input-degust',
                        
              );
            
            $dim_options=sizeof($options);
            echo "<div data-dim=\"{$dim_options}\" id=\"button_select{$shortname}\">";
         
            //rajout du prix dans le paragraphe de la note
            if ($shortname =="note"){
                
                       echo"<div id=\"degust-price\">";
                       echo elgg_echo('degust:price')." ";
                       echo elgg_view("input/dropdown",array(
                                                        'value'=>$degust->price,
                                                        'name'=>'price',
                                                        'align'=>'horizontal',
                                                        'options'=>$options_price));
                       echo elgg_view("input/radio",array(
                                                        'value'=>$currency_value,
                                                        'name'=>'currency',
                                                        'align'=>'horizontal',
                                                        'options'=>$options_currency));
                       echo"</div>";
                }  
            
            
            echo elgg_view("input/{$valtype}",$variables);
            
     
            echo "</div>";

            /*** le prix **/
     
            
            
            }
         
         }
           


         
    echo '</fieldset>
</div>';          
}	

?>


<div class="elgg-foot">
<?php

if (isset($vars['entity'])) {
	echo elgg_view('input/hidden', array(
		'name' => 'degust_guid',
		'value' => $degust->getGUID(),
	));
        
        echo elgg_view('input/hidden', array(
		'name' => 'annee',
		'value' => $annee
	));
}       
   /*     echo elgg_view('input/hidden', array(
		'name' => 'complexity',
		'value' => $degust->complexity,
                'id'=>'input_complexity'
	));
}else{

        echo elgg_view('input/hidden', array(
		'name' => 'complexity',
                'id'=>'input_complexity'
	));
}*/
echo elgg_view('input/hidden', array(
		'name' => 'container_guid',
		'value' => $container->getGUID(),
	));



echo elgg_view('input/submit', array('value' => elgg_echo('save')));



if (isset($vars['entity']) && $degust->canEdit()) {
	$delete_url = 'action/degusts/delete?guid=' . $vars['entity']->getGUID();
	echo elgg_view('output/degust_confirmlink', array(
		'text' => elgg_echo('degust:delete'),
		'href' => $delete_url,
		'confirm' => elgg_echo('degust:deletewarning'),
		'class' => 'elgg-button elgg-button-delete float-alt',
	));
}
?>
</div>

