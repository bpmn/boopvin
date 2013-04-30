<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$users=elgg_get_entities(array('type'=>'user','limit'=>100));
foreach ($users as $user) {
	echo $user->name.'</br>' ;
	//echo set_user_notification_setting($user->getGUID(), 'site', true);
	$metaname = 'collections_notifications_preferences_site' ;
	//$user->$metaname = -1;
        $user->$metaname = 0;
        echo $user->$metaname.' ' ;
        $metaname = 'collections_notifications_preferences_email' ;
	//$user->$metaname = -1;
        $user->$metaname = 0;
        echo $user->$metaname.'</br>' ;
        $metaname = 'collections_notifications_preferences_notifier' ;
	//$user->$metaname = -1;
        $user->$metaname = -1;
        echo $user->$metaname.'</br>' ;
        }
?>