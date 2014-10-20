<?php
/**
 * galliContactUs plugin settings
 */


echo '<div>';
echo elgg_echo('galliContactUs:adminemail');
echo '<br>';
echo elgg_view('input/text', array(
	'name' => 'params[admin_email]',
	'value' => $vars['entity']->admin_email,
));
echo '</div>';
