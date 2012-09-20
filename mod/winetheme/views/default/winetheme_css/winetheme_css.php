<?php
/*
 * Winetheme css
 */


$couleurs_rouge = '/mod/winetheme/views/default/css/winetheme/images/couleurs_rouge.jpg';
$couleurs_rouge = elgg_normalize_url($couleurs_rouge);

$couleurs_blanc = '/mod/winetheme/views/default/css/winetheme/images/couleurs_blanc.jpg';
$couleurs_blanc = elgg_normalize_url($couleurs_blanc);

$couleurs_rose = '/mod/winetheme/views/default/css/winetheme/images/couleurs_rose.jpg';
$couleurs_rose = elgg_normalize_url($couleurs_rose);

$reflets_rouge = '/mod/winetheme/views/default/css/winetheme/images/reflets_rouge.png';
$reflets_rouge = elgg_normalize_url($reflets_rouge);

$reflets_blanc = '/mod/winetheme/views/default/css/winetheme/images/reflets_blanc.png';
$reflets_blanc = elgg_normalize_url($reflets_blanc);

$resto_background = '/mod/winetheme/views/default/css/winetheme/images/resto-50op.jpg';
$resto_background = elgg_normalize_url($resto_background);

$vigne_separator = '/mod/winetheme/views/default/css/winetheme/images/vigne.png';
$vigne_separator = elgg_normalize_url($vigne_separator);

$fiche = '/mod/winetheme/views/default/css/winetheme/images/fiche.png';
$fiche = elgg_normalize_url($fiche);

$degust_header = '/mod/winetheme/views/default/css/winetheme/images/degustation_header3.png';
$degust_header = elgg_normalize_url($degust_header);
?>

.resto_background {
background: url(<?php echo $resto_background; ?>) no-repeat;
background-size: cover;
border: 1px solid #800000;
margin-top: 20px;
  
}

.resto_background {
background: url(<?php echo $resto_background; ?>) no-repeat;
background-size: cover;
border: 1px solid #800000;
margin-top: 20px;
  
}


.resto_background {
background: url(<?php echo $resto_background; ?>) no-repeat;
background-size: cover;
border: 1px solid #800000;
margin-top: 20px;
  
}

.resto_background {
background: url(<?php echo $resto_background; ?>) no-repeat;
background-size: cover;
border: 1px solid #800000;
margin-top: 20px;
  
}








#avenue_activity ul.elgg-list.elgg-list-river.elgg-river > li {
  display: none;
  margin: 0 0 0px;
  padding: 0 0 0px;
  border: none;
  border-bottom: 1px solid #e7e7e7;
}

#avenue_activity ul.elgg-list.elgg-list-river.elgg-river > li:last-child {
  margin: 0;
  padding: 0;
  border: none;
}




<!--/* fiche degustation deja remplie */-->




#degust-fiche-left {
padding-top: 10px;
width: 630px;
margin: 8px 0 5px 0px;
background: #ffffff url(<?php echo $fiche; ?>) no-repeat;
background-position: right top;

border: 1px none #800000;

}

.degust-feuille-header {
border-bottom: 1px none #800000;
margin-bottom: 0px;
padding-left: 5px;

}

.degust-feuille-header h1 {
color: #000000;
    font-weight: normal;
font-size: 200%;
border-bottom: 1px solid #800000;
width: 60%;
}

.vigne_separator {
clear:left;
height: 33px;
background: url(<?php echo $vigne_separator; ?>) no-repeat;
background-position: center bottom;
margin-bottom: 10px;
}


.degust-feuille-content {
margin-bottom: 5px;
min-height: 10px;
display:block;
}

.degust-feuille-content-title {
float:left;
width: 200px;
border: 1px none #590000;
display:block;
text-align: left;
font-family: TangerineRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
color: #800000;
font-size: 175%;

}

.degust-feuille-content-value {
float:left;
width: 100px;
display:block;
text-align: left;
}

