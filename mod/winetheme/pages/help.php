<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$title = "";
$lang=get_current_language();
        
        switch ($lang) {
            case "fr":
                $content = elgg_view("help/help_fr");
                break;
            default:
                $content = elgg_view("help/help_en");
                break;
        }	

$vars = array(
'content' => $content,
);
$body = elgg_view_layout('one_sidebar', $vars);
echo elgg_view_page($title, $body);
