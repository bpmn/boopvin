<?php

/*
 * Class ElggRestobar extended from ElggGroup
 * 
 * attributs
 * @property string $name       nom de l'établissement
 * @property string $subtype    "restobar"
 * @property string $description Description de l'établissement
 * 
 * @property string $comments_on Whether commenting is allowed (Off, On)
 * @property string $excerpt     An excerpt of the blog post used when displaying the post
 * 
 * Metadata
 * @property string $adresse     cuvée
 * @property string $website     region
 
 */

class ElggRestobarnews extends ElggObject {

	/**
	 * Set subtype to blog.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "restobarnews";
	}


        public function __construct($guid = null) {
		parent::__construct($guid);
	}
}


?>