.degust-feuille-content-clear {
clear:left;
}

#reflets_rouge {
height:75px;
background: url(<?php echo $reflets_rouge; ?>) no-repeat;
background-position: center center;
}

#reflets_blanc {
height:75px;
background: url(<?php echo $reflets_blanc; ?>) no-repeat;
background-position: center center;
}

#couleurs_rouge {
height:75px;
background: url(<?php echo $couleurs_rouge; ?>) no-repeat;
background-position: center center;
}

#couleurs_blanc {
height:75px;
background: url(<?php echo $couleurs_blanc; ?>) no-repeat;
background-position: center center;
}

#couleurs_rose {
height:75px;
background: url(<?php echo $couleurs_rose; ?>) no-repeat;
background-position: center center;
}


.help_paragraph {
        text-transform:none;
}

.help_paragraph h1 {
        text-transform:none;
}

.help_picture img {
display: block;
margin-left:auto;
margin-right:auto;
}


.resto_background img {
	border: 4px solid #ffffff;
        outline: 1px solid #800000;
        

position: relative;

top: -15px;
left: 0px;


}


#vtab {
    margin: auto;
    width: 820px;
    height: 100%;
}
#vtab > ul > li {
    width: 60px;
    height: 75px;
    background-color: #fff !important;
    list-style-type: none;
    display: block;
    text-align: center;
    margin: auto;
    padding-bottom: 10px;
    border: 1px solid #fff;
    position: relative;
    border-right: none;
    opacity: .3;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=30);
}


<?php
/*
 * Winetheme css
 */

/****************************/
/* Nyromodal */

$degust = '/mod/winetheme/views/default/css/winetheme/images/degust.jpg';
$degust = elgg_normalize_url($degust);

$help = '/mod/winetheme/views/default/css/winetheme/images/help.jpg';
$help = elgg_normalize_url($help);


?>

#vtab > ul > li.home {
    background: url(<?php echo $degust; ?>) no-repeat;
}

#vtab > ul > li.login {
    background: url(<?php echo $help; ?>) no-repeat;
}

#vtab > ul > li.support {
    background: url(<?php echo $help; ?>) no-repeat;

}
#vtab > ul > li.selected {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
    border: 1px solid #ddd;
    border-right: none;
    z-index: 10;
    background-color: #ffffff !important;
    position: relative;
}
#vtab > ul {
    float: left;
    width: 60px;
    text-align: left;
    display: block;
    margin: auto 0;
    padding: 0;
    position: relative;
    top: 30px;
}
#vtab > div {
    background-color: #ffffff;
    
    margin-left: 60px;
    border: 1px solid #ddd;
    min-height: 500px;
    padding: 12px;
    position: relative;
    z-index: 9;
    -moz-border-radius: 20px;
}
#vtab > div > h4 {
    font-family: TangerineRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
    color: #800;
    font-size: 300%;
    font-weight: normal;
    border-bottom: 1px solid #800000;
    padding-top: 5px;
    margin-top: 0;
    margin-bottom: 10px;
}







div.error {
	color: red;
}

div.error a {
	color: #336699;
	font-size: 12px;
	text-decoration: underline
}


.nyroModalCont {
	position: absolute;
	border: 6px solid #800000;
	margin: 25px;
	background: #ffffff;
       	width: 930px;
    border-radius: 0px;
 
        
}

<?php
/**********************************
Search plugin
***********************************/
?>

.elgg-search-header {
	bottom: 5px;
	height: 23px;
	position: absolute;
	right: 0;
}
.elgg-search input[type=text] {
	width: 230px;
}
.elgg-search input[type=submit] {
	display: none;
}
.elgg-search input[type=text] {
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	border:1px solid white;
        float: right;
	color: white;
	font-size: 12px;
	font-weight: bold;
	padding: 2px 4px 2px 26px;
	background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png) no-repeat 2px -934px;
}
.elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
    
	background-color: white;
	background-position: 2px -916px;
	border: 1px solid white;
	color: #0054A7;
}

