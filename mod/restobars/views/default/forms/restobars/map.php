<?php
/*
 * Form pour confirmer l'adresse et récupérer les coordonnées lat et long
 */
?>

    <div id="maps_canvas"></div>
    <div id="map_fields">
        <label for="street">
            <?php echo elgg_echo('restobar:street'); ?>
            <input id="street" type="text" name="street">
        </label>
        <label for="city">
            <?php echo elgg_echo('restobar:city'); ?>
            <input id="city" type="text" name="city">
        </label>
        <label for="cap">
            <?php echo elgg_echo('restobar:cap'); ?>
            <input id="cap" type="text" name="cap">
        </label>
        <label for="prov">
            <?php echo elgg_echo('restobar:prov'); ?>
            <input id="prov" type="text" name="prov">
        </label>
        <label for="region">
            <?php echo elgg_echo('restobar:region'); ?>
            <input id="region" type="text" name="region">
        </label>
        <label for="nation">
            <?php echo elgg_echo('restobar:nation'); ?>
            <input id="nation" type="text" name="nation">
        </label>
        <label for="latitude">
            <?php echo elgg_echo('restobar:latitude'); ?>
            <input id="latitude" type="text" name="latitude">
        </label>
        <label for="longitude">
            <?php echo elgg_echo('restobar:longitude'); ?>
            <input id="longitude" type="text" name="longitude">
        </label>
    </div>
    
 


<div class="elgg-foot">
    
<?php


echo elgg_view('input/submit', array('value' => elgg_echo('save'),'id'=>'map_submit'));


?>
</div>

