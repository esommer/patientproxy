<?php
/** FORM.PHP
 *
 * Generates question pages based on US state & location in form
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */
 
session_start();
//session_destroy(); //TESTING
ini_set( "display_errors", true ); //TESTING

$_SESSION['legal_agreed'] = 'yes'; // TESTING
require_once('extensions/stripe/lib/Stripe.php');
require_once('extensions/swift/lib/swift_required.php');

// PREPARE VARS:
$redirect = '';
$host = '';
$uri = '';
$us_state_get = '';
$load_page_get = '';
$us_state_post = '';
$load_page_post = '';
$addToSessionList = array ();
if ( !isset($fieldIDList) ) {
	$fieldIDList = array ();
}

// if $_POST empty, try $_SESSION['post_data'] in case of redirect
if ( empty($_POST) && isset($_SESSION['post_data']) && !empty($_SESSION['post_data']) ) {
	$_POST = $_SESSION['post_data'];
	unset($_SESSION['post_data']); 
}	

// check LEGAL
if ( !isset($_SESSION['legal_agreed']) || empty($_SESSION['legal_agreed']) ) {
	// REDIRECT TO LEGAL
	$redirect = 'legal';
}
	
// $GET state
if ( isset($_GET['page']) && !empty($_GET['page']) ) {
	$us_state_get = $_GET['page'];
}
// $GET page
if ( isset($_GET['section']) && !empty($_GET['section']) ) {
	$load_page_get = $_GET['section'];
}
// $POST state
if ( isset($_POST['us_state']) && !empty($_POST['us_state']) ) {
	$us_state_post = $_POST['us_state'];
}
// $POST page
if ( isset($_POST['next_page']) && !empty($_POST['next_page']) ) {
	$load_page_post = $_POST['next_page'];
}

require_once('includes/setvars.php');
require_once('includes/basicelements.php');


// VALID US STATE?
if ( in_array($us_state_get, $STATECODES) ) {
	$us_state_name = $us_state_get;
	$_SESSION['us_state'] = $us_state_name;
	// determine state set
	switch($us_state_name) {
		// if one of weird states, go through to set $us_state_set as ${$state_name}
		case 'indiana':
		case 'kansas':
		case 'kentucky':
		case 'mississippi':
		case 'nevada':
		case 'newhampshire':
		case 'ohio':
		case 'oklahoma':
		case 'oregon':
		case 'texas':
		case 'utah':
		case 'vermont':
		case 'wisconsin':
			require_once("states/$us_state_name.php");
			$us_state_array = ${$us_state_name};
			break;
		default:
			require_once("states/generalstate.php");
			$us_state_array = $generalstate;
			break;
	} // close switch
	$load_page_name = $load_page_get;
} // close valid-state-name check
else if ( $us_state_get == 'legal' ) {
	$load_page_name = $us_state_get;
	if ( in_array($load_page_get, $STATECODES) ) {
		$us_state_name = $load_page_get;
		$_SESSION['us_state'] = $us_state_name;
		// determine state set
		switch($us_state_name) {
			// if one of weird states, go through to set $us_state_set as ${$state_name}
			case 'indiana':
			case 'kansas':
			case 'kentucky':
			case 'mississippi':
			case 'nevada':
			case 'newhampshire':
			case 'ohio':
			case 'oklahoma':
			case 'oregon':
			case 'texas':
			case 'utah':
			case 'vermont':
			case 'wisconsin':
				require_once("states/$us_state_name.php");
				$us_state_array = ${$us_state_name};
				break;
			default:
				require_once("states/generalstate.php");
				$us_state_array = $generalstate;
				break;
		} // close switch
	} // close valid-state-name check
} else {
	$load_page_name = $us_state_get;
}

if ( isset($_POST['direction']) && ($_POST['direction'] == 'backward') ) {
	// perhaps we have a failed backwards nav on our hands, check $direction
		// REDIRECT!!!
		$redirect = 'back_page';
}


/*if ( !empty($redirect) ) {
	switch ( $redirect ) {
		case 'back_page':
			$_SESSION['post_data'] = $_POST;
			$host = '';
			$uri = '';
			$page = '';
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			if ( isset($_POST['back_page']) && !empty($_POST['back_page']) ) {
				$page = str_replace('_', '-', $_POST['back_page']);
			} else {
				$page = 'patient_info';
			}
			header("Location: http://$host$uri/$page");
			exit;
			break;
		case 'legal':
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/legal/");
			exit;
			break;
		case 'home':
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/");
			exit;
			break;
		default:
			header("Location: localhost:8888/esommer/practice/");
			exit;
			break;
	}
}





*/
?>



