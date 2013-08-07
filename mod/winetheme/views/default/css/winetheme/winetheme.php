<?php
/*
 * Winetheme css
 */

$verre_score = '/mod/winetheme/views/default/css/winetheme/images/score.jpg';
$verre_score = elgg_normalize_url($verre_score);

$verre_score2 = '/mod/winetheme/views/default/css/winetheme/images/score2.jpg';
$verre_score2 = elgg_normalize_url($verre_score2);

$loading_image = '/mod/winetheme/views/default/css/winetheme/images/ajax_loader.gif';
$loading_image = elgg_normalize_url($loading_image);

$test_gravure = '/mod/winetheme/views/default/css/winetheme/images/gravure.png';
$test_gravure = elgg_normalize_url($test_gravure);
?>

body {
background: #ffffff;
background: rgb(0,0,0) url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/woodtexture_v15.jpg') repeat-x;

}

#loading_image {
    position:absolute;
    width:31px; /*image width */
    height:31px; /*image height */
    left:50%; 
    top:50%;
    margin-left:-16px; /*image width/2 */
    margin-top:-16px; /*image height/2 */
}



#captcha_images_id {
}

#image_captcha {
text-align: left;
width: 80%;
}


#images_slider{

   height: 120px;
   width: 735px;
}

#register_window {
background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/layer9.png') no-repeat;
background-position: left top;

text-align: left;
width: 780px;

padding-bottom: 30px;
padding-right: 0px;
padding-left: 70px;
padding-top: 40px;

}

#register_window .elgg-input-text,.elgg-input-password {
width: 80%;
}

#register_window h4 {
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 1.4em; 
}



.boopwine_register {
background: #ffffff;
}


.register_me{
margin-bottom: 100px;
margin-left: 24px;

height: 188px;
width: 160px;
-webkit-box-shadow: -4px -4px 15px rgba(51, 50, 50, 0.75);
-moz-box-shadow:    -4px -4px 15px rgba(51, 50, 50, 0.75);
box-shadow:         -4px -4px 15px rgba(51, 50, 50, 0.75);

text-align: center;

}


.register_me a {

font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 200%; font-size: 1.8em; 
}



#index_welcome {
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 1.4em; 
width: 735px;
height: 80px;
background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/home_subheading.png') no-repeat scroll 50% 0px transparent;
margin-bottom: 10px;
text-align: center;

}



#index_welcome_header {

width: auto;
height: auto;
margin-left: 140px;
padding-top: 10px;

}


#avenue_activity {
width: 370px;
}



#avenue_activity ul.elgg-list.elgg-list-river.elgg-river > li {
  display: none; 
  margin: 0 0 0px;
  padding: 0 0 0px;
  border: none;
  border-bottom: 1px solid #e7e7e7;
  clear:left
}

#avenue_activity ul.elgg-list.elgg-list-river.elgg-river > li:last-child {
  margin: 0;
  padding: 0;
  border: none;
}


#avenue_activity2 {
width: 370px;
}

#avenue_activity2 ul.elgg-list > li {
  display: none;
  margin: 0 0 0px;
  padding: 0 0 0px;
  border: none;
  border-bottom: 1px solid #e7e7e7;
  clear:left
}

#avenue_activity2 ul.elgg-list > li:last-child {
  margin: 0;
  padding: 0;
  border: none;
}

#avenue_activity2 *{
    clear: none;
}

#avenue_activity2 .elgg-image-block:after{
    clear: none;
}

#avenue_activity *{
    clear: none;
}

#avenue_activity .elgg-image-block:after{
    clear: none;
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



/*******************************************/
/* liste dégust sous le profil utilisateur */
/*******************************************/

#list_user_degust {
        width: auto;
        clear:left;
}

#list_user_degust .elgg-item{
        width: 50%;
        float: left;
        height:60px;
}
#list_user_degust .elgg-pagination{
        clear:left;
}

