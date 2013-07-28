<?php
if ( isset ( $_POST['emailformsubmitted'] ) && !empty($_POST['emailformsubmitted']) ) {
	//Create the Transport
	$transport = Swift_SmtpTransport::newInstance('', 26)
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

	require_once ( 'generalstate_pdf.php' );
	
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
		<div id="stripeform">
			<p>Email a PDF of your Health Proxy and Living Will to yourself and your Health Proxy:</p>
			<div class="form-row">
				<label>To:</label>
				<input type="text" name="to_emailaddress" />
				<label>Message:</label>
				<textarea name="emailmessage" class="message"></textarea>
			</div>
		</div>
		<input type="hidden" name="emailformsubmitted" value="yes" />
		<button type="submit" class="nextbutton">SEND</button>
		</form>
EOT;
}
?>