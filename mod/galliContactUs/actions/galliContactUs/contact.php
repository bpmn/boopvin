<?php
/**
 * Elgg contact us action
 *
 * @package galliContactUs
 */

$sender_name = get_input('sender_name');
$sender_email = get_input('sender_email');
$email_message = get_input('email_message');

$to_email = elgg_get_plugin_setting('admin_email', 'galliContactUs');
$subject = elgg_echo('galliContactUs:subject');

if ( empty($sender_name) || empty($sender_email) || empty($email_message) ) {
	register_error(elgg_echo('galliContactUs:missingfields'));
	forward(REFERER);
}
 
if (!is_email_address($sender_email)) {
	register_error(elgg_echo('galliContactUs:wrongemail'));
	forward(REFERER);
}

if(elgg_send_email($sender_email, $to_email, $subject, $email_message)){
	system_message(elgg_echo('galliContactUs:success'));
} else {
	register_error(elgg_echo('error:default'));
}

forward(REFERER);