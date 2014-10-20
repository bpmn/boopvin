<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



echo "<div>";
echo "<label for=\"filter_kind\">".elgg_echo("wine:kind")."</label></br>";
echo elgg_view('input/dropdown',array(
                            'class'=>'wine_filter',
                            'name' => 'kind',
                            'id'=>'filter_kind',
                            'options_values' => array(
                                'all' =>elgg_echo('all'),
                                'red' => elgg_echo('wine:profile:red'),
				'white' => elgg_echo('wine:profile:white'),
                                'rose' => elgg_echo('wine:profile:rose'),
                                'white_sparkling' => elgg_echo('wine:profile:white_sparkling'),
                                'rose_sparkling' => elgg_echo('wine:profile:rose_sparkling'),
                                'moelleux' => elgg_echo('wine:profile:moelleux'),
                                'vdn_blanc' => elgg_echo('wine:profile:vdn_blanc'),
                                'vdn_rouge' => elgg_echo('wine:profile:vdn_rouge'),
                                'brandy' => elgg_echo('wine:profile:brandy'))));

echo "</div>";


echo "<div>";
echo "<label for=\"filter_country\">".elgg_echo("wine:country")."</label></br>";
echo elgg_view('input/dropdown',array(
                            'class'=>'wine_filter',
                            'name' => 'country',
                            'id'=>'filter_country',
                            'options_values' => array(

'all' => elgg_echo('all'),                               
'France' => elgg_echo('France'),
'Italy' => elgg_echo('Italy'),
'Spain' => elgg_echo('Spain'),
'Germany' => elgg_echo('Germany'),
'Portugal' => elgg_echo('Portugal'),                                
'Australia' => elgg_echo('Australia'),
'South Africa' => elgg_echo('South Africa'),                             
'United States' => elgg_echo('United States'),
'New Zealand' => elgg_echo('New Zealand'),
'Argentina' => elgg_echo('Argentina'),
'Chile' => elgg_echo('Chile'),
'Austria' => elgg_echo('Austria'),
'Hungary' => elgg_echo('Hungary'),                                
'Switzerland' => elgg_echo('Switzerland'),
'Algeria' => elgg_echo('Algeria'),
'Uruguay' => elgg_echo('Uruguay'),
'Belgium' => elgg_echo('Belgium'),
'Bosnia and Herzegovina' => elgg_echo('Bosnia and Herzegovina'),
'Brazil' => elgg_echo('Brazil'),
'Bulgaria' => elgg_echo('Bulgaria'),
'Canada' => elgg_echo('Canada'),
'China' => elgg_echo('China'),
'Colombia' => elgg_echo('Colombia'),
'Croatia' => elgg_echo('Croatia'),
'Cyprus' => elgg_echo('Cyprus'),
'Czech Republic' => elgg_echo('Czech Republic'),
'Egypt' => elgg_echo('Egypt'),
'Georgia' => elgg_echo('Georgia'),
'Greece' => elgg_echo('Greece'),
'India' => elgg_echo('India'),
'Israel' => elgg_echo('Israel'),
'Japan' => elgg_echo('Japan'),
'Kazakhstan' => elgg_echo('Kazakhstan'),
'Liban' => elgg_echo('Liban'),
'Luxembourg' => elgg_echo('Luxembourg'),
'Macedonia' => elgg_echo('Macedonia'),
'Mexico' => elgg_echo('Mexico'),
'Moldova' => elgg_echo('Moldova'),
'Montenegro' => elgg_echo('Montenegro'),
'Morocco' => elgg_echo('Morocco'),
'Namibia' => elgg_echo('Namibia'),
'Peru' => elgg_echo('Peru'),
'Romania' => elgg_echo('Romania'),
'Russia' => elgg_echo('Russia'),
'Slovakia' => elgg_echo('Slovakia'),
'Slovenia' => elgg_echo('Slovenia'),
'Tunisia' => elgg_echo('Tunisia'),
'Turkey' => elgg_echo('Turkey'),
'Ukraine' => elgg_echo('Ukraine'),
'United Kingdom' => elgg_echo('United Kingdom'),
    

                                
                            ))); 
echo "</div>";

echo '<div id="box_region">';
echo "<label for=\"filter_region\">".elgg_echo("wine:region")."</label></br>";
echo elgg_view('input/dropdown',array(
                            'class'=>'wine_filter',
                            'id'=>'select_region',
                            'name' => 'region',
                            'disabled' => 'disabled',
  ));
echo "</div>";

echo '<div id="box_appellation">';
echo "<label for=\"filter_appellation\">".elgg_echo("wine:appellation")."</label></br>";
echo elgg_view('input/dropdown',array(
                            'class'=>'wine_filter',
                            'id'=>'select_appellation',
                            'name' => 'appellation',
                            'disabled' => 'disabled',
  ));
echo "</div>";

