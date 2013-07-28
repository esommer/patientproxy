<?php
/** INFO.PHP
 *
 * Outputs more information about the company.
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */


// INCLUDES
require_once('includes/header.php');

// PREPARE VARS
$info_page = '';

// START DIV
echo '<div class="pagecontent">';

// CHECK $_GET vars for navigation
if ( isset($_GET['page']) && !empty($_GET['page']) ) {
	$info_page = $_GET['page'];
	switch($info_page) {
		case('howitworks'):
			require_once('pages/info_howitworks.php');
			break;
		case('privacy'):
			require_once('pages/info_privacy.php');
			break;
		case('feedback'):
			require_once('pages/info_feedback.php');
			break;
		case('disclaimer'):
			require_once('pages/info_disclaimer.php');
			break;
		default:
			require_once('pages/not_found.php');
			break;
	}
} else {
	require_once('pages/not_found.php');
}

// END DIV
echo '</div><!-- close div .pagecontent -->';

// CLEAR VARS
$info_page = '';

// END PAGE
require_once('includes/footer.php');

?>