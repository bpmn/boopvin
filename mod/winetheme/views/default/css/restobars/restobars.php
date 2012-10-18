<?php
/*
 * css
 */



$resto_background = '/mod/winetheme/views/default/css/winetheme/images/resto-50op.jpg';
$resto_background = elgg_normalize_url($resto_background);


?>



.resto_background {
background: url(<?php echo $resto_background; ?>) no-repeat;
background-size: cover;
border: 1px solid #800000;
margin-top: 20px;
  
}


.resto_background img {
	border: 4px solid #ffffff;
        outline: 1px solid #800000;
        position: relative;
        top: -15px;
        left: 0px;

}

#map_fields {
    width:300px;
    clear:none;

}

#maps_canvas {
    float:right;
    height: 400px;
    width:450px;

}

#MapForm {
    width:770px;
}

#showmap_pop {
    overflow: hidden;
    height: 450px;
    width: 450px;
}
.restobars-profile > .elgg-image {
	margin-right: 10px;
}

.restobars-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}

.restobars-profile-fields .odd,
.restobars-profile-fields .even {
	background: #f4f4f4;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.restobars-profile-fields .elgg-output {
	margin: 0;
}

#restobars-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#restobars-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.restobars-widget-viewall {
	float: right;
	font-size: 85%;
}

.restobars-latest-reply {
	float: right;
}
