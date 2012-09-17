<?php
/*
 * Scripts du plugin wine
 * 
 */
?>

<?php if (FALSE) : ?>
    <script type="text/javascript">
<?php endif; ?>
    
    elgg.provide('elgg.wine');

    elgg.wine.init = function() {
        
        
        elgg.get_page_owner_guid();
        
        window.onload = getMyLocation;
        
        function getMyLocation() {
            if (navigator.geolocation) {
                
		navigator.geolocation.getCurrentPosition(
                displayLocation, 
                displayError);
            }
            else {
		alert("Oops, no geolocation support");
            }
        }
        
    function displayLocation(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        
        var url='/ajax/view/wines/ajax/dist_restobar';
        var guid=elgg.get_page_owner_guid();
        elgg.post(url, {
            data: {
		latitude: latitude,
                longitude:longitude,
                guid:guid
            },
            dataType:"html",
            success: function(resulthtml, success, xhr) {
                $('#suggestion').html(resulthtml);
            }
        });
        
    }     
    
        
        
        function displayError(error) {
            var errorTypes = {
		0: "Unknown error",
		1: "Permission denied",
		2: "Position is not available",
		3: "Request timeout"
            };
            var errorMessage = errorTypes[error.code];
            if (error.code == 0 || error.code == 2) {
		errorMessage = errorMessage + " " + error.message;
            }
            var div = document.getElementById("suggestion");
            div.innerHTML = errorMessage;
        }
        
        



}
elgg.register_hook_handler('init', 'system', elgg.wine.init);    
     
<?php if (FALSE) : ?></script><?php endif; ?>