.search-list li {
	padding: 5px 0 0;
}
.search-heading-category {
	margin-top: 20px;
	color: #666666;
}

.search-highlight {
	background-color: #bbdaf7;
}
.search-highlight-color1 {
	background-color: #bbdaf7;
}
.search-highlight-color2 {
	background-color: #A0FFFF;
}
.search-highlight-color3 {
	background-color: #FDFFC3;
}
.search-highlight-color4 {
	background-color: #ccc;
}
.search-highlight-color5 {
	background-color: #4690d6;
}

.elgg-search input[type="text"] {
border:1px solid white;
float: right;

}


.elgg-form-degusts-edit fieldset fieldset {
padding: 5px;



border-color: #800000;
border-width: 1px;
border-style: solid;
border-top-right-radius: 0px;
border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;
background: #ffffff;

}

.legend_class {
font-family: TangerineRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
color: #800000;
background: #ffffff;
font-size: 175%;
padding-left:10px;
padding-right:10px;
padding-top:5px;
padding-bottom:5px;

}




.validate_error_label > label > h2 {
font-family: TangerineRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
color:#000000;
text-align: center;
  font-size: 200%;
    font-weight: normal;
    margin-bottom: 5px;
    margin-top: 5px;
}

.nyroModalCont iframe {
	border: 1px none #0000FF;

	width: 930px;
	height: 400px;
}

.nyroModalLink, .nyroModalDom, .nyroModalForm, .nyroModalFormFile {
	border: 1px none #00FF00;

	position: relative;
	padding: 5px;
	min-height: 250px;
	width: 900px;
}



.degust-main {

margin-right: 0px;

}

.degust-side-head {
padding-top:10px;
height: 110px;
font-family: TangerineRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 175%; text-transform:capitalize;  
background: url(<?php echo $degust_header; ?>) no-repeat;
background-position: right center;
}



.degust-sidebar {
    float: right;
    margin-bottom: 5px;
    margin-left: 5px;
    margin-right: 0px;
    margin-top: 0px;
    padding-bottom:10px;
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;
    position: relative;
    border-width: 1px;
    border-style: none;
    width: 250px;
}


/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom: 15px;
}
.profile .elgg-inner {
	margin: 0 5px;
	border: 2px solid #eee;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
#profile-details {
	padding: 15px;
}
/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	float: left;
	background-color: #eee;
	padding: 15px;
}
#profile-owner-block .large {
	margin-bottom: 10px;
}
#profile-owner-block a.elgg-button-action {
	margin-bottom: 4px;
	display: table;
}
.profile-content-menu a {
	display: block;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	background-color: white;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 8px;
}
.profile-content-menu a:hover {
	background: #0054A7;
	color: white;
	text-decoration: none;
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper a {
	display: block;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	background-color: white;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 8px;
}
.profile-admin-menu-wrapper {
	background-color: white;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
.profile-admin-menu-wrapper li a {
	background-color: white;
	color: red;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: black;
}
/*** profile details ***/
#profile-details .odd {
	background-color: #f4f4f4;
	
	-webkit-border-radius: 0px; 
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	margin: 0 0 7px;
	padding: 2px 4px;
}
#profile-details .even {
	background-color:#f4f4f4;
	
	-webkit-border-radius: 0px; 
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	margin: 0 0 7px;
	padding: 2px 4px;
}
.profile-aboutme-title {
	background-color:#f4f4f4;
	
	-webkit-border-radius: 0px; 
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	margin: 0;
	padding: 2px 4px;
}
.profile-aboutme-contents {
	padding: 2px 0 0 3px;
}
.profile-banned-user {
	border: 2px solid red;
	padding: 4px 8px;
	
	-webkit-border-radius: 0px; 
	-moz-border-radius: 0px;
	border-radius: 0px;
}


