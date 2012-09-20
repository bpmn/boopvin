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

        public function distance($lat1, $lon1) {

        $r = 6366; //rayon de la terre en km
        $lat1 = deg2rad((float)$lat1);
        $lon1 = deg2rad((float)$lon1);
        $lat2 = deg2rad((float)$this->getLatitude());
        $lon2 = deg2rad((float)$this->getLongitude());

        /**
         * Formule précise
         * d=2*asin(
          sqrt(

          (sin((lat1-lat2)/2))^2 + cos(lat1)*cos(lat2)*(sin((lon1-lon2)/2))^2)

          )
         */
        $dp = 2 * asin(
                        sqrt(
                                pow(sin(($lat1 - $lat2) / 2), 2) + cos($lat1) * cos($lat2) * pow(sin(($lon1 - $lon2) / 2), 2)
                        )
        );


        $dpr = $dp * $r;


        return $dpr;
    }
}
?>
