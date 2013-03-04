<?php
/**
 * Elgg restobar plugin language pack
 *
 * @package restobars 1.8
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'restobar' => "Bars, Restaurants, Cellars...",
	'restobar:owned' => "restobar I own",
	'restobar:yours' => "My restobar",
	'restobar:user' => "%s's restobar",
	'restobar:all' => "All restobar",
	'restobar:add' => "Add a new restobar",
	'restobar:edit' => "Edit restobar",
	'restobar:delete' => 'Delete restobar',
	'restobar:membershiprequests' => 'Manage join requests',
	'restobar:invitations' => 'restobar invitations',

	'restobar:icon' => 'restobar icon (leave blank to leave unchanged)',
	'restobar:name' => 'Name/Chateau/Domain',
	'restobar:username' => 'restobar short name (displayed in URLs, alphanumeric characters only)',
	'restobar:description' => 'Appellation',
        'restobar:cuvee'=>'Cuvée',            //cuvée 
	'restobar:region' => 'Region',         //région
	'restobar:grapes' => 'Varietals',         //cépage
        'restobar:maker'=>'restobarmaker',            //vigneron
        'restobar:kind'=>'Type',             //style de vin blanc, rouge, moelleux
        'restobar:soil'=>'Soil',             //sol
        'restobar:country'=>'Country' ,         //pays
        
        'restobar:vintage'=>'',
        'restobar:v'=>'Vintage (Vintage selection is done in the wine profile once created)',
        'restobar:nv'=>'No vintage',
    
        'restobar:red'=>'Red',             //style de vin blanc, rouge, moelleux
        'restobar:white'=>'White',             //sol
        'restobar:rose'=>'Rosé' ,         //pays
    
        'restobar:briefdescription' => 'Brief description',
	'restobar:interests' => 'Tags',
	'restobar:website' => 'Website',
	'restobar:members' => 'restobar members',
	'restobar:members:title' => 'Members of %s',
	'restobar:members:more' => "View all members",
	'restobar:membership' => "restobar membership permissions",
	'restobar:access' => "Access permissions",
	'restobar:owner' => "Owner",
	'restobar:widget:num_display' => 'Number of restobar to display',
	'restobar:widget:membership' => 'restobar membership',
	'restobar:widgets:description' => 'Display the restobar you are a member of on your profile',
	'restobar:noaccess' => 'No access to restobar',
	'restobar:permissions:error' => 'You do not have the permissions for this',
	'restobar:inrestobar' => 'in the restobar',
	'restobar:cantedit' => 'You can not edit this restobar',
	'restobar:saved' => 'restobar saved',
	'restobar:featured' => 'Featured restobar',
	'restobar:makeunfeatured' => 'Unfeature',
	'restobar:makefeatured' => 'Make featured',
	'restobar:featuredon' => '%s is now a featured restobar.',
	'restobar:unfeatured' => '%s has been removed from the featured restobar.',
	'restobar:featured_error' => 'Invalid restobar.',
	'restobar:joinrequest' => 'Request membership',
	'restobar:join' => 'Join restobar',
	'restobar:leave' => 'Leave restobar',
	'restobar:invite' => 'Invite friends',
	'restobar:invite:title' => 'Invite friends to this restobar',
	'restobar:inviteto' => "Invite friends to '%s'",
	'restobar:nofriends' => "You have no friends left who have not been invited to this restobar.",
	'restobar:nofriendsatall' => 'You have no friends to invite!',
	'restobar:viarestobar' => "via restobar",
	'restobar:restobar' => "restobar",
        'restobar:search'=>'search for a business',
	'restobar:search:tags' => "tag",
	'restobar:search:title' => "Search for restobar tagged with '%s'",
	'restobar:search:none' => "No matching restobar were found",
	'restobar:search_in_restobar' => "Search in this restobar",
	'restobar:acl' => "restobar: %s",

	'restobar:activity' => "restobar activity",
	'restobar:enableactivity' => 'Enable restobar activity',
	'restobar:activity:none' => "There is no restobar activity yet",

	'restobar:notfound' => "restobar not found",
	'restobar:notfound:details' => "The requested restobar either does not exist or you do not have access to it",

	'restobar:requests:none' => 'There are no current membership requests.',

	'restobar:invitations:none' => 'There are no current invitations.',

	'item:object:restobarforumtopic' => "Discussion topics",

	'restobarforumtopic:new' => "Add discussion post",

	'restobar:count' => "restobar created",
	'restobar:open' => "open restobar",
	'restobar:closed' => "closed restobar",
	'restobar:member' => "members",
	'restobar:searchtag' => "Search for restobar by tag",

	'restobar:more' => 'More restobar',
	'restobar:none' => 'No restobar',


	/*
	 * Access
	 */
	'restobar:access:private' => 'Closed - Users must be invited',
	'restobar:access:public' => 'Open - Any user may join',
	'restobar:access:restobar' => 'restobar members only',
	'restobar:closedrestobar' => 'This restobar has a closed membership.',
	'restobar:closedrestobar:request' => 'To ask to be added, click the "request membership" menu link.',
	'restobar:visibility' => 'Who can see this restobar?',

	/*
	restobar tools
	*/
	'restobar:enableforum' => 'Enable restobar discussion',
	'restobar:yes' => 'yes',
	'restobar:no' => 'no',
	'restobar:lastupdated' => 'Last updated %s by %s',
	'restobar:lastcomment' => 'Last comment %s by %s',

	/*
	restobar discussion
	*/
	'news' => 'Discussion',
	'news:add' => 'Add discussion topic',
	'news:latest' => 'Latest discussion',
	'news:restobar' => 'Bar Chats',
	'news:none' => 'No discussion',
	'news:reply:title' => 'Reply by %s',

	'news:topic:created' => 'The discussion topic was created.',
	'news:topic:updated' => 'The discussion topic was updated.',
	'news:topic:deleted' => 'Discussion topic has been deleted.',

	'news:topic:notfound' => 'Discussion topic not found',
	'news:error:notsaved' => 'Unable to save this topic',
	'news:error:missing' => 'Both title and message are required fields',
	'news:error:permissions' => 'You do not have permissions to perform this action',
	'news:error:notdeleted' => 'Could not delete the discussion topic',

	'news:reply:deleted' => 'Discussion reply has been deleted.',
	'news:reply:error:notdeleted' => 'Could not delete the discussion reply',

	'reply:this' => 'Reply to this',

	'restobar:replies' => 'Replies',
	'restobar:forum:created' => 'Created %s with %d comments',
	'restobar:forum:created:single' => 'Created %s with %d reply',
	'restobar:forum' => 'Discussion',
	'restobar:addtopic' => 'Add a topic',
	'restobar:forumlatest' => 'Latest discussion',
	'restobar:latestdiscussion' => 'Latest discussion',
	'restobar:newest' => 'Newest',
	'restobar:popular' => 'Popular',
	'restobarpost:success' => 'Your reply was succesfully posted',
	'restobar:alldiscussion' => 'Latest discussion',
	'restobar:edittopic' => 'Edit topic',
	'restobar:topicmessage' => 'Topic message',
	'restobar:topicstatus' => 'Topic status',
	'restobar:reply' => 'Post a comment',
	'restobar:topic' => 'Topic',
	'restobar:posts' => 'Posts',
	'restobar:lastperson' => 'Last person',
	'restobar:when' => 'When',
	'restobartopic:notcreated' => 'No topics have been created.',
	'restobar:topicopen' => 'Open',
	'restobar:topicclosed' => 'Closed',
	'restobar:topicresolved' => 'Resolved',
	'restobartopic:created' => 'Your topic was created.',
	'restobartopic:deleted' => 'The topic has been deleted.',
	'restobar:topicsticky' => 'Sticky',
	'restobar:topicisclosed' => 'This discussion is closed.',
	'restobar:topiccloseddesc' => 'This discussion is closed and is not accepting new comments.',
	'restobartopic:error' => 'Your restobar topic could not be created. Please try again or contact a system administrator.',
	'restobar:forumpost:edited' => "You have successfully edited the forum post.",
	'restobar:forumpost:error' => "There was a problem editing the forum post.",


	'restobar:privaterestobar' => 'This restobar is closed. Requesting membership.',
	'restobar:notitle' => 'restobar must have a title',
	'restobar:cantjoin' => 'Can not join restobar',
	'restobar:cantleave' => 'Could not leave restobar',
	'restobar:removeuser' => 'Remove from restobar',
	'restobar:cantremove' => 'Cannot remove user from restobar',
	'restobar:removed' => 'Successfully removed %s from restobar',
	'restobar:addedtorestobar' => 'Successfully added the user to the restobar',
	'restobar:joinrequestnotmade' => 'Could not request to join restobar',
	'restobar:joinrequestmade' => 'Requested to join restobar',
	'restobar:joined' => 'Successfully joined restobar!',
	'restobar:left' => 'Successfully left restobar',
	'restobar:notowner' => 'Sorry, you are not the owner of this restobar.',
	'restobar:notmember' => 'Sorry, you are not a member of this restobar.',
	'restobar:alreadymember' => 'You are already a member of this restobar!',
	'restobar:userinvited' => 'User has been invited.',
	'restobar:usernotinvited' => 'User could not be invited.',
	'restobar:useralreadyinvited' => 'User has already been invited',
	'restobar:invite:subject' => "%s you have been invited to join %s!",
	'restobar:updated' => "Last reply by %s %s",
	'restobar:started' => "Started by %s",
	'restobar:joinrequest:remove:check' => 'Are you sure you want to remove this join request?',
	'restobar:invite:remove:check' => 'Are you sure you want to remove this invite?',
	'restobar:invite:body' => "Hi %s,

