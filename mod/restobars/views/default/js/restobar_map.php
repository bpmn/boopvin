<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
  
elgg.provide('elgg.restobar');

    elgg.restobar.init = function() { 
        
                
        $("#GetMaps").click(function(e){
            e.preventDefault();
   
            var input_address = jQuery.trim( $("#adresse").val() );
            
        if( input_address == '' ){
            alert('Compile the field address!');     
            return false;
        }else{
            
          
            var url=elgg.normalize_url('restobar/map');
            $.nmManual(url,{
                
                
                callbacks: {
                    
                    initElts: function() {
                        $(".elgg-page-topbar").css({"z-index":" 0"});
                        $(".elgg-menu-site").css({"z-index":" 0"}); 
                        
                    },
                    
                    filledContent: function(){
                        
                        get_restobar_address();   
                        
                    },
                    
                    afterClose: function() {
                        $(".elgg-page-topbar").css({
                            "z-index":" 9000"
                        });
                        $(".elgg-menu-site").css({
                            "z-index":" 1"
                        });
                    }
                }
                
            });
            
            
            
        }
            
            
            
            
        });
                
                
               
      
        
        get_restobar_address =function() {
            
            // geocoder
           
            var input_address = jQuery.trim( $("#adresse").val() );
            var geocoder = new google.maps.Geocoder(); 
            geocoder.geocode( { address: input_address }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();   
                    // set input form
                    var components = results[0].address_components;
                    $.each(components, function(index, value) {
                        if(value.types[0] != "undefined"){
                            if(value.types[0] == 'street'){$("#street").val(value.long_name);}
                            else if(value.types[0] == 'country'){$("#nation").val(value.long_name);}
                            else if(value.types[0] == 'administrative_area_level_1'){$("#region").val(value.long_name);}
                            else if(value.types[0] == 'administrative_area_level_2'){$("#prov").val(value.short_name);}
                            else if(value.types[0] == 'postal_code'){$("#cap").val(value.long_name);}
                            else if(value.types[0] == 'route'){$("#street").val(value.long_name);}
                            else if(value.types[0] == 'locality'){$("#city").val(value.long_name);}
                        }
                    });
                    $("#latitude").val(lat);
                    $("#longitude").val(lng);
                    
                    $("#adresse").val(results[0].formatted_address);
                }  
            });
            
        }
       
    }
    
elgg.register_hook_handler('init', 'system', elgg.restobar.init);    
    
    


  
<?php if (FALSE) : ?></script><?php endif; ?>