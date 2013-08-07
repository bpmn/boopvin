<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$ia=elgg_set_ignore_access(true);
$vince=get_user_by_username('vincentdrubay');

$guid=$vince->getGUID();
$opts = array('types' => 'object',
        'subtypes' => 'degust',
        'owner_guids' => $guid,
        'limit'=>900,
        'joins' => array("INNER JOIN {$CONFIG->dbprefix}objects_entity o ON (e.guid = o.guid)"),

        'order_by' => 'o.title',
        'count' => true);

$degusts = elgg_get_entities($opts);
echo $degusts."</br>";
$opts['count']=false;
$degusts = elgg_get_entities($opts);
foreach($degusts as $degust)
    echo $degust->title.'</br>';

 elgg_set_ignore_access($ia);       
        
?>
