<?php
/**
 * Elgg sidebar contents pour la fiche de degustation
 * Contient en "dur" l'info sur le vin degusté
 * le reste du contenu est variable et est contenu dans $vars['sidebar']
 * @uses $vars['sidebar'] Optional content that is displayed at the bottom of sidebar
 */


// groups and other users get owner block
// si la fiche degust n'existe pas elgg_get_page_owner_entity(); renvoie l'entité vin cas création d'une degust
// dans le cas où la fiche degust existe déjà elgg_get_page_owner_entity(); renvoie l'entité degust
$degust= elgg_get_page_owner_entity();
if ($degust instanceof ElggObject)
    $owner=get_entity($degust->getContainerGUID());
else
    $owner=$degust;

echo '<div class="degust-side-head">';

	 echo elgg_view_entity_icon($owner,'medium');
         echo "$owner->name <br/>";
         if ($owner->cuvee)
                echo "$owner->cuvee <br/>";
  
// affichage du millésime     
    
         if ($owner->vintage=='v'){
             if (isset($degust->annee)){    // la fiche degust existe déjà (profile ou edit
                 echo $degust->annee;
             }else{
                $annee=get_input('annee');  // cas ou la fiche de degust n'existe pas "add"
                echo $annee;
             }
         }else {
            echo elgg_echo('wine:nv');
         }
         
     
echo '</div>';

// optional 'sidebar' parameter
if (isset($vars['sidebar'])) {
	echo $vars['sidebar'];
}

?>


            
	




<?php
    
    //echo elgg_view('page/elements/owner_block', $vars);

//echo elgg_view_menu('page', array('sort_by' => 'name'));

// optional 'sidebar' parameter
//if (isset($vars['sidebar'])) {
	//echo $vars['sidebar'];
//}?>


