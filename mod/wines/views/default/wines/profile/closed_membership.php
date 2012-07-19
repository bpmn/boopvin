<?php
/**
 * Display message about closed membership
 * 
 * @package ElggWine
 */

?>
<p class="mtm">
<?php 
echo elgg_echo('wine:closedgroup');
if (elgg_is_logged_in()) {
	echo ' ' . elgg_echo('wine:closedwine:request');
}
?>
</p>
