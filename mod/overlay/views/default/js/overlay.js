/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




elgg.provide('elgg.overlay');



elgg.overlay.init = function() {
    
    
function degust_tab() {
            var $items = $('#vtab>ul>li');
            $items.click(function() {
            $items.removeClass('selected');
            $(this).addClass('selected');

            var index = $items.index($(this));
            $('#vtab>div').hide().eq(index).show();
            }).eq(1).click();
}


//  var degust_button = function() {



  function degust_button() {
  

          
      
      var winefield = document.getElementById('metadatafield');
      var winecolor = winefield.getAttribute('data-winetype'); // winetype = "red"
             // visuelle
                $( "#button_selectcouleur_intensity" ).buttonset().find('label').width("180").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectcouleur_intensity").buttonset().css("margin-right", "0px");

                if (winecolor == "rose") {
                $( "#button_selectcouleur" ).buttonset().find('label').width("103").css("font-size", "100%").css("font-weight", "normal");
                $( "<div id='couleurs_rose'></div>" ).insertBefore('#button_selectcouleur');
                }
                if (winecolor == "red") {
                $( "#button_selectcouleur" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "<div id='couleurs_rouge'></div>" ).insertBefore('#button_selectcouleur');
                }
                if (winecolor == "white"){
                $( "#button_selectcouleur" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "<div id='couleurs_blanc'></div>" ).insertBefore('#button_selectcouleur');
                }
                              
                $( "#button_selectcouleur" ).buttonset().css("margin-right", "0px");
                
                

                if (winecolor == "red") {
                $( "#button_selectreflet" ).buttonset().find('label').width("120").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectreflet" ).buttonset().css("margin-right", "0px");
                $( "<div id='reflets_rouge'></div>" ).insertBefore('#button_selectreflet');
                }
                if (winecolor == "white"){
                $( "#button_selectreflet" ).buttonset().find('label').width("180").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectreflet" ).buttonset().css("margin-right", "0px");  
                $( "<div id='reflets_blanc'></div>" ).insertBefore('#button_selectreflet');

                }
            

                // offalctive
                
                $( "#button_selectnez_intensity" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectnez_intensity" ).buttonset().css("margin-right", "0px");
                    
                $( "#button_selectnez" ).buttonset().find('label').width("81").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectnez" ).buttonset().css("margin-right", "0px");
                $( "#button_selectnez" ).buttonset().find('span').css("padding", "0.4em 0.3em");

                    
                // gustative

                $( "#button_selectrondeur" ).buttonset().find('label').width("120").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectrondeur" ).buttonset().css("margin-right", "0px");
                    

                $( "#button_selectacidity" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectacidity" ).buttonset().css("margin-right", "0px");
                    
                $( "#button_selectalcool" ).buttonset().find('label').width("180").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectalcool" ).buttonset().css("margin-right", "0px");
                    
                    
                    
                    
                $( "#button_selecttanin" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selecttanin" ).buttonset().css("margin-right", "0px");
                
                
                    
                $( "#button_selectretro" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectretro" ).buttonset().css("margin-right", "0px");
                    

                $( "#button_selectlongueur" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectlongueur" ).buttonset().css("margin-right", "0px");
                    
                // final
                $( "#button_selectevolution" ).buttonset().find('label').width("120").css("font-size", "100%").css("font-weight", "normal");
                $( "#button_selectevolution" ).buttonset().css("margin-right", "0px");
                
                
      
             
                
  }
              
/*
                var select = $( "#id_note" );
		var slider = $( "<div id='slider'></div>" ).insertAfter( select ).slider({
			min: 1,
                	max: 20,
			range: "min",
			value: select[ 0 ].selectedIndex + 1,
			slide: function( event, ui ) {
				select[ 0 ].selectedIndex = ui.value - 1;
			}
		});
                
		$( "#id_note" ).change(function() {
			slider.slider( "value", this.selectedIndex + 1 );
		});
               
                
               
              }
              */
   
     
 
  $(function(){
        $(".elgg-overlay").nyroModal({
            
     //$(".elgg-overlay").nmCall({  
          
    callbacks: {
        
        initElts: function() {
            $(".elgg-page-topbar").css({"z-index":" 0"});
            $(".elgg-menu-site").css({"z-index":" 0"}); 
          

       
        },
        
        filledContent: function(){
            
            if ($("#metadatafield_overlay").length > 0){
            // do something here

                  var overlayfield = document.getElementById('metadatafield_overlay');
                  var overlaydegustation = overlayfield.getAttribute('data-overlay'); // check if we are in degustation mode
      
                   if(overlaydegustation == "overlay_degustation") {
                    degust_tab();
                    degust_button(); 
           
                  } else {alert("not degust");}
            } else {
                $( ".degust-side-head").css("background", "#ffffff");

            }
           
        },
       
        
        afterClose: function() {
            $(".elgg-page-topbar").css({"z-index":" 9000"});
            $(".elgg-menu-site").css({"z-index":" 1"});
        }
    }
   
});
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
              });
      

   
}

elgg.register_hook_handler('init', 'system', elgg.overlay.init);
