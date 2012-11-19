<?php
/**
 *  Wines 1.8 plugin language pack
 *
 * @package Wine
 */

$french = array(

	/**
	 * Menu items and titles
	 */
	'wine' => "Les Vins",
	'wine:owned' => "Mes vins",
	'wine:yours' => "My wine",
	'wine:user' => "%s's wine",
	'wine:all' => "Tous les vins",
	'wine:add' => "Ajouter un vin",
	'wine:edit' => "Editer vin",
	'wine:delete' => 'Supprimer vin',
	'wine:membershiprequests' => 'Manage join requests',
	'wine:invitations' => 'wine invitations',

	'wine:icon' => 'wine icon (leave blank to leave unchanged)',
	'wine:name' => 'Nom/Château/Domaine',
	'wine:username' => 'wine short name (displayed in URLs, alphanumeric characters only)',
	'wine:appellation' => 'Appellation',
    
        'wine:cuvee'=>'Cuvée',            
	'wine:region' => 'Région',        
	'wine:grapes' => 'Cépages',         
        'wine:maker'=>'Vigneron',            
        'wine:kind'=>'Type',                   //style de vin blanc, rouge, moelleux
        'wine:soil'=>'Composition du sol',     //sol          
        'wine:country'=>'Pays' ,               //pays
        
        'wine:info'=>'Informations complémentaires (élevage, vinification..)' , 
        'wine:vintage'=>'Millésime',
        'wine:nv'=>'Non Millésimé',
        
        'wine:red'=>'Rouge',             
        'wine:white'=>'Blanc',             
        'wine:rose'=>'Rosé' , 
        'wine:white_sparkling'=>'Blanc effervescent',
        'wine:rose_sparkling'=>'Rosé effervescent',
    
	'wine:briefdescription' => 'Description breve',
	'wine:interests' => 'Tags',
	'wine:website' => 'Website',
	'wine:members' => 'ceux qui suivent ce vins',
	'wine:members:title' => 'Members of %s',
	'wine:members:more' => "View all members",
	'wine:membership' => "wine membership permissions",
	'wine:access' => "Access permissions",
	'wine:owner' => "Owner",
	'wine:widget:num_display' => 'Number of wine to display',
	'wine:widget:membership' => 'wine membership',
	'wine:widgets:description' => 'Display the wine you are a member of on your profile',
	'wine:noaccess' => 'No access to wine',
	'wine:permissions:error' => 'You do not have the permissions for this',
	'wine:inwine' => 'in the wine',
	'wine:cantedit' => 'You can not edit this wine',
	'wine:saved' => 'wine saved',
	'wine:featured' => 'Featured wine',
	'wine:makeunfeatured' => 'Unfeature',
	'wine:makefeatured' => 'Make featured',
	'wine:featuredon' => '%s is now a featured wine.',
	'wine:unfeatured' => '%s has been removed from the featured wine.',
	'wine:featured_error' => 'Invalid wine.',
	'wine:joinrequest' => 'Request membership',
	'wine:join' => 'ajouter à mon club dégustation',
        'wine:join:title' => 'Rejoindre le club si vous voulez le déguster et participer',
	'wine:leave' => 'Leave wine',
	'wine:invite' => 'Invite friends',
	'wine:invite:title' => 'Invite friends to this wine',
	'wine:inviteto' => "Invite friends to '%s'",
	'wine:nofriends' => "You have no friends left who have not been invited to this wine.",
	'wine:nofriendsatall' => 'You have no friends to invite!',
	'wine:viawine' => "via wine",
	'wine:wine' => "wine",
	'wine:search:tags' => "tag",
	'wine:search:title' => "Search for wine tagged with '%s'",
	'wine:search:none' => "No matching wine were found",
	'wine:search_in_wine' => "Search in this wine",
	'wine:acl' => "wine: %s",

	'wine:activity' => "wine activity",
	'wine:enableactivity' => 'Enable wine activity',
	'wine:activity:none' => "There is no wine activity yet",

	'wine:notfound' => "wine not found",
	'wine:notfound:details' => "The requested wine either does not exist or you do not have access to it",

	'wine:requests:none' => 'There are no current membership requests.',

	'wine:invitations:none' => 'There are no current invitations.',

	'item:object:wineforumtopic' => "Discussion topics",

	'wineforumtopic:new' => "Ajouter une nouvelle brève de comptoire",

	'wine:count' => "wine created",
	'wine:open' => "open wine",
	'wine:closed' => "closed wine",
	'wine:member' => "Membre du club des dégustateurs",
	'wine:searchtag' => "Search for wine by tag",

	'wine:more' => 'More wine',
	'wine:none' => 'No wine',
        'wine:suggestions'=>'Le vin dans les environs',

	/*
	 * Access
	 */
	'wine:access:private' => 'Closed - Users must be invited',
	'wine:access:public' => 'Open - Any user may join',
	'wine:access:wine' => 'wine members only',
	'wine:closedwine' => 'This wine has a closed membership.',
	'wine:closedwine:request' => 'To ask to be added, click the "request membership" menu link.',
	'wine:visibility' => 'Who can see this wine?',

	/*
	 * wine tools
	 */
	'wine:enableforum' => 'Enable wine discussion',
	'wine:yes' => 'yes',
	'wine:no' => 'no',
	'wine:lastupdated' => 'Last updated %s by %s',
	'wine:lastcomment' => 'Last comment %s by %s',

	/*
	 * wine discussion
	 */
	'discussion' => 'Discussion',
	'discussion:add' => 'Ajouter une brève de comptoir',
	'discussion:latest' => 'Les dernières brèves de comptoir',
	'discussion:wine' => 'Brèves de comptoir',
	'discussion:none' => 'No discussion',
	'discussion:reply:title' => 'Reply by %s',

	'discussion:topic:created' => 'The discussion topic was created.',
	'discussion:topic:updated' => 'The discussion topic was updated.',
	'discussion:topic:deleted' => 'Discussion topic has been deleted.',

	'discussion:topic:notfound' => 'Discussion topic not found',
	'discussion:error:notsaved' => 'Unable to save this topic',
	'discussion:error:missing' => 'Both title and message are required fields',
	'discussion:error:permissions' => 'You do not have permissions to perform this action',
	'discussion:error:notdeleted' => 'Could not delete the discussion topic',

	'discussion:reply:deleted' => 'Discussion reply has been deleted.',
	'discussion:reply:error:notdeleted' => 'Could not delete the discussion reply',

	'reply:this' => 'Reply to this',

	'wine:replies' => 'Replies',
	'wine:forum:created' => 'Created %s with %d comments',
	'wine:forum:created:single' => 'Created %s with %d reply',
	'wine:forum' => 'Discussion',
	'wine:addtopic' => 'Add a topic',
	'wine:forumlatest' => 'Latest discussion',
	'wine:latestdiscussion' => 'Latest discussion',
	'wine:newest' => 'Newest',
	'wine:popular' => 'Popular',
	'winepost:success' => 'Your reply was succesfully posted',
	'wine:alldiscussion' => 'Latest discussion',
	'wine:edittopic' => 'Edit topic',
	'wine:topicmessage' => 'Topic message',
	'wine:topicstatus' => 'Topic status',
	'wine:reply' => 'Post a comment',
	'wine:topic' => 'Topic',
	'wine:posts' => 'Posts',
	'wine:lastperson' => 'Last person',
	'wine:when' => 'When',
	'winetopic:notcreated' => 'No topics have been created.',
	'wine:topicopen' => 'Open',
	'wine:topicclosed' => 'Closed',
	'wine:topicresolved' => 'Resolved',
	'winetopic:created' => 'Your topic was created.',
	'winetopic:deleted' => 'The topic has been deleted.',
	'wine:topicsticky' => 'Sticky',
	'wine:topicisclosed' => 'This discussion is closed.',
	'wine:topiccloseddesc' => 'This discussion is closed and is not accepting new comments.',
	'winetopic:error' => 'Your wine topic could not be created. Please try again or contact a system administrator.',
	'wine:forumpost:edited' => "You have successfully edited the forum post.",
	'wine:forumpost:error' => "There was a problem editing the forum post.",


	'wine:privatewine' => 'This wine is closed. Requesting membership.',
	'wine:notitle' => 'wine must have a title',
	'wine:cantjoin' => 'Can not join wine',
	'wine:cantleave' => 'Could not leave wine',
	'wine:removeuser' => 'Remove from wine',
	'wine:cantremove' => 'Cannot remove user from wine',
	'wine:removed' => 'Successfully removed %s from wine',
	'wine:addedtowine' => 'Successfully added the user to the wine',
	'wine:joinrequestnotmade' => 'Could not request to join wine',
	'wine:joinrequestmade' => 'Requested to join wine',
	'wine:joined' => 'Successfully joined wine!',
	'wine:left' => 'Successfully left wine',
	'wine:notowner' => 'Sorry, you are not the owner of this wine.',
	'wine:notmember' => 'Sorry, you are not a member of this wine.',
	'wine:alreadymember' => 'You are already a member of this wine!',
	'wine:userinvited' => 'User has been invited.',
	'wine:usernotinvited' => 'User could not be invited.',
	'wine:useralreadyinvited' => 'User has already been invited',
	'wine:invite:subject' => "%s you have been invited to join %s!",
	'wine:updated' => "Last reply by %s %s",
	'wine:started' => "Started by %s",
	'wine:joinrequest:remove:check' => 'Are you sure you want to remove this join request?',
	'wine:invite:remove:check' => 'Are you sure you want to remove this invite?',
	'wine:invite:body' => "Hi %s,

%s invited you to join the '%s' wine. Click below to view your invitations:

%s",

	'wine:welcome:subject' => "Welcome to the %s wine!",
	'wine:welcome:body' => "Hi %s!

You are now a member of the '%s' wine! Click below to begin posting!

%s",

	'wine:request:subject' => "%s has requested to join %s",
	'wine:request:body' => "Hi %s,

%s has requested to join the '%s' wine. Click below to view their profile:

%s

or click below to view the wine's join requests:

%s",

	/*
	 * Forum river items
	 */

	'river:create:group:wine' => '%s a ajouté le vin %s à AvenueVin',
	'river:incave:group:wine' => "le vin %s a été ajouté la cave de l'établissement %s",
        'river:join:wine:default' => '%s joined the wine %s',
	'river:create:object:wineforumtopic' => '%s a ajouté une discussion "%s"',
	'river:reply:object:wineforumtopic' => '%s a participé à la discussion %s',
        'river:wineforumtopic'=>'sur le vin %s',
    
	'wine:nowidgets' => 'No widgets have been defined for this wine.',


	'wine:widgets:members:title' => 'wine members',
	'wine:widgets:members:description' => 'List the members of a wine.',
	'wine:widgets:members:label:displaynum' => 'List the members of a wine.',
	'wine:widgets:members:label:pleaseedit' => 'Please configure this widget.',

	'wine:widgets:entities:title' => "Objects in wine",
	'wine:widgets:entities:description' => "List the objects saved in this wine",
	'wine:widgets:entities:label:displaynum' => 'List the objects of a wine.',
	'wine:widgets:entities:label:pleaseedit' => 'Please configure this widget.',

	'wine:forumtopic:edited' => 'Forum topic successfully edited.',

	'wine:allowhiddenwine' => 'Do you want to allow private (invisible) wine?',

	/**
	 * Action messages
	 */
	'wine:deleted' => 'wine and wine contents deleted',
	'wine:notdeleted' => 'wine could not be deleted',

	'wine:notfound' => 'Could not find the wine',
	'winepost:deleted' => 'wine posting successfully deleted',
	'winepost:notdeleted' => 'wine posting could not be deleted',
	'winetopic:deleted' => 'Topic deleted',
	'winetopic:notdeleted' => 'Topic not deleted',
	'winetopic:blank' => 'No topic',
	'winetopic:notfound' => 'Could not find the topic',
	'winepost:nopost' => 'Empty post',
	'wine:deletewarning' => "Are you sure you want to delete this wine? There is no undo!",

	'wine:invitekilled' => 'The invite has been deleted.',
	'wine:joinrequestkilled' => 'The join request has been deleted.',

	// ecml
	'wine:ecml:discussion' => 'wine Discussions',
	'wine:ecml:wineprofile' => 'wine profiles',

        'wine:restobar:nosuggestion'=> 'pas de suggestion'
);

add_translation("fr", $french);

?>
