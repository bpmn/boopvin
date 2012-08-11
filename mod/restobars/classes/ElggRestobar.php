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

class ElggRestobar extends ElggGroup {

	/**
	 * Set subtype to blog.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = "restobar";
	}


        public function __construct($guid = null) {
		parent::__construct($guid);
	}
        
        
        	/**
	 * Return whether a given user is a member of this group or not.
	 *
	 * @param ElggUser $user The user
	 *
	 * @return bool
	 */
	public function isIncave($wine = 0) {
		if (!(elgg_instanceof($wine, 'group', 'wine'))) {
			return false;
		}
			$object = check_entity_relationship($this->getGUID(), 'incave', $wine->getGUID());
	if ($object) {
		return true;
	} else {
		return false;
	}
	}
}


?>
