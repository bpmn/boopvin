<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$users=elgg_get_entities(array('type'=>'user','limit'=>100));
foreach ($users as $user) {
	echo $user->name.'</br>' ;
	echo set_user_notification_setting($user->getGUID(), 'site', false);
	echo set_user_notification_setting($user->getGUID(), 'email', true);
        echo set_user_notification_setting($user->getGUID(), 'notifier', true);
        }


?>