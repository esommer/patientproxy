<?php
/** DONE.PHP
 *
 * Outputs PDF once payment is made.
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */

/*$RequestSignature = md5($_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].print_r($_POST, true));

if ($_SESSION['LastRequest'] == $RequestSignature)
{
	$refreshed = true;
	}
else
{
	$refreshed = false;
	$_SESSION['LastRequest'] = $RequestSignature;
}*/

// =================================================================  VOUCHER CODE PAYMENT
if ( isset( $_POST['vouchercode'] ) && !empty($_POST['vouchercode']) ) {
	$payment_accepted = '';
	$cleared = '';
	$vouchercode = '';
	$vouchercode = trim ( $_POST['vouchercode'] );
	if ( strlen ( $vouchercode ) == 5 ) {
		$vouchercode = "'" . $vouchercode . "'";
		$dbc = mysqli_connect ( $db_hostname, $db_username, $db_password, $db_database);
		$query = "SELECT vouchercode, voucher_pk, used FROM vouchercodes WHERE vouchercode=$vouchercode";
		$result = mysqli_query ( $dbc, $query );
		$num = mysqli_num_rows ( $result );
		if ( $num == 1 ) {
			$row = mysqli_fetch_row ( $result );
			$used = $row[2];
			$pk = $row[1];
			$pk = "'" . $pk . "'";
			if ( $used == NULL ) {
				$cleared = 'yes';
				$update = "UPDATE vouchercodes SET used=1, useddate=NOW() WHERE vouchercode=$vouchercode";
				$done = mysqli_query ( $dbc, $update );
				}
			else {
				$cleared = 'no';
				}
			}
		else {
			$cleared = 'error';
			}
		}
	else {
		$cleared = 'invalid';
		}
	if ( $cleared == 'yes' ) {
		$payment_accepted = 'yes';
		$_SESSION['payment_accepted'] = $payment_accepted;
		}
	}
	
// =================================================================  STRIPE CC PAYMENT	
else if ( isset ( $_POST['stripeToken'] ) && !$refreshed ) {
	$payment_accepted = '';
	// set your secret key: remember to change this to your live secret key in production
	// see your keys here https://manage.stripe.com/account
	Stripe::setApiKey();
	// get the credit card details submitted by the form
	$token = $_POST['stripeToken'];
	$chargeAmount = $_POST['chargeAmount'];
	// create the charge on Stripe's servers - this will charge the user's card
	$charge = Stripe_Charge::create(array(
	  "amount" => $chargeAmount, // amount in cents, again
	  "currency" => "usd",
	  "card" => $token,
	  "description" => "payinguser@example.com")
	);
	$payment_accepted = 'yes';
	$_SESSION['payment_accepted'] = $payment_accepted;
	}
else if ( isset ($_POST['payment_accepted']) && !empty($_POST['payment_accepted']) ) {
	$payment_accepted = 'yes';
	$_SESSION['payment_accepted'] = $payment_accepted;
}

// =================================================================  ADD EMAIL TO DB			
// add email to subscription database
if ( isset($_POST['emailaddress']) && !empty($_POST['emailaddress']) && !$refreshed ) {
	// add email to database
	$dbc = mysqli_connect ( $db_hostname, $db_username, $db_password, $db_database);
	$emailaddress = $_POST['emailaddress'];
	$idcode = uniqid ( 'email', 1 );
	$query = "INSERT INTO emailrenew (emailaddress, idcode, startdate) VALUES" . "('$emailaddress', '$idcode', NOW())";
	$result = mysqli_query ($dbc, $query);
	// get date from database, set nextdate and enddate
	$datequery = "SELECT startdate FROM emailrenew WHERE emailaddress = '$emailaddress' AND idcode = '$idcode' LIMIT 1";
	$dateresult = mysqli_query($dbc, $datequery);
    $daterow = mysqli_fetch_array($dateresult);
    if ($daterow != NULL) {
		$nowdate = $daterow['startdate'];
		$nextdate = date ('Y-m-d', strtotime ($nowdate . "+ 1 year" ));
		$enddate = date ('Y-m-d', strtotime ($nowdate . "+ 3 years" ));
		$updatequery = "UPDATE emailrenew SET nextdate = '$nextdate' WHERE idcode = '$idcode'";
		mysqli_query ($dbc, $updatequery);
		$updatequery2 = "UPDATE emailrenew SET enddate = '$enddate' WHERE idcode = '$idcode'";
		mysqli_query ($dbc, $updatequery2);
		$checkresult = $enddate;
		}
	mysqli_close ( $dbc );
	}

// =================================================================  SUCCESSFUL PAYMENT
//if ( $_SESSION['payment_accepted'] == 'yes' || $payment_accepted == 'yes' ) { //TESTING CHANGE
	$output_s = false;
	// determine state variables for navigation
	$weirdstates = array (
		'indiana',
		'kansas',
		'kentucky',
		'mississippi',
		'nevada',
		'newhampshire',
		'ohio',
		'oklahoma',
		'oregon',
		'texas',
		'utah',
		'vermont',
		'wisconsin'
	);
	if ( in_array($us_state_name, $weirdstates) ) {
		$pdfstate = $us_state_name . '_pdf.php';
	} else {
		$pdfstate = 'generalstate_pdf.php';
	}
	$address = $RELADDRESS . 'pdfgenerators/' . $pdfstate;
	$output_s = false;

