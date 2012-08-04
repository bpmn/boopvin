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
            
     //$(".elgg-overlay").nmCall({  
          
    callbacks: {
        
        initElts: function() {
            $(".elgg-page-topbar").css({"z-index":" 0"});
            $(".elgg-menu-site").css({"z-index":" 0"}); 
       
        },
        
        filledContent: function(){
        
           $( "#tabs" ).tabs();
           $(degust_button);
           
        },
        afterClose: function() {
            $(".elgg-page-topbar").css({"z-index":" 9000"});
            $(".elgg-menu-site").css({"z-index":" 1"});
        }
    }
   
}
    


);
	});
    
 
    
    jQuery.validator.messages.required = "";
    



    $("#degustform").validate({
    
        highlight: function(element, errorClass) {
            $(element).parent().css({"border-radius":"5px"});
            $(element).parent().css({"box-shadow":"0px 0px 5px #ff0000"});

       
        },
        
        unhighlight: function(element, errorClass) {
            $(element).parent().css({"box-shadow":"none"});

        
        },
        invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
					? 'You missed 1 field. It has been highlighted below'
					: 'You missed ' + errors + ' fields.  They have been highlighted below';
				alert(message);
                                //$("div.error span").html(message);
				//$("div.error").show();
                                //$("div.validate_error_label label").css("color", "red");
                                                             

			} else {
				//$("div.error").hide();
                                //$("div.validate_error_label label").css("color", "black");

			}
		}
        //rules: {
        //        couleur_intensity: "required",
        //        couleur: "required",
         //       nez:"required",
         //       nez_intensity:"required",
         //       note: "required"
         //       },
       
                
           
                
                
});
      
 
   
}

elgg.register_hook_handler('init', 'system', elgg.overlay.init);

