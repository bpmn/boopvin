elgg.provide('elgg.winetheme');



elgg.winetheme.init = function() {

// Animate Recent Activity on Homepage
var delay = 3000,
    speed = 1000,
    showing = 3;
    
function moveLast() {
  $("#avenue_activity > ul > li:last-child").remove().prependTo("#avenue_activity > ul");
}

function shift() {
  $("#avenue_activity > ul > li:visible").last().slideUp(speed, moveLast());
  $("#avenue_activity > ul > li:first-child").slideDown(speed);
  setTimeout(shift, delay);
}

$(document).ready(function() {
  //alert("Carousel");  
  $("#avenue_activity > ul > li").each(function(i) {
    if(i < showing) {
      $(this).show();
    }
  });
  setTimeout(shift, delay);
});

}

elgg.register_hook_handler('init', 'system', elgg.winetheme.init);