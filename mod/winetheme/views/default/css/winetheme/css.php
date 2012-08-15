<?php
/*
 * Winetheme css
 */
?>



.resto_background {

background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/resto-50op.png') no-repeat;
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

#vtab > ul > li.home {
    background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/degust.jpg') no-repeat;
}

#vtab > ul > li.login {
    background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/help.jpg') no-repeat;
}

#vtab > ul > li.support {
    background: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/help.jpg') no-repeat;

}
#vtab > ul > li.selected {
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
    border: 1px solid #ddd;
    border-right: none;
    z-index: 10;
    background-color: #fafafa !important;
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
    background-color: #fafafa;
    
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




@font-face {
	font-family: 'TangerineRegular';
	src: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/Tangerine_Regular-webfont.eot');
	
    src: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/Tangerine_Regular-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/Tangerine_Regular-webfont.woff') format('woff'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/Tangerine_Regular-webfont.ttf') format('truetype'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/Tangerine_Regular-webfont.svg#TangerineRegular') format('svg');
    font-weight: normal;
    font-style: normal;
                         
                         font-weight: normal;
font-style: normal;
}



div.error {
	color: red;
}

div.error a {
	color: #336699;
	font-size: 12px;
	text-decoration: underline
}



.elgg-page-header {

background: #800000;

}





.nyroModalCont {
	position: absolute;
	border: 6px solid #800000;
	margin: 25px;
	background: #ffffff;
       	width: 930px;
    border-radius: 5px;
 
        
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
border-top-right-radius: 5px;
border-bottom-right-radius: 5px;
border-bottom-left-radius: 5px;
background: #ffffff;

}

.legend_class {
color: #000000;
/*text-shadow:1px 1px 5px #99BB54*/

}


.elgg-form-degusts-edit fieldset fieldset legend {

font-family: "Lucida Sans Unicode", "Lucida Granve", sans-serif;
color: #000000;
padding-left: 10px;
padding-right: 10px;

text-shadow:1px 1px 5px #99BB54
font-size: 90%;
border-width: 1px;
border-top-style: solid;
border-radius: 5px;
background: #ffffff;

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

margin-right: 5px;

}

.degust-side-head {
padding-top:10px;
//border-color: #800000;
//border-width: 1px;
//border-style: solid;
//border-radius: 5px;
//background: #ffffff;
//margin-bottom: 23px;
//height: 177px;
height: 110px;
}



.degust-sidebar {
    float: right;
    margin-bottom: 5px;
    margin-left: 5px;
    margin-right: 0px;
    margin-top: 8px;
    padding-bottom:10px;
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;
    position: relative;
    border-width: 1px;
    border-style: none;
    width: 270px;
}