%s invited you to join the '%s' restobar. Click below to view your invitations:

%s",

	'restobar:welcome:subject' => "Welcome to the %s restobar!",
	'restobar:welcome:body' => "Hi %s!

You are now a member of the '%s' restobar! Click below to begin posting!

%s",

	'restobar:request:subject' => "%s has requested to join %s",
	'restobar:request:body' => "Hi %s,

%s has requested to join the '%s' restobar. Click below to view their profile:

%s

or click below to view the restobar's join requests:

%s",

	/*
		Forum river items
	*/

	'river:create:restobar:default' => '%s created the restobar %s',
	'river:join:restobar:default' => '%s joined the restobar %s',
	'river:create:object:restobarforumtopic' => '%s added a new discussion topic %s',
	'river:reply:object:restobarforumtopic' => '%s replied on the discussion topic %s',
	
	'restobar:nowidgets' => 'No widgets have been defined for this restobar.',


	'restobar:widgets:members:title' => 'restobar members',
	'restobar:widgets:members:description' => 'List the members of a restobar.',
	'restobar:widgets:members:label:displaynum' => 'List the members of a restobar.',
	'restobar:widgets:members:label:pleaseedit' => 'Please configure this widget.',

	'restobar:widgets:entities:title' => "Objects in restobar",
	'restobar:widgets:entities:description' => "List the objects saved in this restobar",
	'restobar:widgets:entities:label:displaynum' => 'List the objects of a restobar.',
	'restobar:widgets:entities:label:pleaseedit' => 'Please configure this widget.',

	'restobar:forumtopic:edited' => 'Forum topic successfully edited.',

	'restobar:allowhiddenrestobar' => 'Do you want to allow private (invisible) restobar?',

	/**
	 * Action messages
	 */
	'restobar:deleted' => 'restobar and restobar contents deleted',
	'restobar:notdeleted' => 'restobar could not be deleted',

	'restobar:notfound' => 'Could not find the restobar',
	'restobarpost:deleted' => 'restobar posting successfully deleted',
	'restobarpost:notdeleted' => 'restobar posting could not be deleted',
	'restobartopic:deleted' => 'Topic deleted',
	'restobartopic:notdeleted' => 'Topic not deleted',
	'restobartopic:blank' => 'No topic',
	'restobartopic:notfound' => 'Could not find the topic',
	'restobarpost:nopost' => 'Empty post',
	'restobar:deletewarning' => "Are you sure you want to delete this restobar? There is no undo!",

	'restobar:invitekilled' => 'The invite has been deleted.',
	'restobar:joinrequestkilled' => 'The join request has been deleted.',

	// ecml
	'restobar:ecml:discussion' => 'restobar Discussions',
	'restobar:ecml:restobarprofile' => 'restobar profiles',
    
        //gestion de cave
        'restobar:cave'=>'%s\'s cellar',
    
        //module profile
        'restobar:cave:news'=>'News wines in our cellar',
        'link:cave:all'=>'All the cellar',
    
        'removecave:this' => 'Remove the wine from the cellar',
        'removecaveconfirm'=> 'Do you want to remove this wine from the cellar ?',
        'cave:removed' => ' The wine has been removed from the cellar',
        'cave:cantremove'=> 'This wine cannot be removed from the cellar',
    
        'restobar:addmember'=>'Add %s to my business',
        'restobar:addmember:inallbusiness'=>'This user is already a member of all your businesses',
        'restobar:addmember:nobusiness'=>"you haven't create any page business",
    
        //restobar Map
        'restobar:street'=>'Street',
        'restobar:city'=>'City',
        'restobar:cap'=>'CAP',
        'restobar:prov'=>'Province',
        'restobar:region'=>'Region',
        'restobar:nation'=>'Country',
        'restobar:latitude'=>'Latitude',
        'restobar:longitude'=>'Longitude',
        'restobar:clickmap'=>"Click to see the map"
);

add_translation("en", $english);