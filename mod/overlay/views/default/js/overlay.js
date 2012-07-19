/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




elgg.provide('elgg.overlay');

elgg.overlay.init = function() {
    
    
    
  var degust_button = function() {
             // visuelle
                $( "#button_selectcouleur_intensity" ).buttonset().find('label').width(610/4).css("font-size", "100%").css("font-weight", "normal");

                $( "#button_selectcouleur" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");

                $( "#button_selectreflet" ).buttonset().find('label').width(610/6).css("font-size", "100%").css("font-weight", "normal");
                
                // offalctive
                
                $( "#button_selectnez_intensity" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectnez" ).buttonset().find('label').width(610/9);
                
                // gustative

                $( "#button_selectrondeur" ).buttonset().find('label').width(610/6).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectacidity" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectalcool" ).buttonset().find('label').width(610/4).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selecttanin" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectretro" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectlongueur" ).buttonset().find('label').width(610/5).css("font-size", "100%").css("font-weight", "normal");

                // final
                $( "#button_selectevolution" ).buttonset().find('label').width(610/6).css("font-size", "100%").css("font-weight", "normal");
                
              }
              
    
    
 
     $(function() {
	$(".elgg-overlay").nyroModal({
            
    callbacks: {
        
        initElts: function() {
            $(".elgg-page-topbar").css({"z-index":" 0"});
            $(".elgg-menu-site").css({"z-index":" 0"}); 
       
        },
        //load: function(){
        filledContent: function(){
        //size: function(){
           $( "#tabs" ).tabs();
           $(degust_button);
        },
        afterClose: function() {
            $(".elgg-page-topbar").css({"z-index":" 9000"});
            $(".elgg-menu-site").css({"z-index":" 1"});
        }
    }
   // anim: {
   //     resize:false
        
   // }
}
    


);
	});
    
    
    
  //   $(function() {
//	$(".elgg-overlay").nyroModal();
//	});
   
}

elgg.register_hook_handler('init', 'system', elgg.overlay.init);