div#job{
        display:none;
}


/* Mise en page du profile d'un utilisateur*/
/*60% pour les infos 40% liste des degusts */

#list_user_degust {
        width: 35%;
        float: left;
        
}

.elgg-col-2of3 {
    width: 65%;
}


.groups-profile > .elgg-image {
	margin-right: 10px;
}

.groups-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}

.groups-profile-fields .odd,
.groups-profile-fields .even {
	background: #f4f4f4;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.groups-profile-fields .elgg-output {
	margin: 0;
}

#groups-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#groups-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.groups-widget-viewall {
	float: right;
	font-size: 85%;
}

.groups-latest-reply {
	float: right;
}


<?php
/*
 * Winetheme css
 */

/****************************/
/* Nyromodal */

$loader = 'mod/overlay/vendors/nyromodal/graphics/ajaxLoader.gif';
$loader = elgg_normalize_url($loader);

$close = 'mod/overlay/vendors/nyromodal/graphics/close21.png';
$close = elgg_normalize_url($close);
?>

.nyroModalBg {
	position: fixed;
	overflow: hidden;
	top: 0;
	left: 0;
	height: 100%;
	width: 100%;
	background: #ffffff;
	opacity: 0.7;
        //z-index: 0;
}
.nmReposition {
	position: absolute;
        z-index: 20000; //z-index de elgg-page-topbar= 9000
}
.nyroModalCloseButton {
	top: -13px;
	right: -13px;
	width: 21px;
	height: 21px;
	text-indent: -9999em;
	background: url(<?php echo $close ?>);
}
.nyroModalTitle {
	top: -26px;   
	left: 0;
	margin: 0;
    font-size: 175%;
    font-weight:normal;
	color: #000000;
text-shadow:5px 3px 5px #ffffff;
}
.nyroModalCont {
	position: absolute;
	border: 4px solid #600000;
        outline: 4px solid #323232;

	margin: 25px;
	background: rgb(233,224,209);
  
        
}
.nyroModalCont iframe {
	width: 600px;
	height: 400px;
}
.nyroModalError {
	border: 4px solid red;
	color: red;
	width: 250px;
	height: 250px;
}
.nyroModalError div {
	min-width: 0;
	min-height: 0;
	padding: 10px;
}
.nyroModalLink, .nyroModalDom, .nyroModalForm, .nyroModalFormFile {
	position: relative;
	padding: 10px;
        
        min-height: 250px;
	min-width: 250px;
        //min-width: 1000px;
        //min-height: 500px;
	//max-width: 1000px;

}
.nyroModalImage, .nyroModalSwf, .nyroModalIframe, .nyroModalIframeForm {
	position: relative;
	overflow: hidden;
}
.nyroModalImage img {
    vertical-align: top;
}
.nyroModalHidden {
	left: -9999em;
	top: -9999em;
}
.nyroModalLoad {
	position: absolute;
	width: 100px;
	height: 100px;
	background: #fff url(<?php echo $loader ?>) no-repeat center;
	padding: 0;
}
.nyroModalPrev, .nyroModalNext {
	outline: none;
	position: absolute;
	top: 0;
	height: 60%;
	width: 150px;
	min-height: 50px;
	max-height: 300px;
	cursor: pointer;
	text-indent: -9999em;
	background: transparent url('data:image/gif;base64,AAAA') left 20% no-repeat;
}
.nyroModalImage .nyroModalPrev, .nyroModalImage .nyroModalNext {
	height: 100%;
	width: 40%;
	max-height: none;
}
.nyroModalPrev {
	left: 0;
}
.nyroModalPrev:hover {
	background-image: url(../img/prev.gif);
}
.nyroModalNext {
	right: 0;
	background-position: right 20%;
}
.nyroModalNext:hover {
	background-position: right 20%;
	background-image: url(../img/next.gif);
}