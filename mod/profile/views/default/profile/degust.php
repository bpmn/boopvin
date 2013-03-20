<?php

/*
 * affichage des dégustations sous le profile d'un utilisateur 
 * $vars['owner_guid']=guid de l'utilisateur de du profil concerné.
 */

   $user_guid=$vars['owner_guid']; 
   $options = array(
	'type' => 'object',
	'subtype' => 'degust',
	'owner_guid' => $user_guid,
	'limit' => 30,
	'full_view' => false,
	'pagination' => true
);
         
        //des degustations de l'utilisateur encadré d'un div
        $list_user_degust=elgg_list_entities($options);
        $options['count']=true;
        $count_user_degust="<sup>".elgg_get_entities($options)."</sup>";?>
        <div id=list_user_degust class=degust_list>
        <h2 id="score"> <?php echo (elgg_echo("profile:degust:count",array($count_user_degust))) ;?></h2>
        <?php echo "$list_user_degust" ?></div>;
       
