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


$vigne_separator = '/mod/winetheme/views/default/css/winetheme/images/vigne.png';
$vigne_separator = elgg_normalize_url($vigne_separator);

$fiche = '/mod/winetheme/views/default/css/winetheme/images/fiche.png';
$fiche = elgg_normalize_url($fiche);

$degust_header = '/mod/winetheme/views/default/css/winetheme/images/degustation_header3.png';
$degust_header = elgg_normalize_url($degust_header);


$degust = '/mod/winetheme/views/default/css/winetheme/images/degust.jpg';
$degust = elgg_normalize_url($degust);

$help = '/mod/winetheme/views/default/css/winetheme/images/help.jpg';
$help = elgg_normalize_url($help);

?>

.degust-layout-one-sidebar{
 text-align: center;
//width: 900px;
}

.degust-layout-one-sidebar table {
margin-left: auto;
margin-right: auto;
}

.vigne_separator {
clear:left;
height: 33px;
margin-bottom: 10px;
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
color: #800000;

}

.degust-feuille-content-value {
float:left;
width: 390px;
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



#vtab {
    margin: auto;
    width: 840px;
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
    color: #800;
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




.legend_class {
color: #800000;
background: #ffffff;
padding-left:10px;
padding-right:10px;
padding-top:5px;
padding-bottom:5px;

}




.validate_error_label > label > h2 {
color:#000000;
text-align: center;
    font-weight: normal;
    margin-bottom: 5px;
    margin-top: 5px;
}




.degust-side-head {
padding-top:10px;
height: auto;
width: auto;
text-transform:capitalize;  
background-position: right center;
}

#degust-fiche-left {
padding-top: 10px;
width: 610px;
//width: 200px;
margin: 8px 0 5px 0px;
background: #ffffff;
border: 1px none #800000;

}

.degust-sidebar {
    //float: right;
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
    //width: 250px;
    //width: auto;
    max-width: 250px;
}

.elgg-page-body-degust {
    //padding: 25px;
    background: #D8B771;
}



.input-degust { margin:0.6% 0% 1% 0%;}

.elgg-form-degusts-edit .input-degust label{
               font-family: arial;
               font-size:95%;
               font-weight: normal;} 

.elgg-form-degusts-edit label {font-family: Georgia, "Times New Roman", Times, serif;} 



                        
.elgg-form-degusts-edit fieldset fieldset {  border-color: black;
                                    border-width: 1px;
                                    border-style: solid;
                                    padding: 2%;
                                    } 
 #degust-profile-box {
 display:inline-block;
 width:100%;
        
 }
 .degust-profile-sections {    
         border-color: black;
         border-width: 1px;
         border-style: solid;
         padding: 2%;}

.degust-main{
    margin-bottom: 5px;
    margin-left: 5px;
    margin-right: 10px;
   
}

#degust-price{
 float: right;
}

/* texte du résumé de la degust in line
.degust-image-block .elgg-body {
    display:inline;
}*/

