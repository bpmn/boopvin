<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    elgg.provide('hj.livesearch.autocomplete');

    hj.livesearch.autocomplete.init = function() {
        $('.elgg-input-autocomplete')
        .autocomplete({
            source: function(request, response) {
                //var action = elgg.security.addToken('action/search/parse?entity_type=group&entity_subtype=wine&search_entity=entities');
                var action = elgg.security.addToken('action/search/parse');
                elgg.action(action, {
                    data : {
                        term : request.term,
                        entity_type:'group',
                        entity_subtype:'wine',
                        search_type:'entities'
                    
                    },
                             
                    success: function(data) {
                        response($.map(data.output, function(item) {
                            return {
                                label: item.label
                            }
                        }));
                    }
                });
            },
            minLength: 1
            //,appendTo: '#my-suggestions'
        })
        
        .data("autocomplete")._renderItem = function(ul, item) {
            r = item.label;		
            return $("<div></div>")
            .data("item.autocomplete", item)
            .append(r)
            .appendTo(ul);
        }
        
        
        
     
        
    };

     
    



    elgg.register_hook_handler('init', 'system', hj.livesearch.autocomplete.init);
   // elgg.register_hook_handler('success', 'hj:framework:ajax', hj.livesearch.autocomplete.init, 500);
<?php if (FALSE) : ?></script><?php endif; ?>