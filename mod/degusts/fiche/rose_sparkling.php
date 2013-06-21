<?php

/*
 * fiche de dégustaion vin rosé effervescent $kind='rose_sparkling'  
 */


//Visuel



$options_couleur = array(
				elgg_echo('degust:couleur:rose_pale') => 'rose_pale',
				elgg_echo('degust:couleur:rose') => 'rose',
                                elgg_echo('degust:couleur:rubis') => 'rubis',
                                elgg_echo('degust:couleur:saumon') => 'saumon',
                                elgg_echo('degust:couleur:oignon') => 'oignon',
				elgg_echo('degust:couleur:orange') => 'orange',
				elgg_echo('degust:couleur:cuivre') => 'cuivre');



$options_mousse = array(        elgg_echo('degust:mousse:inexistante')=>'inexistante',
                                elgg_echo('degust:mousse:faible') => 'faible',
				elgg_echo('degust:mousse:abondante') => 'abondante',
                                elgg_echo('degust:mousse:persistante') => 'persistante');

$options_bulle = array(
				elgg_echo('degust:bulle:tres_fine')=>'tres_fine',
                                elgg_echo('degust:bulle:fine') => 'fine',
				elgg_echo('degust:bulle:moyenne') => 'moyenne',
                                elgg_echo('degust:bulle:grossiere') => 'grossiere');

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

//Gustatif

$options_rondeur = array(
				elgg_echo('degust:rondeur:franche')=>'franche',
                                elgg_echo('degust:rondeur:discrete') => 'discrete');
     

$options_acidity = array(
				elgg_echo('degust:acidity:discrete')=>'discrete',
                                elgg_echo('degust:acidity:elegante') => 'elegante',
				elgg_echo('degust:acidity:droit') => 'droit',
                                elgg_echo('degust:acidity:nerveux') => 'nerveux',
                                elgg_echo('degust:acidity:vert') => 'vert');
                              

                  
$options_palet_bulle = array(
				elgg_echo('degust:palet_bulle:tres_fine')=>'tres_fine',
                                elgg_echo('degust:palet_bulle:fine') => 'fine',
				elgg_echo('degust:palet_bulle:moyenne') => 'moyenne',
                                elgg_echo('degust:palet_bulle:grossiere') => 'grossiere');
                                

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
