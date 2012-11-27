<?php
/**
 * Elgg one-column layout
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content string
 * @uses $vars['class']   Additional class to apply to layout
 */
//$class = 'elgg-layout degust-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
    $class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));
?>
<div class="<?php echo $class; ?>">
    <div class="degust-main">


        <div class="error" style="display:none;">
            <img src="images/warning.gif" alt="Warning!" width="24" height="24" style="float:left; margin: -5px 10px 0px 0px; " />

            <span></span>.<br clear="all"/>
        </div>


        <div id="vtab">
            <ul>    
                <li class="home"></li>
                <li class="support"></li>
            </ul>


            <div id="vtab-1">

<?php echo $vars['tab1']; ?>


            </div> <!-- for Tab 1-->
            <div id="vtab-2">
<?php echo $vars['tab2']; ?>
            </div>
        </div> <!-- for Tabs-->



    </div>   
</div>
