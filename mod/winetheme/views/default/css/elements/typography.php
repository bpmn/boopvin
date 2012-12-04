<?php
/**
 * CSS typography
 *
 * @package Elgg.Core
 * @subpackage UI
 */

?>

/* ***************************************
	Typography
*************************************** */
@font-face {
    font-family: 'NotethisRegular';
    src: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Note-this-fontfacekit/Note_this-webfont.eot');
    src: url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Note-this-fontfacekit/Note_this-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Note-this-fontfacekit/Note_this-webfont.woff') format('woff'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Note-this-fontfacekit/Note_this-webfont.ttf') format('truetype'),
         url('<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/fonts/Note-this-fontfacekit/Note_this-webfont.svg#NotethisRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}


body {
	font-size: 80%;
	line-height: 1.4em;
	font-family: "Lucida Grande", Arial, Tahoma, Verdana, sans-serif;
        
}

a {
	color: #723A08;
}

body:first-letter,
a:first-letter,
h1:first-letter,
h2:first-letter,
h3:first-letter,
h4:first-letter,
h5:first-letter,
h6:first-letter,
div:first-letter,
p:first-letter {
    text-transform:capitalize;
}

a:hover,
a.selected { <?php //@todo remove .selected ?>
	color: #555555;
	text-decoration: underline;
}

p {
	margin-bottom: 15px;
}

p:last-child {
	margin-bottom: 0;
}

pre, code {
	font-family: Monaco, "Courier New", Courier, monospace;
	font-size: 12px;
	
	background:#EBF5FF;
	color:#000000;
	overflow:auto;

	overflow-x: auto; /* Use horizontal scroller if needed; for Firefox 2, not needed in Firefox 3 */

	white-space: pre-wrap;
	word-wrap: break-word; /* IE 5.5-7 */
	
}

pre {
	padding:3px 15px;
	margin:0px 0 15px 0;
	line-height:1.3em;
}

code {
	padding:2px 3px;
}

.elgg-monospace {
	font-family: Monaco, "Courier New", Courier, monospace;
}

blockquote {
	line-height: 1.3em;
	padding:3px 15px;
	margin:0px 0 15px 0;
	background:#EBF5FF;
	border:none;
	
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}

h1, h2, h3, h4, h5, h6 {
	font-weight: bold;
	color: #723A08;
}

h1 { font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 200%; font-size: 1.8em; }
h2 { font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
font-size: 175%; line-height: 1.1em; padding-bottom:5px;
text-shadow:5px 5px 5px #ffffff;
}

h3 { font-size: 1.2em; }
h4 { font-size: 1.0em; }
h5 { font-size: 0.9em; }
h6 { font-size: 0.8em; }

.elgg-heading-site, .elgg-heading-site:hover {
font-family: NotethisRegular, "Lucida Sans Unicode", "Lucida Granve", sans-serif;
	font-size: 2em;
	line-height: 1.4em;
	color: white;
        font-weight: normal;
	text-shadow: 1px 2px 4px #333333;
	text-decoration: none;
}

.elgg-heading-main {
	float: left;
	max-width: 530px;
	margin-right: 10px;
}
.elgg-heading-basic {
	color: #0054A7;
	font-size: 1.2em;
	font-weight: bold;
}

.elgg-subtext {
	color: #666666;
	font-size: 85%;
	line-height: 1.2em;
	font-style: italic;
}

.elgg-text-help {
	display: block;
	font-size: 85%;
	font-style: italic;
}

.elgg-quiet {
	color: #666;
}

.elgg-loud {
	color: #0054A7;
}

/* ***************************************
	USER INPUT DISPLAY RESET
*************************************** */
.elgg-output {
	margin-top: 10px;
}

.elgg-output dt { font-weight: bold }
.elgg-output dd { margin: 0 0 1em 1em }

.elgg-output ul, .elgg-output ol {
	margin: 0 1.5em 1.5em 0;
	padding-left: 1.5em;
}
.elgg-output ul {
	list-style-type: disc;
}
.elgg-output ol {
	list-style-type: decimal;
}
.elgg-output table {
	border: 1px solid #ccc;
}
.elgg-output table td {
	border: 1px solid #ccc;
	padding: 3px 5px;
}
.elgg-output img {
	max-width: 100%;
}


