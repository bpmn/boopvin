<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    elgg.provide('search.auto_other');

    search.auto_other.init = function() {
       
     var data_entity_type=$('.elgg-input-search-other').attr('data-entity_type');   
     var data_entity_subtype=$('.elgg-input-search-other').attr('data-entity_subtype');   
     $('.elgg-input-search-other')
        .autocomplete({
            source: function(request, response) {
                var action = elgg.security.addToken('action/search/parse');
                
                elgg.action(action, {
                    data : {
                        term : request.term,
                        entity_type:data_entity_type,
                        entity_subtype:data_entity_subtype,
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

     
    



    elgg.register_hook_handler('init', 'system', search.auto_other.init);
   // elgg.register_hook_handler('success', 'hj:framework:ajax', hj.livesearch.autocomplete.init, 500);
<?php if (FALSE) : ?></script><?php endif; ?>