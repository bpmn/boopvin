<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>

elgg.provide('elgg.degust');


    
 
elgg.degust.init = function() {
 
 /* les actions sur événements*/
 
    $(".degust-add").click(function(e){
        e.preventDefault();   
        var wine_guid = elgg.get_page_owner_guid();
        var action = 'add/'+wine_guid+'/';
        edit_overlay_degust(action);
    });
    
    
   
    $(function() { 
        
        $(".degust-view").nyroModal({
           callbacks: {             
               initElts: function() {
                    $(".elgg-page-topbar").css({
                        "z-index":" 0"
                    });
                    $(".elgg-menu-site").css({
                        "z-index":" 0"
                    });    
                },
               filledContent: function(){
                   
                    degust_edit();
                    
                },
               beforeClose: function() {
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
  

//les fonctions
 
 
function degust_edit (action){

    $(".degust-edit").click(function(e){    
    
    e.preventDefault();
    var action= $(this).attr('data-action'); 
    $.nmTop().close();
    edit_overlay_degust(action);
});
}

  function edit_overlay_degust(action) {
         
        var edit_url=elgg.normalize_url('degust/'+action);
       
        $.nmManual(edit_url,{
           
            callbacks: {
        
                initElts: function() {
                    $(".elgg-page-topbar").css({
                        "z-index":" 0"
                    });
                    $(".elgg-menu-site").css({
                        "z-index":" 0"
                    }); 
          
       
                },
        
                filledContent: function(){
                  
                    if ($("#metadatafield_overlay").length > 0){
                        // do something here

                        var overlayfield = document.getElementById('metadatafield_overlay');
                        var overlaydegustation = overlayfield.getAttribute('data-overlay'); // check if we are in degustation mode
      
                        if(overlaydegustation == "overlay_degustation") {
                            degust_tab();
                            degust_button();
                            degust_validate();
           
                        } else {
                            alert("not degust");
                        }
                    } else {
                        $( ".degust-side-head").css("background", "#ffffff");

                    }
           
                },
       
        
                beforeClose: function() {
                    $(".elgg-page-topbar").css({
                        "z-index":" 9000"
                    });
                    $(".elgg-menu-site").css({
                        "z-index":" 1"
                    });
                }
            }
   
        });
        
        $.nmTop().resize(true);
    }   
    
    function degust_tab() {
        var $items = $('#vtab>ul>li');
        $items.click(function() {
            $items.removeClass('selected');
            $(this).addClass('selected');

            var index = $items.index($(this));
            $('#vtab>div').hide().eq(index).show();
        }).eq(1).click();
    }

 
 
 
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
                    

        $( "#button_selectlongueur" ).buttonset().css("margin-right", "0px");
        $( "#button_selectlongueur" ).buttonset().find('label').width("144").css("font-size", "100%").css("font-weight", "normal");            
        // final
        $( "#button_selectevolution" ).buttonset().find('label').width("120").css("font-size", "100%").css("font-weight", "normal");
        $( "#button_selectevolution" ).buttonset().css("margin-right", "0px");
                
                
        // complexité du nez
        $('#button_selectcomplexity').append('<span id="complexity"></span>')
        var complex=$('#button_selectcomplexity .input-degust').val();
        if(complex > 0){
           var result=elgg.echo("degust:complexity:"+complex);
            $('#complexity').html(result);  
        }
        b = $('#button_selectnez input[type=checkbox]');
        b.click(function() {
            
            var complexity = b.filter(':checked').length;
            if (complexity <= 2){
                complexity=1;
            } else if (complexity == 3){
                complexity=2;
            } else if (complexity == 4){
                complexity=3;
            } else {
                complexity=4;
            }
            var result=elgg.echo("degust:complexity:"+complexity);
            $('#complexity').html(result);
            $('#button_selectcomplexity .input-degust').val(complexity);
        });    
                
    }
              
 
    
    function degust_validate() {     
        jQuery.validator.messages.required = "";

        $("#degustform").validate({
    
            highlight: function(element, errorClass) {
                $(element).parent().css({
                    "border-radius":"5px"
                });
                $(element).parent().css({
                    "box-shadow":"0px 0px 5px #ff0000"
                });

       
            },
        
            unhighlight: function(element, errorClass) {
                $(element).parent().css({
                    "box-shadow":"none"
                });

        
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
   
}

elgg.register_hook_handler('init', 'system', elgg.degust.init);


<?php if (FALSE) : ?></script><?php endif; ?>