<?php
/**
 * Elgg one-column layout
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content string
 * @uses $vars['class']   Additional class to apply to layout
 */

//$class = 'elgg-layout degust-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

?>
<div class="<?php echo $class; ?>">
	<div class="degust-main">
	
            
     <div class="error" style="display:none;">
      <img src="images/warning.gif" alt="Warning!" width="24" height="24" style="float:left; margin: -5px 10px 0px 0px; " />

      <span></span>.<br clear="all"/>
    </div>


    <div id="vtab">
        <ul>
		<li class="home"></li>
		<li class="support"></li>
	</ul>
        
        
	<div id="vtab-1"><h4><?php echo (elgg_echo('degust')); ?></h4>
            <?php
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


            echo $vars['tab1'];
		
		
	?>


        </div> <!-- for Tab 1-->
        <div id="vtab-2"><h4><?php echo ( elgg_echo('degust:help'));?></h4>
            <?php echo $vars['tab2'];?>
        </div>
    </div> <!-- for Tabs-->


    
 </div>   
</div>
