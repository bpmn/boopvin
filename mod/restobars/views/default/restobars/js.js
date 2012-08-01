/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



// this adds a class to support IE8 and older
elgg.register_hook_handler('init', 'system', function() {
	// jQuery uses 0-based indexing
	$('#groups-tools').children('li:even').addClass('odd');
//});


// Select another vintage on wine page
        $('#wine select#vintage').change(function() {

            var url=$(this).attr('data-url')+  $(this).val().toString();
            elgg.forward(url);
//window.location.href = $(this).attr('data-url') + $.query.set('vintage', $(this).val()).toString();
    }); 
}); 