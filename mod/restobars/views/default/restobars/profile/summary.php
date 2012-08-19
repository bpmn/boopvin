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
<div class="groups-profile clearfix elgg-image-block resto_background">
    
    
	<div class="elgg-image">
		<div class="groups-profile-icon">
                    <div class="resto_icon">
			<?php echo elgg_view_entity_icon($restobar, 'large', array('href' => '')); ?>
                    </div>
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
			
                                if (elgg_is_logged_in()) {
                                    if (!$restobar->isMember()) {
                                        if ($restobar->isFriend()) {
                                            $url = "action/restobars/friends/remove?friend={$restobar->getGUID()}";
                                            $text = elgg_echo('friend:remove');
                                            $name = 'remove_friend_restobar';
                                    } else {
                                            $url = "action/restobars/friends/add?friend={$restobar->getGUID()}";
                                            $text = elgg_echo('friend:add');
                                            $name = 'add_friend_restobar';
                                }
                            
                            $url = elgg_add_action_tokens_to_url($url);
                            $item = new ElggMenuItem($name, $text, $url);
                            echo "</br>";
                            echo($item->getContent(array('class' => 'elgg-button elgg-button-action')));
                            
		} 
                
              }
                          
                        
                                
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
 