<?php

/*
 * Class ElggWine extended from ElggGroup
 * 
 * attributs
 * @property string $name       nom du domaine, chateau etc...
 * @property string $subtype    "wine"
 * @property string $description appellation
 * 
 * @property string $comments_on Whether commenting is allowed (Off, On)
 * @property string $excerpt     An excerpt of the blog post used when displaying the post
 * 
 * Metadata
 * @property string $cuvee      cuvée
 * @property string $region     region
 * @property string $grape      cépage
 * @property string $maker      vigneron
 * @property string $kind       rouge,blanc,blanc moelleux,effervescent etc..
 * @property string $soil       sol
 * @property string $country    pays
 */

class ElggWine extends ElggGroup {

	/**
	 * Set subtype to blog.
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();
                $admins=elgg_get_admins();
                $this->attributes['owner_guid'] = $admins[0]->getGUID();
		$this->attributes['container_guid'] = $admins[0]->getGUID();
		$this->attributes['subtype'] = "wine";
                
	}


        public function __construct($guid = null) {
		parent::__construct($guid);
	}
}


?>
