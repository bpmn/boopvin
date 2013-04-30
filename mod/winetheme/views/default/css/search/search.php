<?php

$indicator = elgg_normalize_url('mod/search/graphics/indicator.gif')
?>




.elgg-search-header {
	bottom: 5px;
	height: 56px;
	position: absolute;
	right: 0;
}

#search_wine h2 {
color : #ffffff;
text-shadow:5px 5px 5px #000000;
display: inline-block;
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
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
	background: black url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png) no-repeat 2px -934px; 
        opacity: 0.5;
}
.elgg-search input[type=text]:focus, .elgg-search input[type=text]:active {
    
	background-color: white;
        opacity: 1.0;
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


.elgg-search-entity{
    float:right;
    color: black;
}

.elgg-search-entity input[type=text] {
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border:2px solid #560000;
        float: right;
	color: #560000;
	font-size: 12px;
	font-weight: normal;
	padding: 2px 4px 2px 26px;
	background: transparent url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png) no-repeat 2px -934px;
        min-width: 220px;
        
-moz-box-shadow: 1px 1px 6px #000000;
-webkit-box-shadow: 1px 1px 6px #000000;
box-shadow: 1px 1px 6px #000000;
        }
        
        
.elgg-search-entity input[type=text]:focus, .elgg-search-entity input[type=text]:active {
    
	background-color: white;
	background-position: 2px -916px;
	border:2px solid #560000;
	color: #0054A7;
}


.elgg-search-entity input[type="text"]:focus.ui-autocomplete-loading {
    background:white url(<?php echo $indicator?>) no-repeat; 
    background-position:2px 50%;
}



.elgg-module-livesearch {
        font-size:0.8em;
        line-height:1.4em;
        width:260px;
        margin-bottom:0;
}

.elgg-module-livesearch > .elgg-head {
	background: #666;
	padding: 3px;
	margin-bottom: 3px;
}

.elgg-module-livesearch > .elgg-head h3 {
	color: white;
}

.elgg-module-livesearch > .elgg-body > .elgg-list {
        margin:0;
}

.elgg-module-livesearch .elgg-image-block {
        padding:0;
}

.elgg-search input[type="text"]:focus.ui-autocomplete-loading {
    background:white url(<?php echo $indicator?>) no-repeat; 
    background-position:2px 50%;
}

.ac_results li {
font-size:0.9em;
line-height:12px;
padding:7px;
cursor:pointer;
}

.ac_res_subtype {
padding:3px;
}