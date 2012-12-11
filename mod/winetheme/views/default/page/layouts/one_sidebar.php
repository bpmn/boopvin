<?php
/**
 * Layout for main column with one sidebar
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['content'] Content HTML for the main column
 * @uses $vars['sidebar'] Optional content that is displayed in the sidebar
 * @uses $vars['title']   Optional title for main content area
 * @uses $vars['class']   Additional class to apply to layout
 * @uses $vars['nav']     HTML of the page nav (override) (default: breadcrumbs)
 */

$class = 'elgg-layout elgg-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

// navigation defaults to breadcrumbs
$nav = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

?>

<div class="<?php echo $class; ?>">
	<div class="elgg-sidebar">
            
            <?php
                if (!elgg_is_logged_in()) {
                echo('<div class="register_me"><br><br><br>');


		if (elgg_get_config('allow_registration')) {
			echo '<a class="registration_link" href="' . elgg_get_site_url() . 'register">' . elgg_echo('register_me') . '</a>';
		}
                echo("</div>");
                }
                
            ?>
            
            <div class="fb-like" data-href="http://www.avenuevin.com" data-send="true" data-layout="button_count" data-width="150" data-show-faces="true" data-font="tahoma"></div>

            <?php
			echo elgg_view('page/elements/sidebar', $vars);
		?>
	</div>

	<div class="elgg-main elgg-body">
		<?php
			echo $nav;
			
			if (isset($vars['title'])) {
				echo elgg_view_title($vars['title']);
			}
			// @todo deprecated so remove in Elgg 2.0
			if (isset($vars['area1'])) {
				echo $vars['area1'];
			}
			if (isset($vars['content'])) {
				echo $vars['content'];
			}
		?>
	</div>
</div>
