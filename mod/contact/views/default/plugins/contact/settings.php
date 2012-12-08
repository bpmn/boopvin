<?php 


$email = $vars['entity']->email;

?>


<p>
 <b>Enter the email that you want to receive feedback</b>
 <?php

echo elgg_view('input/text', array(
    'name'  => 'params[email]',
    'value' => $email,
));


 ?>
 


</p>