#list_user_degust h2{
    font-family:NotethisRegular;
    font-size: 1.5em; 
    background: url(<?php echo $verre_score; ?>) no-repeat;
    height: 40px;
    padding: 0 0 0 25px;
}

.elgg-col-2of3 {
    width: 65%;
}

/* ***************************************
	Ranking
*************************************** */
#score {
    font-family:NotethisRegular;
    font-size: 1.1em; 
    background: url(<?php echo $verre_score; ?>) no-repeat;
    background-position: center;
    min-width: 45px;
    min-height: 40px;
    text-align: right;
    vertical-align: middle;
    
}
#score2 {
    font-family:NotethisRegular;
    font-size: 1.1em; 
    background: url(<?php echo $verre_score2; ?>) no-repeat;
    background-position: center;
    width: 45px;
    height: 40px;
    text-align: right;
    vertical-align: middle;
    
}



#ranking{
 
   height: auto;
   width: 280px;
   float: right; 

   border-left:solid 1px #560000;
   padding: 0 40px 0 20px;

}

#ranking_list {

}

#ranking_list .elgg-list {
border-top: 1px none #e7e7e7;

}

/*#ranking_list .elgg-list > li {
  display: block; 
  margin: 0 0 0px;
  padding: 7px 0 0px 0;
  border: none;
  border-bottom: 1px solid #e7e7e7;
  clear:left
}*/

#ranking_list{
   float: right;
   width: 270px;
   }
   
#ranking_list .elgg-list{
  padding: 7px 0 7px 0;
}
   
#ranking .elgg-image-block{
    padding:0px;
}

.item-ranking h3 {
    font-weight:normal;
    font-size: 1.1em ;
}

#ranking_list>h3{
    text-align: left;
    
}




/***************************************************************/



.theme-default .nivoSlider {
	position:relative;
	background:#fff url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/loading.gif') no-repeat 50% 50%;
    margin-bottom:10px;
    -webkit-box-shadow: 0px 1px 5px 0px #4a4a4a;
    -moz-box-shadow: 0px 1px 5px 0px #4a4a4a;
    box-shadow: 0px 1px 5px 0px #4a4a4a;
    	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
    
}
.theme-default .nivoSlider img {
	position:absolute;
	top:0px;
	left:0px;
	display:none;
}
.theme-default .nivoSlider a {
	border:0;
	display:block;
}

.theme-default .nivo-controlNav {
	text-align: center;
	padding: 20px 0;
}
.theme-default .nivo-controlNav a {
	display:inline-block;
	width:22px;
	height:22px;
	background:url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/bullets.png') no-repeat;
	text-indent:-9999px;
	border:0;
	margin: 0 2px;
}
.theme-default .nivo-controlNav a.active {
	background-position:0 -22px;
}

.theme-default .nivo-directionNav a {
	display:block;
	width:30px;
	height:30px;
	background:url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/arrows.png') no-repeat;
	text-indent:-9999px;
	border:0;
	opacity: 0;
	-webkit-transition: all 200ms ease-in-out;
    -moz-transition: all 200ms ease-in-out;
    -o-transition: all 200ms ease-in-out;
    transition: all 200ms ease-in-out;
}
.theme-default:hover .nivo-directionNav a { opacity: 1; }
.theme-default a.nivo-nextNav {
	background-position:-30px 0;
	right:15px;
}
.theme-default a.nivo-prevNav {
	left:15px;
}

.theme-default .nivo-caption {
    font-family: Helvetica, Arial, sans-serif;
}
.theme-default .nivo-caption a {
    color:#fff;
    border-bottom:1px dotted #fff;
}
.theme-default .nivo-caption a:hover {
    color:#fff;
}

.theme-default .nivo-controlNav.nivo-thumbs-enabled {
	width: 100%;
}
.theme-default .nivo-controlNav.nivo-thumbs-enabled a {
	width: auto;
	height: auto;
	background: none;
	margin-bottom: 5px;
}
.theme-default .nivo-controlNav.nivo-thumbs-enabled img {
	display: block;
	width: 120px;
	height: auto;
}




