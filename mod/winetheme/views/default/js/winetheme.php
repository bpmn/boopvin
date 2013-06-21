<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    
elgg.provide('elgg.winetheme');



elgg.winetheme.init = function() {

// Animate Recent Activity on Homepage
var delay = 3500,
    speed = 1000,
    fade_speed = 1500,
    showing = 6;

    
function moveLast() {
  $("#avenue_activity > ul > li:last-child").remove().prependTo("#avenue_activity > ul");
}


function moveLast2() {
  $("#avenue_activity2 > ul > li:last-child").remove().prependTo("#avenue_activity2 > ul");
}


function shift() {
  //$('#myDiv').stop(true, true).fadeIn({ duration: slideDuration, queue: false }).css('display', 'none').slideDown(slideDuration);    

  //$("#avenue_activity > ul > li:visible").last().fadeOut({ duration: fade_speed, queue: false }).slideUp(speed, moveLast());
  //$("#avenue_activity > ul > li:first-child").fadeIn({ duration: fade_speed, queue: false }).css('display', 'none').slideDown(speed);

 
  $("#avenue_activity > ul > li:visible").last().slideUp(speed, moveLast());
  $("#avenue_activity > ul > li:first-child").slideDown(speed);

  setTimeout(shift, delay);
}



function shift2() {

  $("#avenue_activity2 > ul > li:visible").last().slideUp(speed, moveLast2());

  //$("#avenue_activity2 > ul > li:visible").last().fadeOut({ duration: fade_speed, queue: false }).slideUp(speed, moveLast2());
  //$("#avenue_activity2 > ul > li:first-child").fadeIn({ duration: fade_speed, queue: false }).css('display', 'none').slideDown(speed);
  $("#avenue_activity2 > ul > li:first-child").slideDown(speed);

  setTimeout(shift2, delay);
}



$(function(){
    
    
    //$('#avenue_slider').nivoSlider();
    
    $('#coin-slider').coinslider({ width: 735, height: 80, navigation: true, delay: 4000, effect: 'straight' });
    $("div#images_slider").show();

    
    
});

$(function(){
  //alert("Carousel");  

  $("#avenue_activity > ul > li").each(function(i) {
    if(i < showing) {
      $(this).show();
    }
  });
  
  setTimeout(shift, delay);
});

$(function(){
  //alert("Carousel");  

  $("#avenue_activity2 > ul > li").each(function(j) {
    if(j < showing) {
      $(this).show();
    }
  });
  
  setTimeout(shift2, delay);
});


}

elgg.register_hook_handler('init', 'system', elgg.winetheme.init);

<?php if (FALSE) : ?></script><?php endif; ?>





