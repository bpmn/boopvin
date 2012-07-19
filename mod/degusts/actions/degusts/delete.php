<?php
/**
 * Delete blog entity
 *
 * @package Blog
 */

$degust_guid = get_input('guid');
$degust = get_entity($degust_guid);


if (elgg_instanceof($degust, 'object', 'degust') && ($degust->canEdit())) {
	$container = get_entity($degust->container_guid);
	if ($degust->delete()) {
		system_message(elgg_echo('degust:message:deleted'));
		//if (elgg_instanceof($container, 'group')) {
		//	forward("wine/$container->guid");
                //}
                forward(REFERER);
	} else {
		register_error(elgg_echo('degust:error:cannot_delete'));
	}
} else {
	register_error(elgg_echo('degust:error:degust_not_found'));
}

forward(REFERER);