<?php
/**
 * Elgg wines css
 * 
 * @package wines
 */

?>

<?php

//$load = elgg_normalize_url('mod/search/graphics/indicator.gif')
?>

/*.elgg-search-entity input[type="text"]:focus.ui-autocomplete-loading {
    background:white url(<?php echo $indicator?>) no-repeat; 
    background-position:2px 50%;
}*/
.wines-profile > .elgg-image {
	margin-right: 10px;
}

.wines-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}

.wines-profile-fields .odd,
.wines-profile-fields .even {
	background: transparent;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.wines-profile-fields .elgg-output {
	margin: 0;
}

#wines-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#wines-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.wines-widget-viewall {
	float: right;
	font-size: 85%;
}

.wines-latest-reply {
	float: right;
}

.elgg-form-wines-cave-addtocave{
	max-width: 250px;
}

.image_block_wine{
    min-height: 60px;
    height: auto;
}

.image_block_wine h3 {
    font-size:12px;
}

<?php

$indicator = elgg_normalize_url('mod/search/graphics/indicator.gif')
?>

/*input[type="text"]:focus#id_appellation.ui-autocomplete-loading {
    background:white url(<?php echo $indicator?>) no-repeat; 
    background-position:2px 50%;
}*/


.wines-profile-fields {

    //display:inline;

}

#filter label{
    font-size: 90%;
    color: #723A08;
}


#filter fieldset {

  margin-left: 30px;
  
  }
  
#wine_search_filter{

font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
text-align: center;
margin-bottom:10px;

}
  
.wine_filter {
    width: 150px; //taille de select input
    height: auto;
    font-size: 95%;
  }
  
 
  
#box_region{
    display:none;
}

#box_appellation{
    display:none;
    }

.wine_count {


//font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
text-align: center;
margin-top:20px;
//font-size: 200%;
}
    
    
