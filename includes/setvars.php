<?php
/** SETVARS.PHP
 *
 * Determine and set some global variables
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */
ini_set( "display_errors", true ); //TESTING

date_default_timezone_set( "America/New_York" );
$SELF = $_SERVER['PHP_SELF'];
$RELADDRESS = preg_replace('/([a-zA-Z_]+).php$/', '', $SELF);

$STATECODES = array (
	'AL' => 'alabama',
	'AK' => 'alaska',
	'AZ' => 'arizona',
	'AR' => 'arkansas',
	'CA' => 'california',
	'CO' => 'colorado',
	'CT' => 'connecticut',
	'DE' => 'delaware',
	'DC' => 'washingtondc',
	'FL' => 'florida',
	'GA' => 'georgia',
	'HI' => 'hawaii',
	'ID' => 'idaho',
	'IL' => 'illinois',
	'IN' => 'indiana',
	'IA' => 'iowa',
	'KS' => 'kansas',
	'KY' => 'kentucky',
	'LA' => 'louisiana',
	'ME' => 'maine',
	'MD' => 'maryland',
	'MA' => 'massachusetts',
	'MI' => 'michigan',
	'MN' => 'minnesota',
	'MS' => 'mississippi',
	'MO' => 'missouri',
	'MT' => 'montana',
	'NE' => 'nebraska',
	'NV' => 'nevada',
	'NH' => 'newhampshire',
	'NJ' => 'newjersey',
	'NM' => 'newmexico',
	'NY' => 'newyork',
	'NC' => 'northcarolina',
	'ND' => 'northdakota',
	'OH' => 'ohio',
	'OK' => 'oklahoma',
	'OR' => 'oregon',
	'PA' => 'pennsylvania',
	'RI' => 'rhodeisland',
	'SC' => 'southcarolina',
	'SD' => 'southdakota',
	'TN' => 'tennessee',
	'TX' => 'texas',
	'UT' => 'utah',
	'VT' => 'vermont',
	'VA' => 'virginia',
	'WA' => 'washington',
	'WV' => 'westvirginia',
	'WI' => 'wisconsin',
	'WY' => 'wyoming'
);

$db_hostname = '';
$db_database = '';
$db_username = '';
$db_password = '';

?>