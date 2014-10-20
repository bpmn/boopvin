<?php

/**
 * Elgg contact us form contents
 *
 * @package galliContactUs
 */

if (elgg_is_logged_in()) {
	$user = elgg_get_logged_in_user_entity();
	$sender_name = $user->name;
	$sender_email = $user->email;
}	
?>
<!--div>
	<p>
		<?php //echo elgg_echo('galliContactUs:intro');?>
	</p>
</div-->

<div>
	<label>
		<?php echo elgg_echo('name');?>
		<?php echo elgg_view('input/text', array('name' => 'sender_name', 'value' => $sender_name));?>
	</label>
</div>

<div>
	<label>
		<?php echo elgg_echo('email');?>
		<?php echo elgg_view('input/text', array('name' => 'sender_email', 'value' => $sender_email));?>
	</label>
</div>

<div>
	<label>
		<?php echo elgg_echo('galliContactUs:emailmessage');?>
		<?php echo elgg_view('input/longtext', array('name' => 'email_message', 'value' => ''));?>
	</label>
</div>

<?php
if(!elgg_is_logged_in()){
	echo elgg_view('input/captcha');
}
echo elgg_view('input/submit', array('value' => elgg_echo('send'))); 
?>