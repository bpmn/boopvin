<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if (FALSE) : ?>
    <script type="text/javascript">
    <?php endif; ?>
    
    elgg.provide('elgg.validate_contact');
    
elgg.validate_contact.init = function() { 
    
   var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    var text=elgg.echo('contact:validate:name');
   
    frmvalidator.addValidation("name","req",text);

    frmvalidator.addValidation("email","req",elgg.echo('contact:validate:email'));

    frmvalidator.addValidation("email","email",elgg.echo('contact:validate:bad_email'));

    frmvalidator.addValidation("message","maxlen=2048",elgg.echo('contact:validate:email'));


    frmvalidator.addValidation("scaptcha","req",elgg.echo('contact:validate:antispam'));

}
/*
   Copyright (C) 2003-2008 JavaScript-Coder.com . All rights reserved.
*/

elgg.register_hook_handler('init', 'system', elgg.validate_contact.init);


<?php if (FALSE) : ?></script><?php endif; ?>