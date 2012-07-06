<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


elgg.register_hook_handler('init', 'system', function() {
    $( "#tabb" ).tabs();
        $( "#phil_select").button();
});






