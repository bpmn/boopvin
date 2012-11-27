<?php

/*
 * fiche de dégustaion vin rosé $kind='rose'  
 */


$options_couleur_intensity = array (
                                elgg_echo('degust:couleur_intensity:pale') => 'pale',
				elgg_echo('degust:couleur_intensity:claire') => 'claire',
                                elgg_echo('degust:couleur_intensity:soutenue') => 'soutenue',
                                elgg_echo('degust:couleur_intensity:sombre') => 'sombre');

$options_couleur = array(
				elgg_echo('degust:couleur:rose_pale') => 'rose_pale',
				elgg_echo('degust:couleur:rose') => 'rose',
                                elgg_echo('degust:couleur:rubis') => 'rubis',
                                elgg_echo('degust:couleur:saumon') => 'saumon',
                                elgg_echo('degust:couleur:oignon') => 'oignon',
				elgg_echo('degust:couleur:orange') => 'orange',
				elgg_echo('degust:couleur:cuivre') => 'cuivre');

//olfactif
$options_nez_intensity = array(
				elgg_echo('degust:nez_intensity:ferme')=>'ferme',
                                elgg_echo('degust:nez_intensity:discret') => 'discret',
				elgg_echo('degust:nez_intensity:ouvert') => 'ouvert',
                                elgg_echo('degust:nez_intensity:expressif') => 'expressif',
                                elgg_echo('degust:nez_intensity:exuberant') => 'exuberant');
                                

$options_nez = array(
				elgg_echo('degust:nez:fruit')=>'fruit',
                                elgg_echo('degust:nez:floral') => 'floral',
				elgg_echo('degust:nez:vegetal') => 'vegetal',
                                elgg_echo('degust:nez:mineral') => 'mineral',
                                elgg_echo('degust:nez:epice') => 'epice',
                                elgg_echo('degust:nez:fermentaire') => 'fermentaire',
                                elgg_echo('degust:nez:animal') => 'animal',
                                elgg_echo('degust:nez:empyreumatique') => 'empyreumatique',
                                elgg_echo('degust:nez:bois') =>'bois',
                                elgg_echo('degust:nez:chimique')=>'chimique');

//gustatif

$options_rondeur = array(
				elgg_echo('degust:rondeur:fluide')=>'fluide',
                                elgg_echo('degust:rondeur:souple') => 'souple',
				elgg_echo('degust:rondeur:rond') => 'rond',
                                elgg_echo('degust:rondeur:plein') => 'plein',
                                elgg_echo('degust:rondeur:volumineux') => 'volumineux',
                                elgg_echo('degust:rondeur:opulent') => 'opulent');
     

$options_acidity = array(
				elgg_echo('degust:acidity:mou')=>'mou',
                                elgg_echo('degust:acidity:frais') => 'frais',
				elgg_echo('degust:acidity:droit') => 'droit',
                                elgg_echo('degust:acidity:nerveux') => 'nerveux',
                                elgg_echo('degust:acidity:vert') => 'vert');
                              
$options_alcool = array(
				elgg_echo('degust:alcool:leger')=>'leger',
                                elgg_echo('degust:alcool:integre') => 'integre',
				elgg_echo('degust:alcool:genereux') => 'genereux',
                                elgg_echo('degust:alcool:trop_genereux') => 'trop_genereux');
                                             
                   


$options_longueur = array(
				elgg_echo('degust:longueur:tres_court')=>'tres_court',
                                elgg_echo('degust:longueur:court') => 'court',
				elgg_echo('degust:longueur:moyen') => 'moyen',
                                elgg_echo('degust:longueur:long') => 'long',
                                elgg_echo('degust:longueur:tres_long') => 'tres_long');

//comment
                    
$options_evolution = array(
				elgg_echo('degust:evolution:tres_jeune')=>'tres_jeune',
                                elgg_echo('degust:evolution:jeune') => 'jeune',
				elgg_echo('degust:evolution:amorce') => 'amorce',
                                elgg_echo('degust:evolution:mature') => 'mature',
                                elgg_echo('degust:evolution:evolue') => 'evolue',
                                elgg_echo('degust:evolution:use') => 'use');

?>
