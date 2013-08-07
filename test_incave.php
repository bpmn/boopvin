<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$ia=elgg_set_ignore_access(true);
$vince=get_user_by_username('vincentdrubay');
$opts = array('types' => 'group',
        'subtypes' => 'restobar',
        'owner_guids'=>$vince->getGUID(),
        'limit'=>0
    );
$resto=elgg_get_entities($opts);
$wine_shop=$resto[0];

$opts = array('types' => 'group',
        'subtypes' => 'wine',
        'relationship' => 'incave',
        'relationship_guid' => $wine_shop->getGUID(),
        'limit'=>0,
        'joins' => array("INNER JOIN {$CONFIG->dbprefix}groups_entity o ON (e.guid = o.guid)"),

        'order_by' => 'o.name',
    );

$opts['count']=true;
$wines=elgg_get_entities_from_relationship($opts);
echo $wines.'</br>';

$opts['count']=false;
$wines=elgg_get_entities_from_relationship($opts);
foreach($wines as $wine)
    echo $wine->name.'</br>';
?>
