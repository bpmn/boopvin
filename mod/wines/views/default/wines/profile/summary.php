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
$owner_pics_guid=  elgg_get_logged_in_user_guid();

// List files

$pics = elgg_get_entities(array(
    'types' => 'object',
    'subtypes' => 'file',
    'owner_guid' => $owner_pics_guid,
    'container_guid' => $wine->getGUID(),
    'limit' => 1000,
        ));
if ($pics) {
    
    // Photo du loggin user prioritaire
         $pic=array_rand($pics,1);
         $pic=$pics[$pic];
         $image= elgg_view_entity_icon($pic,'medium');
         //change_wine_icone($wine,$pic); //mise à jour de l'icone du vin
}else{
    // Photo des autres utilisateurs sinon
        $pics = elgg_get_entities(array(
        'types' => 'object',
        'subtypes' => 'file',
        'container_guid' => $wine->getGUID(),
        'limit' => 1000,
            ));
        if ($pics){
               $pic=array_rand($pics,1);
               $pic=$pics[$pic];
               $image= elgg_view_entity_icon($pic,'medium');
               //change_wine_icone($wine,$pic); //mise à jour de l'icone du vin
        }else{
               $image=elgg_view_entity_icon($wine, 'large', array('href' => ''));
        }
        
   
}


?>
<div class="wines-profile clearfix elgg-image-block">
	<div class="elgg-image">
		<div class="wines-profile-icon">
			<?php //echo elgg_view_entity_icon($wine, 'large', array('href' => '')); 
                              echo $image; ?>
		</div>
		<!--div class="wines-stats">
			<p>
				<b><?php //echo elgg_echo("wine:owner"); ?>: </b>
				<?php
					/*echo elgg_view('output/url', array(
						'text' => $owner->name,
						'value' => $owner->getURL(),
						'is_trusted' => true,
					));*/
				?>
			</p>
			<p>
			<?php
				//echo elgg_echo('wine:members') . ": " . $wine->getMembers(0, 0, TRUE);
			?>
			</p>
		</div-->
	</div>

	<div class="wines-profile-fields elgg-body">
		<?php
			echo elgg_view('wines/profile/fields', $vars);
                        //echo elgg_view('wines/profile/vintage',$vars);
                        
		?>
            
            </div>
   <?php// echo elgg_view('wines/profile/vintage',$vars);?>
</div>
<?php

function change_wine_icone($wine,$pic){
    
   	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "wines/" . $wine->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $wine->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
        $contents = $pic->grabFile();
	$filehandler->write($contents);
	$filehandler->close();

	$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['tiny']['w'], $icon_sizes['tiny']['h'], $icon_sizes['tiny']['square']);
	$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['small']['w'], $icon_sizes['small']['h'], $icon_sizes['small']['square']);
	$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['medium']['w'], $icon_sizes['medium']['h'], $icon_sizes['medium']['square']);
	
	if ($thumbtiny) {

		$thumb = new ElggFile();
		$thumb->owner_guid = $wine->owner_guid;
		$thumb->setMimeType('image/jpeg');

		$thumb->setFilename($prefix."tiny.jpg");
		$thumb->open("write");
		$thumb->write($thumbtiny);
		$thumb->close();

		$thumb->setFilename($prefix."small.jpg");
		$thumb->open("write");
		$thumb->write($thumbsmall);
		$thumb->close();

		$thumb->setFilename($prefix."medium.jpg");
		$thumb->open("write");
		$thumb->write($thumbmedium);
		$thumb->close();

	
		$wine->icontime = time();
        }
    
}

?>
 