<?php
/**
 * Layout of the restobar profile page
 *
 * @uses $vars['entity']
 */

echo elgg_view('restobars/profile/summary', $vars);

if (group_gatekeeper(false)) {
	echo elgg_view('restobars/profile/widgets', $vars);
} else {
	echo elgg_view('restobars/profile/closed_membership');
}