<?php
switch ( $load_page_name ) {
	case 'map' :
		require_once('includes/header.php');
		require_once('includes/datahandler.php');
		require_once('pages/map.php');
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		require_once('includes/footer.php');
		break;
	case 'legal' :
		require_once('includes/header.php');
		require_once('includes/datahandler.php');
		require_once('pages/legal.php');
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		require_once('includes/footer.php');
		break;
	case 'payment' :
		$total_pages = count($us_state_array);
		$back_page = $us_state_array[$total_pages - 1];
		$back_page_address = $RELADDRESS . 'form/' . $us_state_name . '/' . $back_page . '/';
		require_once('includes/header.php');
		require_once('includes/datahandler.php');
		require_once('pages/payment.php');
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		require_once('includes/footer.php');
		break;
	case 'done':
		$total_pages = count($us_state_array);
		$back_page = $us_state_array[$total_pages - 1];
		$back_page_address = $RELADDRESS . 'form/' . $us_state_name . '/' . $back_page . '/';
		require_once('includes/header.php');
		require_once('includes/datahandler.php');
		require_once('pages/done.php');
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		//if ( isset($_SESSION['payment_accepted']) && $_SESSION['payment_accepted'] == 'yes' ) { disabled for TESTING & FREE
			//echo '<a href="' . $back_page_address . '" title="" class="backbutton" style="clear: both;">EDIT</a>';
		//} disabled for TESTING & FREE
		require_once('includes/footer.php');
		break;
	case 'scholarship':
		$total_pages = count($us_state_array);
		$back_page = $us_state_array[$total_pages - 1];
		$back_page_address = $RELADDRESS . 'form/' . $us_state_name . '/' . $back_page . '/';
		require_once('includes/header.php');
		require_once('includes/datahandler.php');
		require_once('pages/scholarship.php');
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		require_once('includes/footer.php');
		break;
	default:
		require_once('includes/datahandler.php');
		require_once('includes/htmlgenerator.php');
		
		// GO PROCESS POST DATA, UPDATE $us_state & $SESSION IF STATE or FULLNAME CHANGED!
		
		// CLEAR VARS
		$div_level = '';
		$div_start_or_end = '';
		$form_action = '';
		$form_method = '';
		$page_num = '';
		$next_page = '';
		$back_page = '';
		
		// DETERMINE $next_page and $back_page
		if ( in_array($load_page_name, $us_state_array) ) {
			$page_num = array_search($load_page_name, $us_state_array);	
			if ( $page_num + 1 == count($us_state_array) ) {
				if ( isset ($_SESSION['payment_accepted']) && $_SESSION['payment_accepted'] == 'yes' ) {
					$next_page = 'done';
				} else {
					$next_page = 'payment';
					$next_page = 'done'; // TESTING
				}
				$back_page = $us_state_array[$page_num - 1];
			} else if ( $page_num === 0 ) {
				$next_page = $us_state_array[$page_num + 1];
				$back_page = 'map';
			} else {
				$next_page = $us_state_array[$page_num + 1];
				$back_page = $us_state_array[$page_num - 1];
			}
		} 
		
		if ( $back_page == 'map' ) {
			$back_form_action = $RELADDRESS . 'form/map/';
		} else {
			$back_form_action = $RELADDRESS . 'form/' . $us_state_name . '/' . $back_page . '/';
		}
		
		require_once('includes/header.php');
		
		// SET VARS FOR OUTPUT
		$form_action = $RELADDRESS . 'form/' . $us_state_name . '/' . $next_page . '/';
		$load_page_object = ${$load_page_name};
		
		// ======================================= BEGIN OUTPUT
		echo <<<EOT
		<div class="questionblock">
		<form action="$form_action" method="POST" id="questionform">
		<div class="pageheight">
EOT;
		questionpage_builder($load_page_object);
		echo <<<EOT
		</div><!--close of .pageheight-->
		<input type="hidden" name="us_state" value="$us_state_name" />
		<input type="hidden" name="next_page" value="$next_page" />
		<input type="hidden" name="back_page" value="$back_page" />
		<button type="submit" class="nextbutton">CONTINUE</button>
		<button type="submit" class="backbutton">BACK</button>
EOT;
		if ($load_page_name == 'patientInfo') {
			$terms_page = $RELADDRESS . 'form/legal/';
			echo '<p class="legalinfo">By clicking continue, you agree to our <a class="underline" href="' . $terms_page . '" title="Terms of Use">terms of use</a>.</p>';
		}
		echo <<<EOT
		</form>
		</div><!-- close of div.questionblock -->		
EOT;
		
		// _______________________________________ END OUTPUT
		
		$fieldIDList = array_merge ( $fieldIDList, $addToSessionList );
		$_SESSION['fieldIDList'] = $fieldIDList;
		require_once('includes/footer.php');
		break;
}

?>