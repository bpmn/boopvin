<?php
/*
 * css
 */



$resto_background = '/mod/winetheme/views/default/css/winetheme/images/resto-50op.jpg';
$resto_background = elgg_normalize_url($resto_background);


$ardoise_background = '/mod/winetheme/views/default/css/winetheme/images/ardoise6.jpg';
$ardoise_background = elgg_normalize_url($ardoise_background);


?>



.resto_background {
background: rgb(214,152,51);
border: 1px solid #800000;
margin-top: 20px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;  
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
	background: transparent;
	padding: 5px;
	margin-top: 10px;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}

.restobars-profile-fields .odd,
.restobars-profile-fields .even {
	background: transparent;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.restobars-profile-fields .elgg-output {
	margin: 0;
}

#restobars-tools {
background: #fff;
}



#restobars-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#restobars-tools > li:nth-child(odd) {
	margin-right: 4%;
}

#restobars-tools .elgg-head {
background: transparent;
border-bottom: 1px solid #ffffff;

}

.restobars-news {
background: #ccc url(<?php echo $ardoise_background ?>) no-repeat;
padding-top: 40px;
padding-left: 7px;
padding-right: 5px;
min-height: 150px;
}


.restobars-news .elgg-head h3 {
color: white;
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-weight: normal;

}

.restobars-news .elgg-head a {
background: transparent;
color: white;
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
}

.restobars-news .elgg-body p {
background: transparent;
padding-left: 7px;
padding-right: 5px;
color: white;
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
}

.restobars-widget-viewall {
	float: right;
	font-size: 85%;
}

.restobars-latest-reply {
	float: right;
}
