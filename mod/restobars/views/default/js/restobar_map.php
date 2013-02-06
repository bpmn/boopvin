<?php
/*
 * Scripts du plugin restobar
 * 
 */
?>

<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
  
elgg.provide('elgg.restobar');

    elgg.restobar.init = function() { 
          
          
  /*Visualisation de la carte ds un overlay en cliquant sur l'adresse dans la page profle du restobar*/        
          
        $("#showmap").click(function(e){
            e.preventDefault();
            var url=elgg.normalize_url('ajax/view/restobars/ajax/showmap');
            $.nmManual(url,{
                callbacks: {
                    
                    initElts: function() {
                        $(".elgg-page-topbar").css({"z-index":" 0"});
                        $(".elgg-menu-site").css({"z-index":" 0"}); 
                        
                    },
                    
                    afterShowCont: function(){
                        /* on récupère les coordonnées Lat et Long en utilisant les attr data-x du html5*/
                        
                        var lat=$("#showmap").attr('data-lat');
                        var lng=$("#showmap").attr('data-lng');
                     
                 
                        var myLatlng = new google.maps.LatLng(lat,lng);
                        var myOptions = {
                                zoom: 13,
                                center: myLatlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }
                        var map = new google.maps.Map(document.getElementById("showmap_pop"), myOptions);
                        var restobar_marker = new google.maps.Marker({
						position: myLatlng, 
						map: map					
					});
                          
                        

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
            
        });
    
    
    
    
/* aquisition des coordonnées d'un restobar a partir de la page edit du restobar, visu dans un overlay*/
      
        $("#GetMaps").click(function(e){
            e.preventDefault();   
        var input_address = jQuery.trim( $("#id_location").val() );  
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
                    
                    afterShowCont: function(){
                        
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
                
                
               
      
        
       function get_restobar_address () {
            
            // geocoder
           
            var input_address = jQuery.trim( $("#id_location").val() );
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
                    
                    var map;
                    var myLatlng = new google.maps.LatLng(lat,lng);
                    var myOptions = {
                                zoom: 13,
                                center: myLatlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }
                    map = new google.maps.Map(document.getElementById("maps_canvas"), myOptions);
                    var restobar_marker = new google.maps.Marker({
						position: myLatlng, 
						map: map,
						title:$("input[class=elgg-input-text][type=text][name=name]").val()
					}); 
                                              
                    $("#latitude").val(lat);
                    $("#longitude").val(lng);
                    
                    $("#map_submit").click(function(e){
                        e.preventDefault();
                        $("#id_location").val(results[0].formatted_address);
                        $("#lat").val(lat);
                        $("#long").val(lng);
                        $.nmTop().close();
                        
                    });
                }  
            });
            
        }
      
// script restobar_news
      
        $("#restobar_news").live('submit',function(e) {
            e.preventDefault();
            var url=$(this).attr('action');
            var data=$("#restobar_news :input").serialize();
            elgg.action(url,{data:data,dataType: "html",
                    success: function(json, success, xhr) {
                                $.nmTop().close();
                                $('#elgg-text-restobarnews').html(json.output);
                                
                            }
            
                });
        
        
});   
      
   
      $(function(){getMyLocation();});
        //window.onload = getMyLocation;
        
        
        
        function getMyLocation() {
            if (navigator.geolocation) {
                
		navigator.geolocation.getCurrentPosition(
                displayLocation, 
                displayError);
            }
            else {
                var msg=elgg.echo('geo:notsupported');
                alert(msg);
		//alert("Oops, no geolocation support");
            }
        }
        
    function displayLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        var url='/ajax/view/restobars/ajax/restobar_around';
        var guid=elgg.get_page_owner_guid();
        elgg.post(url, {
            data: {
		latitude: latitude,
                longitude:longitude
                
            },
            dataType:"html",
            success: function(resulthtml, success, xhr) {
                $('#list-around').html(resulthtml);
            }
        });
        
    }     
    
        
        
    function displayError(error) {
            /*var errorTypes = {
		0: "Unknown error",
		1: "Permission denied",
		2: "Position is not available",
		3: "Request timeout"
            };*/
            
            var errorTypes = {
		0: elgg.echo('geo:error:0'),
		1: elgg.echo('geo:error:1'),
		2: elgg.echo('geo:error:2'),
		3: elgg.echo('geo:error:3')
            };
            var errorMessage = errorTypes[error.code];
            if (error.code == 0 || error.code == 2) {
		errorMessage = errorMessage + " " + error.message;
            }
            var div = document.getElementById("list-around");
            div.innerHTML = errorMessage;
        }

    }
    
elgg.register_hook_handler('init', 'system', elgg.restobar.init);    
    
    


  
<?php if (FALSE) : ?></script><?php endif; ?>