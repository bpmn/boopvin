<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title']       The page title
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php //echo elgg_view('page/elements/head', $vars); ?>
</head>

<?php


$body = elgg_view('page/elements/body', $vars);
echo $body; 




//$js = elgg_get_loaded_js('head');?>

<!--script type="text/javascript">
	<?php// echo elgg_view('js/initialize_elgg'); ?>
</script-->

<?php
//echo elgg_view('page/elements/foot'); 
?>
	
