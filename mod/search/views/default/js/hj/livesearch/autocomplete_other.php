<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    elgg.provide('hj.livesearch.autocomplete_other');

    hj.livesearch.autocomplete_other.init = function() {
       
        
        
     $('.elgg-input-search-other')
        .autocomplete({
            source: function(request, response) {
                var action = elgg.security.addToken('action/search/parse?entity_type=group&entity_subtype=wine&search_entity=entities');
                
                elgg.action(action, {
                    data : {
                        term : request.term,
                        entity_type:'group',
                        entity_subtype:'restobar',
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
        };
        
        
    };

     
    



    elgg.register_hook_handler('init', 'system', hj.livesearch.autocomplete_other.init);
   // elgg.register_hook_handler('success', 'hj:framework:ajax', hj.livesearch.autocomplete.init, 500);
<?php if (FALSE) : ?></script><?php endif; ?>