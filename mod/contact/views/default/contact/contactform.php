<?php elgg_get_plugin_setting('email', 'contact'); 
?>

<?PHP
/*
    Contact Form from HTML Form Guide
    This program is free software published under the
    terms of the GNU Lesser General Public License.
    See this page for more info:
    http://www.html-form-guide.com/contact-form/creating-a-contact-form.html
*/

elgg_load_js('elgg.gen_validatorv31');
elgg_load_js('elgg.validate_contact');

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/include/fgcontactform.php");
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/include/simple-captcha.php");
/*require_once("./include/fgcontactform.php");
require_once("./include/simple-captcha.php");*/
$email=elgg_get_plugin_setting('email','contact');
$formproc = new FGContactForm();
$sim_captcha = new FGSimpleCaptcha('scaptcha');

$formproc->EnableCaptcha($sim_captcha);

//1. Add your email address here.
//You can add more than one receipients.
 $formproc->AddRecipient($email); //<<---Put your email address here

//2. For better security. Get a random tring from this link: http://tinyurl.com/randstr
// and put it here
$formproc->SetFormRandomKey('usNUP4XPnMsNpnw');


if(isset($_POST['submitted']))
{
   if($formproc->ProcessForm())
   {
        //$formproc->RedirectToURL("thank-you.php");
       
       forward('activity');
       system_message(elgg_echo("contact:thanks"));
   }
}


?>
<!html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Contact us</title>
      <!--link rel="STYLESHEET" type="text/css" href="contact.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script-->
</head>

<!--link rel="STYLESHEET" type="text/css" href="contact.css" />
<script type='text/javascript' src='scripts/gen_validatorv31.js'></script-->
<body>
   
<!-- Form Code Start -->

&nbsp;
<!--form id='contactus' action='<?php //echo $formproc->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'-->
<form id='contactus' action='<?php echo elgg_normalize_url('contact'); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend><?php echo elgg_echo('contact') ?></legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
<input type='text'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' />

<div class='short_explanation'>* <?php echo elgg_echo('contact:required') ?></div>

<div><span class='error'><?php echo $formproc->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='name' ><?php echo elgg_echo('contact:name') ?> </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $formproc->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='contactus_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' ><?php echo elgg_echo('contact:email') ?> </label><br/>
    <input type='text' name='email' id='email' value='<?php echo $formproc->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='contactus_email_errorloc' class='error'></span>
</div>
<!--div class='container'>
    <label for='phone' >Phone Number:</label><br/>
    <input type='text' name='phone' id='phone' value='<?//php echo $formproc->SafeDisplay('phone') ?>' maxlength="15" /><br/>
    <span id='contactus_phone_errorloc' class='error'></span>
</div-->
<div class='container'>
    <label for='message' ><?php echo elgg_echo('contact:message') ?> </label><br/>
    <span id='contactus_message_errorloc' class='error'></span>
    <textarea rows="10" cols="50" name='message' id='message'><?php echo $formproc->SafeDisplay('message') ?></textarea>
</div>
<fieldset id='antispam'>
<legend ><?php echo elgg_echo('contact:question') ?></legend><br>
<span class='short_explanation'><?php echo elgg_echo('contact:antispam') ?></span>
<div class='container'>
    <label for='scaptcha' ><?php echo $sim_captcha->GetSimpleCaptcha(); ?></label>
    <input type='text' name='scaptcha' id='scaptcha' maxlength="10" /><br/>
    <span id='contactus_scaptcha_errorloc' class='error'></span>
</div>
</fieldset>

<div class='container'>
    <?php echo elgg_view('input/submit',array('value'=>elgg_echo('send'))); ?>
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<!--script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("contactus");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    var text=elgg.echo('contact:validate:name');
   
    frmvalidator.addValidation("name","req",text);

    frmvalidator.addValidation("email","req",elgg.echo('contact:validate:email'));

    frmvalidator.addValidation("email","email",elgg.echo('contact:validate:bad_email'));

    frmvalidator.addValidation("message","maxlen=2048",elgg.echo('contact:validate:email'));


    frmvalidator.addValidation("scaptcha","req",elgg.echo('contact:validate:antispam'));





// ]]>
</script-->
</body>


