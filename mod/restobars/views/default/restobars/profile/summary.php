<?php
/**
 * restobar profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['restobar']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('restobar:notfound');
	return true;
}

$restobar = $vars['entity'];
$owner = $restobar->getOwnerEntity();

?>
<div class="groups-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="groups-profile-icon">
			<?php echo elgg_view_entity_icon($restobar, 'large', array('href' => '')); ?>
		</div>
		<div class="groups-stats">
			<p>
				<b><?php echo elgg_echo("restobar:owner"); ?>: </b>
				<?php
					echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));
				?>
			</p>
			<p>
			<?php
				echo elgg_echo('restobar:members') . ": " . $restobar->getMembers(0, 0, TRUE);
			?>
			</p>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php
			echo elgg_view('restobars/profile/fields', $vars);
                        
		?>
            
            </div>
   
</div>
<?php
?>
 