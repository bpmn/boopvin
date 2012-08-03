<?php
/*
 * Winetheme css
 */
?>

div.error {
	color: red;
}

div.error a {
	color: #336699;
	font-size: 12px;
	text-decoration: underline
}



/* Z-INDEX */
 .formError { z-index: 990; }
    .formError .formErrorContent { z-index: 991; }
    .formError .formErrorArrow { z-index: 996; }
    
    .formErrorInsideDialog.formError { z-index: 5000; }
    .formErrorInsideDialog.formError .formErrorContent { z-index: 5001; }
    .formErrorInsideDialog.formError .formErrorArrow { z-index: 5006; }




.inputContainer {
	position: relative;
	float: left;
}

.formError {
	position: absolute;
	top: 300px;
	left: 300px;
	display: block;
	cursor: pointer;
}

.ajaxSubmit {
	padding: 20px;
	background: #55ea55;
	border: 1px solid #999;
	display: none
}

.formError .formErrorContent {
	width: 100%;
	background: #ee0101;
	position:relative;
	color: #fff;
	width: 150px;
	font-size: 11px;
	border: 2px solid #ddd;
	box-shadow: 0 0 6px #000;
	-moz-box-shadow: 0 0 6px #000;
	-webkit-box-shadow: 0 0 6px #000;
	padding: 4px 10px 4px 10px;
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
}

.greenPopup .formErrorContent {
	background: #33be40;
}

.blackPopup .formErrorContent {
	background: #393939;
	color: #FFF;
}

.formError .formErrorArrow {
	width: 15px;
	margin: -2px 0 0 13px;
	position:relative;
}
body[dir='rtl'] .formError .formErrorArrow,
body.rtl .formError .formErrorArrow {
	margin: -2px 13px 0 0;
}

.formError .formErrorArrowBottom {
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
	margin: 0px 0 0 12px;
	top:2px;
}

.formError .formErrorArrow div {
	border-left: 2px solid #ddd;
	border-right: 2px solid #ddd;
	box-shadow: 0 2px 3px #444;
	-moz-box-shadow: 0 2px 3px #444;
	-webkit-box-shadow: 0 2px 3px #444;
	font-size: 0px;
	height: 1px;
	background: #ee0101;
	margin: 0 auto;
	line-height: 0;
	font-size: 0;
	display: block;
}

.formError .formErrorArrowBottom div {
	box-shadow: none;
	-moz-box-shadow: none;
	-webkit-box-shadow: none;
}

.greenPopup .formErrorArrow div {
	background: #33be40;
}

.blackPopup .formErrorArrow div {
	background: #393939;
	color: #FFF;
}

.formError .formErrorArrow .line10 {
	width: 15px;
	border: none;
}

.formError .formErrorArrow .line9 {
	width: 13px;
	border: none;
}

.formError .formErrorArrow .line8 {
	width: 11px;
}

.formError .formErrorArrow .line7 {
	width: 9px;
}

.formError .formErrorArrow .line6 {
	width: 7px;
}

.formError .formErrorArrow .line5 {
	width: 5px;
}

.formError .formErrorArrow .line4 {
	width: 3px;
}

.formError .formErrorArrow .line3 {
	width: 1px;
	border-left: 2px solid #ddd;
	border-right: 2px solid #ddd;
	border-bottom: 0 solid #ddd;
}

.formError .formErrorArrow .line2 {
	width: 3px;
	border: none;
	background: #ddd;
}

.formError .formErrorArrow .line1 {
	width: 1px;
	border: none;
	background: #ddd;
}




.elgg-page-header {

background: #FF6060;

}


.nyroModalCont {
	position: absolute;
	border: 4px solid #FF6000;
	margin: 5px;
	background: #fffafa;
       	width: 1000px;
 
        
}


.nyroModalCont iframe {
	border: 1px solid #0000FF;

	width: 1000px;
	height: 400px;
}

.nyroModalLink, .nyroModalDom, .nyroModalForm, .nyroModalFormFile {
	border: 1px solid #00FF00;

	position: relative;
	padding: 10px;
	min-height: 250px;
	width: 900px;
}


.degust-main {

margin-right: 5px;

}


.degust-sidebar {
    float: right;
    margin-bottom: 5px;
    margin-left: 5px;
    margin-right: 10px;
    margin-top: 8px;
    padding-bottom:10px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
    position: relative;
    border-width: 1px;
    border-style: solid;
    width: 270px;
}
