<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    
    elgg.provide('elgg.restobar_edit');

    elgg.restobar_edit.init = function() {
                            
            
 //validation
    
    jQuery.validator.messages.required = "";

        $("#id_restobarform").validate({
    
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
                     alert("no errors found");

                    //$("div.error").hide();
                    //$("div.validate_error_label label").css("color", "black");

                }
            }
        });
        
    
    
        
  }
  
 


  
elgg.register_hook_handler('init', 'system', elgg.restobar_edit.init);    
     
<?php if (FALSE) : ?></script><?php endif; ?>