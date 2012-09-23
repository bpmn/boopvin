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


