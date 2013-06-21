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
        
        /* var add_degust = $(".degust-add").click(function(e){
        e.preventDefault(); */  
        $(function() {
            $(".degust-add").nm({
                
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
                                option_price();
                                degust_event();
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
            //edit_overlay_degust(add_degust);
        });
        // });
        
        
   $( function() {
    degust_view_bind();
   });     
        
   function degust_view_bind(){
            
      
       
       
           $(".degust-view").nyroModal({
                callbacks: {             
                    initElts: function() {
                        if (!elgg.is_logged_in()) {
		
                
                
                            elgg.register_error(elgg.echo('loggedinrequired'));
                            $.nmTop().close();
                    //e.preventDefault();
                    //elgg.register_error(elgg.echo('loggedinrequired'))
                    //elgg.forward('');
                            };
                        
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
               
          
   }
        
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
                                option_price();
                                degust_event();
                                
                                
                                
                                
                                
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
            
        } 
        
        function degust_tab() {
            var $items = $('#vtab>ul>li');
            $items.click(function() {
                $items.removeClass('selected');
                $(this).addClass('selected');
                
                var index = $items.index($(this));
                $('#vtab>div').hide().eq(index).show();
            }).eq(0).click();
        }
        
        
        
        
       
       function degust_button() {
            
            var winefield = document.getElementById('metadatafield');
            var winecolor = winefield.getAttribute('data-winetype'); // winetype = "red"
            // visuelle
            
            
            // intensite couleur
            var dim =$( "#button_selectcouleur_intensity" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectcouleur_intensity" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectcouleur_intensity").buttonset().css("margin-right", "0px");
            
            
            
            
            //couleur
            dim =$( "#button_selectcouleur" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectcouleur" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectcouleur" ).buttonset().css("margin-right", "0px");
            
              
            if (winecolor == "rose" || winecolor == "rose_sparkling") {
                $( "<div id='couleurs_rose'></div>" ).insertBefore('#button_selectcouleur');
            }
            
            if (winecolor == "red") {
                $( "<div id='couleurs_rouge'></div>" ).insertBefore('#button_selectcouleur');
            }
            if (winecolor == "white" || winecolor == "moelleux" || winecolor == "white_sparkling"){
              
                $( "<div id='couleurs_blanc'></div>" ).insertBefore('#button_selectcouleur');
            }
            
         
            
            
            //Mousse
            dim =$( "#button_selectmousse" ).attr('data-dim');
            dim=100/dim;    
            $( "#button_selectmousse" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectmousse" ).buttonset().css("margin-right", "0px");
            
            dim =$( "#button_selectbulle" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectbulle" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectbulle" ).buttonset().css("margin-right", "0px");            
            
           
            
            
            //Reflets
            dim =$( "#button_selectreflet" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectreflet" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectreflet" ).buttonset().css("margin-right", "0px");
            
            if (winecolor == "red") {
              
                $( "<div id='reflets_rouge'></div>" ).insertBefore('#button_selectreflet');
            }
            if (winecolor == "white" || winecolor == "moelleux"){
            
                $( "<div id='reflets_blanc'></div>" ).insertBefore('#button_selectreflet');
                
            }
            
            
            // olfactive
            
            // intensite nez      
            dim =$( "#button_selectnez_intensity" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectnez_intensity" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectnez_intensity" ).buttonset().css("margin-right", "0px");
            
     
            $( "#button_selectnez" ).buttonset().find('label').width("20%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectnez" ).buttonset().css("margin-right", "0px");
            //$( "#button_selectnez" ).buttonset().find('span').css("padding", "0.4em 0.3em");
            
            
            // gustative
           
            //Rondeur
            dim =$( "#button_selectrondeur" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectrondeur" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");   
            $( "#button_selectrondeur" ).buttonset().css("margin-right", "0px");
   
            //acidité
            dim =$( "#button_selectacidity" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectacidity" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectacidity" ).buttonset().css("margin-right", "0px");
            
            //douceur
            dim =$( "#button_selectdouceur" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectdouceur" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectdouceur" ).buttonset().css("margin-right", "0px");
            
            //bulle en bouche
            dim =$( "#button_selectpalet_bulle" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectpalet_bulle" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectpalet_bulle" ).buttonset().css("margin-right", "0px");
            
            //Alcool
            dim =$( "#button_selectalcool" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectalcool" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selectalcool" ).buttonset().css("margin-right", "0px");
            
            //Tanin
            dim =$( "#button_selecttanin" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selecttanin" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
            $( "#button_selecttanin" ).buttonset().css("margin-right", "0px");
            //Longueur  
            dim =$( "#button_selectlongueur" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectlongueur" ).buttonset().css("margin-right", "0px");
            $( "#button_selectlongueur" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");            
            
            //Equilibre
            dim =$( "#button_selectequilibre" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectequilibre" ).buttonset().css("margin-right", "0px");
            $( "#button_selectequilibre" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");            
               
          
            // final
            //evolution
            dim =$( "#button_selectevolution" ).attr('data-dim');
            dim=100/dim;
            $( "#button_selectevolution" ).buttonset().find('label').width(dim+"%").css("font-size", "100%").css("font-weight", "normal");
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
        submitHandler: function(form){
            var url=$('#degustform').attr('action');
            var data=$("#degustform :input").serialize();
            var page_guid=elgg.get_page_owner_guid();
            data=data+"&page_owner_guid="+page_guid;
            
            elgg.action(url,{
                    data:data,
                    success: function(resulthtml, success, xhr) {
                                $.nmTop().close();
                                $('.degust_list').html(resulthtml.output);
                                degust_view_bind();
                            }
            
                });
        },

        highlight: function(element, errorClass) {
            $(element).parent().css({
                "border-radius":"0px"
            });
            $(element).parent().css({
                "box-shadow":"0px 0px 10px #ff0000"
            });
            
            
        },
        
        unhighlight: function(element, errorClass) {
            $(element).parent().css({
                "box-shadow":"none"
            });
            
            
        },
        invalidHandler: function(e, validator) {
            e.preventDefault();
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
                
                //var url=$('#degustform').attr('action').val();
                //var data=$("#degustform :input").serializeArray();
                //elgg.action(url,{data: data});
                //$.nmTop().close();
                
                
                
                
                
            }
        }
    });
}


// soumettre la requête save par ajax 
        
function degust_event(){
$("#degustform").submit(function(e){
    e.preventDefault();
 
});

$(".degust-requires-confirmation").click(function(e) {
	var confirmText = $(this).attr('rel') || elgg.echo('question:areyousure');
	if (!confirm(confirmText)) {
		e.preventDefault();
	}else{
            e.preventDefault();
            var url=$(this).attr('href');
            var page_guid=elgg.get_page_owner_guid();
            elgg.action(url,{
                    data:{page_owner_guid:page_guid},
                    success: function(json, success, xhr) {
                                $.nmTop().close();
                                $('.degust_list').html(json.output);
                                degust_view_bind();
                            }
            
                });
        }
    });


}

function option_price(){
var array_euro=new Array("","&lt;6€","6€-10€","10€-15€","15€-20€","20€-25€","25€-30€","30€-40€","40€-50€","60€-70€","70€-80€","80€-100€","&gt;100€");
var array_dollar=new Array("","&lt;$10","$10-$15","$15-$20","$20-$25","$25-$30","$30-$40","$40-$50","$60-$70","$70-$80","$80-$100","&gt;$100");
var array_livre=new Array("","&lt;£10","£10-£15","£15-£20","£20-£25","£25-£30","£30-£40","£40-£50","£60-£70","£70-£80","£80-£100","&gt;£100");
    $('input[name$="currency"]').change(function(){
        var monnaie=$(this).val();
        var list_option;
        if (monnaie == 'euro')
            list_option=array_euro;
        if (monnaie == 'dollar')
            list_option=array_dollar;
        if (monnaie == 'livre')
            list_option=array_livre;
            
        $('select[name$="price"]').empty();
        $.each(list_option, function(key,value) {
            $('select[name$="price"]').append($("<option></option>").html(value));});
    });
}

        
 }
 
elgg.register_hook_handler('init', 'system', elgg.degust.init);


<?php if (FALSE) : ?></script><?php endif; ?>
