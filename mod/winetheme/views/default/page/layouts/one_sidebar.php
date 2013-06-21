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
                //echo('<div class="register_me"><br><br><br>');
                  echo('<div class="register_me">');

		if (elgg_get_config('allow_registration')) {
                    $lang=get_current_language();    
                    
                    if ($lang == "fr")
                        $text =  elgg_view('output/img',array('src'=>"/mod/winetheme/views/default/css/winetheme/images/plaque_fr.jpg"));
                    else 
                        $text =  elgg_view('output/img',array('src'=>"/mod/winetheme/views/default/css/winetheme/images/plaque_en.jpg"));
                    echo '<a class="registration_link" href="' . elgg_get_site_url() . 'register">'.$text .'</a>'; //elgg_echo('register_me') . '</a>';
		}
                echo("</div>");
                }
                
            ?>
            
            
            <?php 
            if (!elgg_is_logged_in()) {
            echo('<div class="fb-like-box fb_iframe_widget" data-header="false" data-stream="false" data-show-faces="true" data-width="205" data-href="http://www.facebook.com/AvenueVin" fb-xfbml-state="rendered">');
            echo("</div>");
            
            } else {
            
            }
            ?>    
                
                
                
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
