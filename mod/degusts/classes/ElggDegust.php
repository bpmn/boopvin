<?php

/**
 * Extended class to override the time_created
 * 		
 * Attributs
 * 
 * @property string     $subtype degust
 * @property string     $time_updated A UNIX timestamp of when the entity was last updated (automatically updated on save)
 * 
 * MetaData
 * // Visuel
 * @property int        $annee
 * @property int        $couleur_intensity couleur.             
 * @property string     $couleur couleur.
 * @property string     $reflet couleur.
 * 
 * //Olfactif
 * @property array      $nez    résultat des checkboxes sous forme de tableau
 * @property string     $arome  description texte des arôme
 * @property int        $complexity en fonction du nombres de checkbox cochées.
 * @property 
 * 
 * //Gustatif
 * @property int        $rondeur
 * @property int        $acidity
 * @property int        $alcool
 * @property int        $tanin
 * @property text       $longueur 
 * @property text       $retro
 * 
 * //Commentaire final
 * @property text       $evolution maturité du vin
 * @property textarea   $comment   commentaire finale
 * @property text       $accord     proposition accord mets vins
 * @property int        $note     note sur 20.
 * 
 */

class ElggDegust extends ElggObject {

	/**
	 * Set subtype to degust.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "degust";
	}



}
?>
