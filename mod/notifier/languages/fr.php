<?php

$lang = array(
	'notifier:' => '',
	'notifier:notification' => 'Notification',
	'notifier:notifications' => 'Notifications',
	'notifier:view:all' => 'Toutes mes notifications',
	'notifier:all' => 'Toutes les notifications',
	'notifier:none' => 'Aucune notification',
	'notifier:unreadcount' => 'Notifications non lues (%s)',
	'notification:method:notifier' => 'Notifier',
	'notifier:dismiss_all' => 'Marquer comme lues',
	'notifier:clear_all' => 'Tout effacer',
	'notifier:deleteconfirm' => 'Toutes les notifications même les non lues vont être effacées. voulez vous continuer?',

	'item:object:notification' => 'Objet Notifier',

	// System messages
	'notifier:message:dismissed_all' => 'Marquées comme lues',
	'notifier:message:deleted_all' => 'Toutes les notifications ont été supprimées avec succès',
	'notifier:message:deleted' => 'La notification a été supprimée avec succès',

	// Error messages
	'notifier:error:not_found' => 'Notification non trouvée',
	'notifier:error:target_not_found' => "Le contenu n'est pas accessible, il a été probablement effacé.",
	'notifier:error:cannot_delete' => 'Echec de suppression de la notification',

        'notifier:email:subject'=>'Vous avez %s nouvelles notifications sur Avenuevin'
	// River strings that are not available in Elgg core
	//'river:comment:object:groupforumtopic' => '%s replied on the discussion topic %s',
);

add_translation('fr', $lang);