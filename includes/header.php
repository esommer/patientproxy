<?php 
/** HEADER.PHP
 *
 * Loads all necessary global scripts, begins HTML page
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */


/* FOR TESTING */
//session_destroy (); //TESTING

// INCLUDES
require_once('includes/setvars.php');


	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-US">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	echo '<title>Patient Proxy ';
	if ( isset ( $pageTitle ) ) {
		echo $pageTitle;
		}
  	echo '</title>';
?>

<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/jquery.js"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/jquery.url.js"></script>    
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/functions.js"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/custom-form-elements.js"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $RELADDRESS; ?>javascript/additional-methods.min.js"></script>
<script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e90a6b437f6c7d8"></script>
<!-- Doesn't load <script type="text/javascript" src="<//?php echo $RELADDRESS; ?>javascript/livevalidation_standalone.compressed.js"></script> <-->

<!-- added to style.css <link type="text/css" rel="stylesheet" href="<?php echo $RELADDRESS; ?>style/blankstyle.css" /> -->
<link type="text/css" rel="stylesheet" href="<?php echo $RELADDRESS; ?>style/style.css" />
<link type="text/css" href="<?php echo $RELADDRESS; ?>javascript/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="Stylesheet" />	
<link type="text/css" rel="stylesheet" href="<?php echo $RELADDRESS; ?>style/print.css" media="print" />

<script type="text/javascript">
// GENERAL
	$(document).ready(function() {
		// HELP TEXT TOGGLER
		$("span.help").click(function(){
    		$(this).siblings("span.helptext").toggle();
    	});
    	// VALIDATOR
		$('#questionform').validate({
			rules: {
				patientInfo_patientData_birthDate_fieldID: {
					date: true
					},
				healthProxy_personData_zip_fieldID: {
					digits: true
					},
				healthProxy_personData_phone_fieldID: {
					phoneUS: true
					},
				healthProxy_personData_cellPhone_fieldID: {
					phoneUS: true
					},
				healthProxy_personData_email_fieldID: {
					email: true
					},
				alternateHP_personData_zip_fieldID: {
					digits: true
					},
				alternateHP_personData_phone_fieldID: {
					phoneUS: true
					},
				alternateHP_personData_cellPhone_fieldID: {
					phoneUS: true
					},
				alternateHP_personData_email_fieldID: {
					email: true
					},
				healthProxy_alternatePersonData_zip_fieldID: {
					digits: true
					},
				healthProxy_alternatePersonData_phone_fieldID: {
					phoneUS: true
					},
				healthProxy_alternatePersonData_cellPhone_fieldID: {
					phoneUS: true
					},
				healthProxy_alternatePersonData_email_fieldID: {
					email: true
					}
				}
			}
		);
		$('#scholarship-form').validate({
			rules: {
				birthdate: {
					date: true
					},
				phone: {
					phoneUS: true
					},
				emailaddress: {
					email: true
					}
				}
			}
		);
		// BACK NAV FUNCTION
    	$('button.backbutton').click(function() {
    		var backaddress = "<?php echo $back_form_action; ?>";
			$('#questionform').attr('action', backaddress);
			$('#questionform').append("<input type='hidden' name='direction' value='backward' />");
			$('#questionform').submit();
		});
		// NESTING SUB QUESTION ELEMENTS
		/*if ($('fieldset fieldset ul li span input').attr('checked') = 'checked') {
			$(this).parents('fieldset').parent('li').children('span').children('input').attr('checked', 'checked');
		};
		$('fieldset fieldset ul li span.checkbox_label').click(function() {
			$(this).parents('fieldset').parent('li').children('span').children('input').attr('checked', 'checked');
		});*/
    });
// GOOGLE ANALYTICS
  	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-27941774-1']);
  	_gaq.push(['_trackPageview']);
  	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
</head>

<body>
<div id="headercolor"></div>
<div id="wrapper">
	
	<div id="header">
	
		<div id="logo">
			<a href="<?php echo $RELADDRESS; ?>"><img src="<?php echo $RELADDRESS; ?>images/logo.png" title="Patient Proxy Logo" alt="Patient Proxy Logo" /></a>
			<h1 class="accessible">Patient Proxy</h1>
			<h3 class="accessible">Designate your health proxy.</h3>
		</div> <!-- close div #logo -->
		
		<div id="littlelinks">
			<ul id="topnav">
				<li class="first">
					<a href="<?php echo $RELADDRESS; ?>info/howitworks/" title="Learn more about how to make your health proxy and why it is so important.">How it works</a>
				</li>
				<li>|</li>
				<li>
					<a href="<?php echo $RELADDRESS; ?>info/privacy/" title="View our strict privacy policy.">Privacy</a>
				</li>				
				<li>|</li>
				<li>
					<a href="<?php echo $RELADDRESS; ?>info/feedback/" title="Let us know what you think!">Feedback</a>
				</li>				
				<li>|</li>
				<li class="last">
					<a href="<?php echo $RELADDRESS; ?>vouchers/" title="Pre-paid Vouchers">For Professionals - <span class="red">New!</span></a>
				</li>
			</ul>
		</div> <!-- close div #littlelinks -->
	</div> <!-- close div #header -->
	<div id="mainbody">
	<hr class="thin" />	
