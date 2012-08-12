<?php
/*
 * Winetheme css
 */
?>

#vtab {
    margin: auto;
    width: 800px;
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
    font-size: 200%;
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
       	width: 1000px;
    border-radius: 5px;
  /* IE9 SVG, needs conditional override of 'filter' to 'none' */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */

/*
background: (<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Tangerine-fontfacekit/data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2MwNTY1NiIgc3RvcC1vcGFjaXR5PSIwLjgiLz4KICAgIDxzdG9wIG9mZnNldD0iOTklIiBzdG9wLWNvbG9yPSIjZmVmZGZkIiBzdG9wLW9wYWNpdHk9IjAuOCIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(192,86,86,0.8) 0%, rgba(254,253,253,0.8) 99%, rgba(255,255,255,0.8) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(192,86,86,0.8)), color-stop(99%,rgba(254,253,253,0.8)), color-stop(100%,rgba(255,255,255,0.8))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(192,86,86,0.8) 0%,rgba(254,253,253,0.8) 99%,rgba(255,255,255,0.8) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(192,86,86,0.8) 0%,rgba(254,253,253,0.8) 99%,rgba(255,255,255,0.8) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(192,86,86,0.8) 0%,rgba(254,253,253,0.8) 99%,rgba(255,255,255,0.8) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(192,86,86,0.8) 0%,rgba(254,253,253,0.8) 99%,rgba(255,255,255,0.8) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ccc05656', endColorstr='#ccffffff',GradientType=0 ); /* IE6-8 */

*/        
        
}

.elgg-search input[type="text"] {
border:1px solid white;

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

	width: 1000px;
	height: 400px;
}

.nyroModalLink, .nyroModalDom, .nyroModalForm, .nyroModalFormFile {
	border: 1px none #00FF00;

	position: relative;
	padding: 5px;
	min-height: 250px;
	width: 960px;
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