// =================================================================  DISPLAY PDF	
	// DISPLAY PDF
	echo <<<EOT
		
	<div class="pdfdisplay print">
		<object data="$address" type="application/pdf" width="100%">
			<p>It appears you don't have a PDF plugin for this browser. No biggie... you can <a href="$address" class="underline">click here to download the PDF file.</a></p>  
		</object>
	</div>
	
	<!--<a href="$address" target="blank" class="underline">View PDF</a><span class="pdfinstructions"> (Right-click on this link to save the document as a PDF on your computer.)</span><br />-->
EOT;
	echo '<a href="' . $back_page_address . '" title="" class="backbutton donepage" style="clear: both;">EDIT</a>';
	echo <<<EOT
	<div class="centericons donepage">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<!--<a class="addthis_button_stumbleupon"></a>-->
				<a class="addthis_button_email"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<!-- AddThis Button END -->
		</div>
EOT;

// =================================================================  THREE COLUMNS
	$email_pic_address = $RELADDRESS . 'images/email.png';
	$save_pic_address = $RELADDRESS . 'images/save.png';
	$print_pic_address = $RELADDRESS . 'images/print.png';
	echo <<<EOT
	
	<div class="threecolumn donepage">
	<div class="column first">
		<h2 id="threecolumn_email"><a href="#threecolumn_email"><img class="threecolumnimg" src="$email_pic_address" title="Email" alt="At sign" /></a> EMAIL</h2>
		<!--<p>Email your proxy to yourself, your designated health proxy, even your doctor.</p>-->
EOT;

// =================================================================  SEND EMAILS	
	// SEND EMAIL FORM
	if ( isset ( $_POST['emailformsubmitted'] ) && !empty($_POST['emailformsubmitted']) ) {
		//Create the Transport
		$transport = Swift_SmtpTransport::newInstance('', 25)
		  ->setUsername('')
		  ->setPassword('')
		  ;
		$mailer = Swift_Mailer::newInstance($transport);
		$emailmessage = (string) trim ( strip_tags ( $_POST['emailmessage'] ) );
		$to = explode ( ',', $_POST['to_emailaddress'] );
		//Create the message
		$message = Swift_Message::newInstance()
		  //Give the message a subject
		->setSubject('Health Proxy')
		  //Set the From address with an associative array
		->setFrom(array('info@patientproxy.com' => 'Patient Proxy'))
		  //Set the To addresses with an associative array
		->setTo($to)
		  //Give it a body
		->setBody($emailmessage);
		  //And optionally an alternative body
		//->addPart('<h1>Check it out!</h1><p>This thing generates a pdf and emails it, without saving anything on the server. <b>YES!!!</b></p>', 'text/html');
		$output_s = true;
		require_once('extensions/fpdf/pdfadd.php');
		require_once ( 'pdfgenerators/generalstate_pdf.php' );
		//Optionally add any attachments
		$attachment = Swift_Attachment::newInstance( $finaloutput, 'application/pdf' )->setFilename('healthproxy.pdf');
		$message->attach($attachment);
		//Send the message
		$result = $mailer->send($message);
		if ( $result ) {
			echo '<p>Thanks for sharing!</p>';
		}
		else {
			echo '<p>Our apologies, but an error has occurred.</p>';
		}
	}
	else {
		$path = $RELADDRESS . 'form/' . $us_state_name . '/done/';
		echo <<<EOT
			<form action="$path" method="POST">
			<div id="questionblock">
				<span class="questiontext"></span>
				<fieldset class="form_set">
					<!--<p>Email a PDF of your Health Proxy and Living Will to yourself and your Health Proxy:</p>-->
				  	<ul class="form_ul otherpages"> 
				  		<li class="text_li">
				  			<span class="instructions donepage">Separate email addresses with a comma.</span>
				  			<span class="form_label required_field"><label for="to_emailaddress">To:</label></span>
				  			<span class="form_field required_field"><input class="required" id="to_emailaddress" name="to_emailaddress" type="text"></span><br /> 
				  		</li>
				  		<li class="text_li">
				  			<span class="form_label required_field"><label for="emailmessage">Message:</label></span>
				  			<span class="form_field required_field"><textarea class="required halfwidth" id="emailmessage" name="emailmessage"></textarea></span><br /> 
				  		</li>
					</ul>
				</fieldset>
			</div>
			<input type="hidden" name="emailformsubmitted" value="yes" />
			<button type="submit" class="nextbutton donepage send">SEND</button>
			</form>
EOT;
	}
// =================================================================  END EMAILS	

	echo <<<EOT
	</div>
	<div class="line"></div>
	<div class="column middle">
		<h2><a href="$address" target="blank"><img class="threecolumnimg" src="$save_pic_address" title="Save" alt="Save icon" /></a> SAVE</h2>
		<a href="$address" class="nextbutton donepage save" target="blank">SAVE</a>
	</div>
	<div class="line"></div>
	<div class="column last">
		<h2><a href="$address" onclick="window.print();return false" target="blank"><img class="threecolumnimg" src="$print_pic_address" title="Print" alt="Print icon" /></a> PRINT</h2>
		<a href="$address" class="nextbutton donepage center print" target="blank">PRINT</a>
	</div>
	</div>


EOT;



//<a href="#" onclick="window.print();return false;">print</a>	


//} // TESTING CHANGE
	
	

?>