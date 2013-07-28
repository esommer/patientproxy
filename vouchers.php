<?php
/** VOUCHERS.PHP
 *
 * Begins the voucher-orders
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */


// INCLUDES
require_once('extensions/stripe/lib/Stripe.php');
require_once('includes/header.php');


// PREPARE VARS
$legal_voucher = '';
$load_page = '';
$request_signature = '';
$refreshed = '';
$token = '';
$chargeAmount = '';
$charge = '';
$charged = '';
$valid_email = '';
$valid_mailing = '';
$error_message = '';


// CHECK REFRESH
$request_signature = md5($_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'].print_r($_POST, true));
if ( isset($_SESSION['last_request_sig']) && $_SESSION['last_request_sig'] == $request_signature ) {
	$refreshed = true;
} else {
	$refreshed = false;
	$_SESSION['last_request_sig'] = $request_signature;
}

// STRIPE CHARGE
if ( isset($_POST['stripeToken']) 
		&& !empty($_POST['stripeToken']) 
		&& !$refreshed ) {
		
	// make sure valid email & mailing first	
	if ( isset($_POST['emailaddress']) && !empty($_POST['emailaddress']) ) {
		$valid_email = 'yes';
		// add test for VALIDITY of email
		//
		//
	} else {
		$error_message .= '<br />Please provide a valid email address so we can contact you in case of problems with your order.';
	}
	
	if ( isset($_POST['mailingaddress']) && !empty($_POST['mailingaddress']) ) {
		$valid_mailing = 'yes';
	} else {
		$error_message .= '<br />Please provide a valid mailing address to which we can send your order.';
	}
	
	if ( ($valid_email == 'yes') && ($valid_mailing == 'yes') ) {
		// get the credit card details submitted by the form
		$token = $_POST['stripeToken'];
		$chargeAmount = $_POST['chargeAmount'];
		// set your secret key: remember to change this to your live secret key in production
		// see your keys here https://manage.stripe.com/account
		Stripe::setApiKey();
		
		// create the charge on Stripe's servers - this will charge the user's card
		$charge = Stripe_Charge::create(array(
		  "amount" => $chargeAmount, // amount in cents, again
		  "currency" => "usd",
		  "card" => $token,
		  "description" => "payinguser@example.com")
		);	
		if ( $charge ) {
			$charged = 'yes';
		}
	}
}

// CHECK $_POST & $_SESSION for legal
if ( isset($_POST['legal_voucher']) && $_POST['legal_voucher'] == 'agree' ) {
	$legal_voucher = 'agree';
	$_SESSION['legal_voucher'] = 'agree';
} else if ( isset($_SESSION['legal_voucher']) && $_SESSION['legal_voucher'] == 'agree' ) {
	$legal_voucher = 'agree';
} else {
	$legal_voucher = '';
}

// CHECK $_GET vars for navigation
if ( isset($_GET['page']) && !empty($_GET['page']) ) {
	$load_page = str_replace('-', '_', $_GET['page']);
}
switch($load_page) {
	case('legal'):
		require_once('pages/voucher_legal.php');
		break;
	case('pay'):
		if ( $legal_voucher == 'agree' ) {
			require_once('pages/voucher_payment.php');
		} else {
			require_once('pages/voucher_legal.php');
		}
		break;
	case('thanks'):
		if ( $charged == 'yes' ) {
			require_once('pages/voucher_thanks.php');
		} else {
			require_once('pages/voucher_payment.php');
		}
		break;
	default:
		require_once('pages/voucher_info.php');
		break;
}


// CLEAR VARS
$page_load = '';
$legal_voucher = '';
$request_signature = '';
$refreshed = '';
$token = '';
$chargeAmount = '';
$charge = '';
$charged = '';
$valid_email = '';
$valid_mailing = '';
$error_message = '';


// END PAGE
require_once('includes/footer.php');

?>