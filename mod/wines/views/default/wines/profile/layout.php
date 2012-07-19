<?php
/**
 * Layout of the wine profile page
 *
 * @uses $vars['entity']
 */

echo elgg_view('wines/profile/summary', $vars);

if (group_gatekeeper(false)) {
	echo elgg_view('wines/profile/widgets', $vars);
} else {
	echo elgg_view('wines/profile/closed_membership');
}
