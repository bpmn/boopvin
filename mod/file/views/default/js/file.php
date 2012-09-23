<?php
/*
 * script pour les file
 */
?>
<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>

elgg.provide('elgg.file');

elgg.file.init = function() { 
    if ($(".tidypics-lightbox").length) {
        $(".tidypics-lightbox").fancybox({'type':'image',
                                          'titlePosition':'inside'});
    }
        
}
elgg.register_hook_handler('init', 'system', elgg.file.init);        
<?php if (FALSE) : ?></script><?php endif; ?>