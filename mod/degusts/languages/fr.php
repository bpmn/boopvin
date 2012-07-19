<?php
/**
 *  Degust 1.8 plugin language pack
 *
 * @package Wine
 */

$french = array(
    
  
  //Visuel   
    
    'degust:visuel' => "Analyse Visuelle",
    'degust:olfactif' => "Analyse Olfactive",
    'degust:gustatif' => "Analyse Gustative",
    'degust:comment' => "Commentaires et notes",
    
    
    'degust:couleur_intensity'=>'Intensité de la robe',             
    'degust:couleur'=>'Le couleur',
    'degust:reflet'=>'Les Reflets',
    'degust:bulle'=>'La Bulle',
    
    
    'degust:couleur_intensity:pale' => 'pâle',
    'degust:couleur_intensity:claire' => 'claire',
    'degust:couleur_intensity:soutenue' => 'soutenue',
    'degust:couleur_intensity:sombre' => 'sombre',

    
  
    'degust:couleur:grenat' => 'grenat',
    'degust:couleur:carmin' => 'carmin',
    'degust:couleur:pourpre' => 'pourpre',
    'degust:couleur:rubis'=> 'rubis',
    'degust:couleur:tuile' => 'tuile',


    'degust:color:jaune_pale' => 'jaune pâle',
    'degust:color:or_pale' => 'or pâle',
    'degust:color:or' => 'or',
    'degust:color:cuivre' => 'cuivre',
    'degust:color:ambre' => 'ambre',
  
    'degust:color:rose_pale' => 'rose pâle',
    'degust:color:rose' => 'rose',
    'degust:color:saumon'=> 'saumon',
    'degust:color:rubis' => 'rubis',
    'degust:color:oignon' => 'oignon',
    'degust:color:orange' => 'orange',
    'degust:color:cuivre' => 'cuivre',
    
    
    'degust:reflet:violace_jeune'=>'violacé jeune',
    'degust:reflet:violine' => 'violine',
    'degust:reflet:grenat' => 'grenat',
    'degust:reflet:carmin' => 'carmin',
    'degust:reflet:brique' => 'brique',
    'degust:reflet:brun' => 'brun',
    
    'degust:reflet:vert' => 'vert',
    'degust:reflet:gris' => 'gris',
    'degust:reflet:or' => 'or',
    'degust:reflet:dore' => 'doré',
    
             
//Olfactif
    'degust:nez_intensity'=>'L\'intensité',
    'degust:nez'=>'Les arômes',    // résultat des checkboxes sous forme de tableau
    'degust:arome'=>'text',        // description texte des arôme
    'degust:complexity'=>'Complexité',   // en fonction du nombres de checkbox cochées.
    
  
    'degust:nez_intensity:ferme'=>'fermé',
    'degust:nez_intensity:discret' => 'discret',
    'degust:nez_intensity:ouvert' => 'ouvert',
    'degust:nez_intensity:expressif' => 'expressif',
    'degust:nez_intensity:exuberant' => 'exubérant',
                                


    'degust:nez:fruit'=>'fruit',
    'degust:nez:floral' => 'floral',
    'degust:nez:vegetal' => 'végétal',
    'degust:nez:mineral' => 'minéral',
    'degust:nez:epice' => 'épicé',
    'degust:nez:fermentaire' => 'fermentaire',
    'degust:nez:animal' => 'animal',
    'degust:nez:bois' =>'bois',
    'degust:nez:chimique'=>'chimique',

//gustatif

    'degust:rondeur:fluide'=>'fluide',
    'degust:rondeur:souple' => 'souple',
    'degust:rondeur:rond' => 'rond',
    'degust:rondeur:plein'=> 'plein',
    'degust:rondeur:volumineux' => 'volumineux',
    'degust:rondeur:opulent' => 'opulent',
     

    'degust:acidity:mou'=>'mou',
    'degust:acidity:frais' => 'frais',
    'degust:acidity:droit' => 'droit',
    'degust:acidity:mineral' => 'nerveux',
    'degust:acidity:vert' => 'vert',
                            
    'degust:alcool:leger'=>'léger',
    'degust:alcool:integre' => 'intégré',
    'degust:alcool:genereux' => 'généreux',
    'degust:alcool:trop_genereux' => 'trop généreux',
                                             
    'degust:tanin:souple'=>'souples',
    'degust:tanin:fondu' => 'fondus',
    'degust:tanin:serre' => 'serrés',
    'degust:tanin:rustique' => 'rustiques',
    'degust:tanin:astringent' => 'astringents',


    'degust:longueur:tres_court'=>'très court',
    'degust:longueur:court' => 'court',
    'degust:longueur:moyen' => 'moyen',
    'degust:longueur:long' => 'long',
    'degust:longueur:tres_long' => 'très long',

 
//Gustatif
    'degust:rondeur'=>'Attaque et Rondeur',
    'degust:acidity'=>'L\'acidité',
    'degust:alcool'=>'L\'alcool',
    'degust:tanin'=>'Texture et Tannins',
    'degust:moelleux'=>'Le moelleux',
    'degust:retro'=>'Retro olfaction',
    'degust:longueur'=>'Longueur en Bouche',
 
 //Commentaire final
    'degust:evolution'=>'L\'évolution',
    'degust:comment'=>'Commentaire final',   //commentaire finale
    'degust:accord'=>'Accord mets et Vin',        //proposition accord mets vins
    'degust:note'=>'Note générale',
    
    //comment
                    
    'degust:evolution:tres_jeune'=>'très jeune',
    'degust:evolution:jeune' => 'jeune',
    'degust:evolution:amorce' => 'amorce',
    'degust:evolution:mature' => 'mature',
    'degust:evolution:evolue' => 'evolué',
    'degust:evolution:use' => 'usé',
    
    'degust:module:title'=> "Millésime %s",
    'degust:post_profile'=>"posté %s",
    'degust:post_wine'=>"posté %s par %s",
    
    'degust:link'=>"voir la fiche",
    
);

add_translation("fr", $french);


