<?php
/**
 * Display message about closed membership
 * 
 * @package ElggRestobar
 */

?>
<p class="mtm">
<?php 
echo elgg_echo('restobar:closedgroup');
if (elgg_is_logged_in()) {
	echo ' ' . elgg_echo('restobar:closedrestobar:request');
}
?>
</p>
