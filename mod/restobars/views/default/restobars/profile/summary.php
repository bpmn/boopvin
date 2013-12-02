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
<div class="restobars-profile clearfix elgg-image-block resto_background">
    
    
	<div class="elgg-image">
		<div class="restobars-profile-icon">
                    <div class="resto_icon">
                        <?php
				// we don't force icons to be square so don't set width/height
				echo elgg_view_entity_icon($restobar, 'large', array(
					'href' => '',
					'width' => '',
					'height' => '',
				)); 
			?>
                    </div>
                </div>
		<div class="restobars-stats">
			
			<?php
	
			
                                if (elgg_is_logged_in()) {
                                    if (!$restobar->isMember()) {
                                        if (check_entity_relationship(elgg_get_logged_in_user_guid(), 'friend', $restobar->getGUID())) {
                                         /*   $url = "action/restobars/friends/remove?friend={$restobar->getGUID()}";
                                            $text = elgg_echo('friend:remove');
                                            $name = 'remove_friend_restobar';*/
                                    } else {
                                            $url = "action/restobars/friends/add?friend={$restobar->getGUID()}";
                                            $text = elgg_echo('friend:add');
                                            $name = 'add_friend_restobar';
                                            $url = elgg_add_action_tokens_to_url($url);
                                            $item = new ElggMenuItem($name, $text, $url);
                                            echo "</br>";
                                            echo($item->getContent(array('class' => 'elgg-button elgg-button-action')));
                                }
                            
              
                            
		} 
                
              }
                          
                        
                                
                         ?>
			</p>
		</div>
	</div>

	<div class="restobars-profile-fields elgg-body">
		<?php
			echo elgg_view('restobars/profile/fields', $vars);
                        
		?>
            
            </div>
</div>
<?php
?>
 