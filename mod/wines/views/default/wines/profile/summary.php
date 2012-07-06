<?php
/**
 * Wine profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['wine']
 */

if (!isset($vars['entity']) || !$vars['entity']) {
	echo elgg_echo('wine:notfound');
	return true;
}

$wine = $vars['entity'];
$owner = $wine->getOwnerEntity();

?>
<div class="groups-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="groups-profile-icon">
			<?php echo elgg_view_entity_icon($wine, 'large', array('href' => '')); ?>
		</div>
		<div class="groups-stats">
			<p>
				<b><?php echo elgg_echo("wine:owner"); ?>: </b>
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
				echo elgg_echo('wine:members') . ": " . $wine->getMembers(0, 0, TRUE);
			?>
			</p>
		</div>
	</div>

	<div class="groups-profile-fields elgg-body">
		<?php
			echo elgg_view('wines/profile/fields', $vars);
                        echo elgg_view('wines/profile/vintage',$vars);
                        
		?>
            
            </div>
   <?php// echo elgg_view('wines/profile/vintage',$vars);?>
</div>
<?php
?>
 