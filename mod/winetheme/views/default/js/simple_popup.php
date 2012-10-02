<?php
/*
 * Scripts du plugin popup
 * script commun pour les besoins d'utilisation de popup simple
 * 
 */
?>

<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    
elgg.provide('elgg.popup');
    
elgg.popup.init = function() {
        
    $(function() { 
            
        $(".elgg-overlay").nyroModal({
            callbacks: {             
                initElts: function() {
                    $(".elgg-page-topbar").css({
                        "z-index":" 0"
                    });
                    $(".elgg-menu-site").css({
                        "z-index":" 0"
                    });    
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
}  
    
elgg.register_hook_handler('init', 'system', elgg.popup.init); 

<?php if (FALSE) : ?></script><?php endif; ?>