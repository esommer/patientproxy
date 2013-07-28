<?php
// OHIO
session_start();
require_once ( '../extensions/fpdf/pdfadd.php' );


/*
Standard Letter size paper = 210mm across. Center Line = 105mm.
Doc margins are set to 20mm each so print area = 170mm.

$pdf->Write ( #_line_height , 'string of text' );

$pdf->SetFont ( 'Font Name', 'B/U/I', #_font_size );

$pdf->SetFontSize ( # );

$pdf->MultiCell ( #_width=0, #_line_height, 'string of text', #_border=0, 'L/C/R/J_align=J' );

$pdf->Cell ( #_width=0, #_line_height, 'string of text', #_border=0, #_ln_location=>1, 'L/C/R/J_align=L' );

$pdf->Ln ( #_line_height );
*/

// ===================================== BEGIN SET UP
$pdf = new PDF();
if ( isset ( $_SESSION['savedData'] ) ) {
	$savedData = $_SESSION['savedData'];
}
else {
	$savedData = array();
}
$pdf->SetTopMargin ( 20 );
$pdf->AddPage();
$pdf->SetMargins ( 20, 20, 20 );
$pdf->SetFont( 'Arial', '', 10 );
// _____________________________________ END SET UP


$loadData = array();
$loadData = array (
	'patient_full_name' => 'patientInfo_patientData_fullNameReq_fieldID',
	'patient_birth_date' => 'patientInfo_patientData_birthDate_fieldID',
	'patient_us_state_abbrev' => 'patientInfo_patientData_usStateReq_fieldID',
	'hp_fullname' => 'healthProxy_personData_fullName_fieldID',
	'hp_address' => 'healthProxy_personData_streetAddress_fieldID',
	'hp_city' => 'healthProxy_personData_city_fieldID',
	'hp_state' => 'healthProxy_personData_usState_fieldID',
	'hp_zip' => 'healthProxy_personData_zip_fieldID',
	'hp_phone' => 'healthProxy_personData_phone_fieldID',
	'hp_cellphone' => 'healthProxy_personData_cellPhone_fieldID',
	'hp_email' => 'healthProxy_personData_email_fieldID',
	'althp_fullname' => 'alternateHP_personData_fullName_fieldID',
	'althp_address' => 'alternateHP_personData_streetAddress_fieldID',
	'althp_city' => 'alternateHP_personData_city_fieldID',
	'althp_state' => 'alternateHP_personData_usState_fieldID',
	'althp_zip' => 'alternateHP_personData_zip_fieldID',
	'althp_phone' => 'alternateHP_personData_phone_fieldID',
	'althp_cellphone' => 'alternateHP_personData_cellPhone_fieldID',
	'althp_email' => 'alternateHP_personData_email_fieldID',
	'guidance_freetext' => 'guidance_freeTextElementSet_freeTextElement_fieldID',
	'althp2_fullname' => 'secondAlternateHP_personData_fullName_fieldID',
	'althp2_address' => 'secondAlternateHP_personData_streetAddress_fieldID',
	'althp2_city' => 'secondAlternateHP_personData_city_fieldID',
	'althp2_state' => 'secondAlternateHP_personData_usState_fieldID',
	'althp2_zip' => 'secondAlternateHP_personData_zip_fieldID',
	'althp2_phone' => 'secondAlternateHP_personData_phone_fieldID',
	'althp2_cellphone' => 'secondAlternateHP_personData_cellPhone_fieldID',
	'althp2_email' => 'secondAlternateHP_personData_email_fieldID',
	'authority_set' => 'authority_authoritySet_fieldID_SET', // painRelief, lsTreatment, giveRefuse, information, furtherDisclosure, release, indemnity, discharge, facility, transport, theFollowing
	'special_set' => 'specialInstructionsPage_specialInstructionsSet_fieldID_SET',
	'limits_freetext' => 'limitations_freeTextElementSet_freeTextElement_fieldID',
	'livwill_set' => 'livingWill_livingWillSet_fieldID_SET', // terminalCondition, permanentlyUnconscious
	'special_md_set' => 'specialInstructionsMDPage_specialInstructionsMDSet_fieldID_SET',
	'orgdon_freetext' => 'organDonor_donationSet_followingParts_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'orgdon_set' => 'organDonor_donationSet_fieldID_SET', // followingParts, doNotDonate, donate
);
foreach ( $loadData as $varName => $keyName ) {
	if ( array_key_exists ( $keyName, $savedData ) ) {
		if ( !is_array ( $savedData[$keyName] ) ) {
			${$varName} = $savedData[$keyName];
		} else {
			${$varName} = array ();
			foreach ( $savedData[$keyName] as $key => $val ) {
				${$varName}[] = $val;
			}
		}
	} else {
		//${$varName} = '';
	}
}

// ===================================== BEGIN HEADER
// FULLNAME
$pdf->SetFont ( 'Arial', 'B', 12 );
$pdf->Cell ( 0, 5, "$patient_full_name", 0, 1, 'R' );
$pdf->SetFont( 'Arial', '', 10 );

// BIRTHDATE
if ( !empty ( $patient_birth_date ) ) {
	$pdf->SetFont ( 'Arial', 'I', 10 );
	$pdf->SetTextColor ( 150, 150, 150 );
	$pdf->Cell ( 0, 5, "(DOB: $patient_birth_date)", 0, 1, 'R' );
	$pdf->SetFont( 'Arial', '', 10 );
}

// DATE
$date = getdate();
$month = $date['month'];
$day = $date['mday'];
$year = $date['year'];
$pdf->SetTextColor ( 150, 150, 150 );
$pdf->Cell ( 0, 5, "$month $day, $year", 0, 1, 'R');
// _____________________________________ END HEADER


// ===================================== BEGIN HEALTH PROXY
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Health Proxy', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );

$pdf->Write(5, "I, $patient_full_name, born $patient_birth_date, state that this is my Health Care Power of Attorney, and I revoke any prior Health Care Power of Attorney signed by me. I understand the nature and purpose of this document. If any provision is found to be invalid or unenforceable, it will not affect the rest of this document. This Health Care Power of Attorney is in effect only when I cannot make health care decisions for myself. However, this does not require or imply that a court must declare me incompetent.");
$pdf->Ln(7);
// APPOINT PROXY & ALTERNATE
$whatSet = '';
// if all three are set
if ( !empty ( $hp_fullname ) && !empty ( $althp_fullname ) && !empty( $althp2_fullname) ) {
	$whatSet = 'all three';
	$pdf->Write ( 5, 'The first person named below is my attorney in fact who will make health care decisions for me as authorized in this document. Should my attorney in fact named below not be immediately available or be unwilling or unable to make decisions for me, then I name, in the following order of priority, the following persons as my alternate attorney in facts.');
}
// else if two of three are set
else if ( !empty( $hp_fullname) && !empty($althp_fullname) && empty($althp2_fullname) ) {
	$whatSet = 'hp and alt';
	$pdf->Write(5, 'The first person named below is my attorney in fact who will make health care decisions for me as authorized in this document. Should my attorney in fact named above not be immediately available or be unwilling or unable to make decisions for me, then I name the following person as my alternate attorney in fact.');
}
else if ( !empty( $hp_fullname) && empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'hp and 3rd';
	$pdf->Write(5, 'The first person named below is my attorney in fact who will make health care decisions for me as authorized in this document. Should my attorney in fact named above not be immediately available or be unwilling or unable to make decisions for me, then I name the following person as my alternate attorney in fact.');
}
else if ( empty($hp_fullname) && !empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'alt and 3rd';
	$pdf->Write(5, 'The first person named below is my attorney in fact who will make health care decisions for me as authorized in this document. Should my attorney in fact named above not be immediately available or be unwilling or unable to make decisions for me, then I name the following person as my alternate attorney in fact.');
}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) && empty ( $althp2_fullname) ) {
	$whatSet = 'just hp';
	$pdf->Write ( 5, 'The person named below is my attorney in fact who will make health care decisions for me as authorized in this document.' );
}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) && empty( $althp2_fullname) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, 'The person named below is my attorney in fact who will make health care decisions for me as authorized in this document.' );
}
else if ( empty ( $hp_fullname) && empty( $althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'just 3rd';
	$pdf->Write ( 5, 'The person named below is my attorney in fact who will make health care decisions for me as authorized in this document.' );
}
$pdf->Ln ( 8 );
switch ( $whatSet ) {
	case 'all three':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Cell ( 10, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Proxy' );
		$pdf->Cell ( 10, 5 );
		$pdf->Cell ( 50, 5, 'Second Alternate Proxy');
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// names
		$pdf->Cell ( 50, 5, "$hp_fullname" );
		$pdf->Cell ( 10, 5 );
		$pdf->Cell ( 50, 5, "$althp_fullname" );
		$pdf->Cell ( 10, 5);
		$pdf->Cell ( 50, 5, "$althp2_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($hp_address) || !empty($althp_address) || !empty($althp2_address) ) {
			$pdf->Cell ( 50, 5, "$hp_address" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_address" );
			$pdf->Cell ( 10, 5);
			$pdf->Cell ( 50, 5, "$althp2_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($hp_city) || !empty($hp_state) || !empty($hp_zip) || !empty($althp_city) || !empty($althp_state) || !empty($althp_zip) || !empty($althp2_city) || !empty($althp2_state) || !empty($althp2_zip) ) {
			if ( !empty($hp_city) && !empty($hp_state) ) {
				// only want comma if city AND state are there
				$pdf->Cell ( 50, 5, "$hp_city, $hp_state $hp_zip" );
			} else {
				$pdf->Cell (50, 5, "$hp_city $hp_state $hp_zip" );
			}
			$pdf->Cell ( 10, 5 );
			if ( !empty($althp_city) && !empty($althp_state) ) {
				$pdf->Cell ( 50, 5, "$althp_city, $althp_state $althp_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$althp_city $althp_state $althp_zip" );
			}
			$pdf->Cell ( 10, 5 );
			if ( !empty($althp2_city) && !empty($althp2_state) ) {
				$pdf->Cell ( 50, 5, "$althp2_city, $althp2_state $althp2_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$althp2_city $althp2_state $althp2_zip" );
			}
			$pdf->Ln();
		}
		// phones
		if ( !empty($hp_phone) || !empty($althp_phone) || !empty($althp2_phone) ) {
			$pdf->Cell ( 50, 5, "$hp_phone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_phone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp2_phone" );
			$pdf->Ln();
		}
		// cells
		if ( !empty($hp_cellphone) || !empty($althp_cellphone) || !empty($althp2_cellphone) ) {
			$pdf->Cell ( 50, 5, "$hp_cellphone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_cellphone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp2_cellphone" );
			$pdf->Ln();
		}
		// emails
		if ( !empty($hp_email) || !empty($althp_email) || !empty($althp2_email) ) {
			$pdf->Cell ( 50, 5, "$hp_email" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_email" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp2_email" );
			$pdf->Ln();
		}
		break;
	case 'hp and alt':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// names
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, "$hp_fullname" );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, "$althp_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($hp_address) || !empty($althp_address) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_address" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($hp_city) || !empty($hp_state) || !empty($hp_zip) || !empty($althp_city) || !empty($althp_state) || !empty($althp_zip) ) {
			$pdf->Cell ( 25, 5 );
			if ( !empty($hp_city) && !empty($hp_state) ) {
				// only want comma if city AND state are there
				$pdf->Cell ( 50, 5, "$hp_city, $hp_state $hp_zip" );
			} else {
				$pdf->Cell (50, 5, "$hp_city $hp_state $hp_zip" );
			}
			$pdf->Cell ( 20, 5 );
			if ( !empty($althp_city) && !empty($althp_state) ) {
				$pdf->Cell ( 50, 5, "$althp_city, $althp_state $althp_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$althp_city $althp_state $althp_zip" );
			}
			$pdf->Ln();
		}
		// phones
		if ( !empty($hp_phone) || !empty($althp_phone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_phone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp_phone" );
			$pdf->Ln();
		}
		// cells
		if ( !empty($hp_cellphone) || !empty($althp_cellphone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_cellphone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp_cellphone" );
			$pdf->Ln();
		}
		// emails
		if ( !empty($hp_email) || !empty($althp_email) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_email" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp_email" );
			$pdf->Ln();
		}
		break;
	case 'hp and 3rd':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// names
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, "$hp_fullname" );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, "$althp2_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($hp_address) || !empty($althp2_address) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_address" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($hp_city) || !empty($hp_state) || !empty($hp_zip) || !empty($althp2_city) || !empty($althp2_state) || !empty($althp2_zip) ) {
			$pdf->Cell ( 25, 5 );
			if ( !empty($hp_city) && !empty($hp_state) ) {
				// only want comma if city AND state are there
				$pdf->Cell ( 50, 5, "$hp_city, $hp_state $hp_zip" );
			} else {
				$pdf->Cell (50, 5, "$hp_city $hp_state $hp_zip" );
			}
			$pdf->Cell ( 20, 5 );
			if ( !empty($althp2_city) && !empty($althp2_state) ) {
				$pdf->Cell ( 50, 5, "$althp2_city, $althp2_state $althp2_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$althp2_city $althp2_state $althp2_zip" );
			}
			$pdf->Ln();
		}
		// phones
		if ( !empty($hp_phone) || !empty($althp2_phone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_phone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_phone" );
			$pdf->Ln();
		}
		// cells
		if ( !empty($hp_cellphone) || !empty($althp2_cellphone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_cellphone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_cellphone" );
			$pdf->Ln();
		}
		// emails
		if ( !empty($hp_email) || !empty($althp2_email) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_email" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_email" );
			$pdf->Ln();
		}
		break;
	case 'alt and 3rd':
	// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// names
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, "$althp_fullname" );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, "$althp2_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($althp_address) || !empty($althp2_address) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$althp_address" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($althp_city) || !empty($althp_state) || !empty($althp_zip) || !empty($althp2_city) || !empty($althp2_state) || !empty($althp2_zip) ) {
			$pdf->Cell ( 25, 5 );
			if ( !empty($althp_city) && !empty($althp_state) ) {
				// only want comma if city AND state are there
				$pdf->Cell ( 50, 5, "$althp_city, $althp_state $althp_zip" );
			} else {
				$pdf->Cell (50, 5, "$althp_city $althp_state $althp_zip" );
			}
			$pdf->Cell ( 20, 5 );
			if ( !empty($althp2_city) && !empty($althp2_state) ) {
				$pdf->Cell ( 50, 5, "$althp2_city, $althp2_state $althp2_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$althp2_city $althp2_state $althp2_zip" );
			}
			$pdf->Ln();
		}
		// phones
		if ( !empty($althp_phone) || !empty($althp2_phone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$althp_phone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_phone" );
			$pdf->Ln();
		}
		// cells
		if ( !empty($althp_cellphone) || !empty($althp2_cellphone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$althp_cellphone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_cellphone" );
			$pdf->Ln();
		}
		// emails
		if ( !empty($althp_email) || !empty($althp2_email) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$althp_email" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_email" );
			$pdf->Ln();
		}
		break;
	case 'just hp':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// name
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$hp_fullname" );
		$pdf->Ln();
		// street
		if ( !empty($hp_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_address" );
			$pdf->Ln();
		}
		// city, state zip
		if ( !empty($hp_city) && !empty($hp_state) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_city, $hp_state $hp_zip" );
			$pdf->Ln();
		} else {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_city $hp_state $hp_zip" );
			$pdf->Ln();
		}
		// phone
		if ( !empty($hp_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_phone" );
			$pdf->Ln();
		}
		// cell
		if ( !empty($hp_cellphone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_cellphone" );
			$pdf->Ln();
		}
		// email
		if ( !empty($hp_email) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_email" );
			$pdf->Ln();
		}
		break;
	case 'just alt':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// name
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$althp_fullname" );
		$pdf->Ln();
		// street
		if ( !empty($althp_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_address" );
			$pdf->Ln();
		}
		// city, state zip
		if ( !empty($althp_city) && !empty($althp_state) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_city, $althp_state $althp_zip" );
			$pdf->Ln();
		} else {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_city $althp_state $althp_zip" );
			$pdf->Ln();
		}
		// phone
		if ( !empty($althp_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_phone" );
			$pdf->Ln();
		}
		// cell
		if ( !empty($althp_cellphone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_cellphone" );
			$pdf->Ln();
		}
		// email
		if ( !empty($althp_email) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_email" );
			$pdf->Ln();
		}
		break;
	case 'just 3rd':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// name
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$althp2_fullname" );
		$pdf->Ln();
		// street
		if ( !empty($althp2_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_address" );
			$pdf->Ln();
		}
		// city, state zip
		if ( !empty($althp2_city) && !empty($althp2_state) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_city, $althp2_state $althp2_zip" );
			$pdf->Ln();
		} else {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_city $althp2_state $althp2_zip" );
			$pdf->Ln();
		}
		// phone
		if ( !empty($althp2_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_phone" );
			$pdf->Ln();
		}
		// cell
		if ( !empty($althp2_cellphone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_cellphone" );
			$pdf->Ln();
		}
		// email
		if ( !empty($althp2_email) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_email" );
			$pdf->Ln();
		}
		break;
$pdf->Ln (7);

}
$pdf->Ln (2);
$pdf->Write(5, 'Any person can rely on a statement by any alternate attorney in fact named above that he or she is properly acting under this document and such person does not have to make any further investigation or inquiry.');
$pdf->Ln(10);
// _____________________________________ END HEALTH PROXY

// GUIDANCE TO ATTORNEY IN FACT
$pdf->SetFont('Arial', 'B', 14);
$pdf->Write(5, 'Guidance to Attorney in Fact');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', 10);
$pdf->Write( 5, 'My attorney in fact will make health care decisions for me based on the instructions that I give in this or another document and on my wishes otherwise known to my attorney in fact. If my attorney in fact believes that my wishes as made known to my attorney in fact conflict with what is in this document, this document will control. If my wishes are unclear or unknown, my attorney in fact will make health care decisions in my best interests. My attorney in fact will determine my best interests after considering the benefits, the burdens, and the risks that might result from a given decision. If no attorney in fact is available, this document will guide decisions about my health care.');
$pdf->Ln(7);
if ( !empty($guidance_freetext) ) {
	$pdf->Write(5, 'I further direct that:');
	$pdf->Ln();
	$pdf->Cell( 5, 10 );
	$pdf->Write(5, "$guidance_freetext");
	$pdf->Ln(7);
}

// AUTHORITY OF ATTORNEY IN FACT
if ( !empty( $authority_set ) ) {
	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Write(5, 'Authority of Attorney in Fact');
	$pdf->Ln(7);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Write(5, 'My attorney in fact has full and complete authority to make all health care decisions for me whenever I cannot make such decisions, unless I have otherwise indicated below. This authority includes, but is not limited to, the following:');
	$pdf->Ln(7);
	if ( in_array('painRelief', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To consent to the administration of pain-relieving drugs or treatment or procedures (including surgery) that my attorney in fact, upon medical advice, believes may provide comfort to me, even though such drugs, treatment or procedures may hasten my death. My comfort and freedom from pain are important to me and should be protected by my attorney in fact and physician.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('lsTreatment', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'If I am in a terminal condition, to give, to withdraw or to refuse to give informed consent to life-sustaining treatment, including artificially or technologically supplied nutrition or hydration.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('giveRefuse', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To give, withdraw or refuse to give informed consent to any health care procedure, treatment, intervention or other measure.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('information', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To request, review, and receive any information, verbal or written, regarding my physical or mental health, including, but not limited to, all my medical and health care records.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('furtherDisclosure', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To consent to further disclosure of information, and to disclose medical and related information concerning my condition and treatment to other persons.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('release', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To execute for me any releases or other documents that may be required in order to obtain medical and related information.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('indemnity', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, "To execute consents, waivers, and releases of liability for me and for my estate to all persons who comply with my attorney in fact's instructions and decisions. To indemnify and hold harmless, at my expense, any third party who acts under this Health Care Power of Attorney. I will be bound by such indemnity entered into by my attorney in fact.", 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('discharge', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To select, employ, and discharge health care personnel and services providing home health care and the like.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('facility', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To select, contract for my admission to, transfer me to, or authorize my discharge from any medical or health care facility, including, but not limited to, hospitals, nursing homes, assisted living facilities, hospices, adult homes and the like.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('transport', $authority_set) ) {
		$pdf->Cell(5, 10);
		$pdf->MultiCell(160, 5, 'To transport me or arrange for my transportation to a place where this Health Care Power of Attorney is honored, should I become unable to make health care decisions for myself in a place where this document is not enforced.', 0, 'L');
		$pdf->Ln(2);
	}
	if ( in_array('theFollowing', $authority_set) ) {
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, 'To complete and sign for me the following:', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(10);
		$pdf->MultiCell(150, 5, '(a) Consents to health care treatment, or the issuance of Do Not Resuscitate (DNR) Orders or other similar orders; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(10);
		$pdf->MultiCell(150, 5, '(b) Requests for my transfer to another facility, to be discharged against health care advice, or other similar requests; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(10);
		$pdf->MultiCell(150, 5, '(c) Any other document desirable to implement health care decisions that my attorney in fact is authorized to make pursuant to this document.', 0, 'L');
		$pdf->Ln(2);
	}
	$pdf->Ln(7);
}

if ( !empty($authority_set) ) {
	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Write(5, 'Special Instructions');
	$pdf->Ln(7);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Write(5, 'I SPECIFICALLY AUTHORIZE MY ATTORNEY IN FACT TO REFUSE, OR IF TREATMENT HAS COMMENCED, TO WITHDRAW CONSENT TO, THE PROVISION OF ARTIFICIALLY OR TECHNOLOGICALLY SUPPLIED NUTRITION OR HYDRATION IF:');
	$pdf->Ln();
	$pdf->Cell(5);
	$pdf->Write(5, 'I am in a permanently unconscious state; and');
	$pdf->Ln();
	$pdf->Cell(5);
	$pdf->MultiCell(160, 5, 'My physician and at least one other physician who has examined me have determined, to a reasonable degree of medical certainty, that artificially or technologically supplied nutrition and hydration will not provide comfort to me or relieve my pain.');
	$pdf->Ln(9);
}

// LIMITATIONS
$pdf->SetFont('Arial', 'B', 14);
$pdf->Write(5, "Limitations of Attorney in Fact's Authority");
$pdf->Ln(7);
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'Under Ohio law, there are five limitations to the authority of my attorney in fact:');
$pdf->Ln();
$pdf->Cell(5);
$pdf->MultiCell(160, 5, '1. My attorney in fact cannot order the withdrawal of life-sustaining treatment unless I am in a terminal condition or a permanently unconscious state, and two physicians have confirmed the diagnosis and have determined that I have no reasonable possibility of regaining the ability to make decisions; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell(5);
$pdf->MultiCell(160, 5, '2. My attorney in fact cannot order the withdrawal of any treatment given to provide comfort care or to relieve pain; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell(5);
$pdf->MultiCell(160, 5, '3. If I am pregnant, my attorney in fact cannot refuse or withdraw informed consent to health care if the refusal or withdrawal would end my pregnancy, unless the pregnancy or health care would create a substantial risk to my life or two physicians determine that the fetus would not be born alive; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell(5);
$pdf->MultiCell(160, 5, '4. My attorney in fact cannot order the withdrawal of artificially or technologically supplied nutrition or hydration unless I am terminally ill or permanently unconscious and two physicians agree that nutrition or hydration will no longer provide comfort or relieve pain and, in the event that I am permanently unconscious, I have given a specific direction to withdraw nutrition or hydration elsewhere in this document; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell(5);
$pdf->MultiCell(160, 5, '5. If I previously consented to any health care, my attorney in fact cannot withdraw that treatment unless my condition has significantly changed so that the health care is significantly less beneficial to me, or unless the health care is no longer significantly effective to achieve the purpose for which I chose the health care.', 0, 'L');
$pdf->Ln(7);
if ( !empty($limits_freetext) ) {
	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Write(5, "Additional Limitations");
	$pdf->Ln(7);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Write(5, "My attorney in fact's authority is subject to the following limitations:");
	$pdf->Ln();
	$pdf->Cell(5);
	$pdf->MultiCell(160, 5, "$limits_freetext", 0, 'L');
	$pdf->Ln(9);
}

// OTHER STIPULATIONS
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "No Expiration Date. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'This Health Care Power of Attorney will have no expiration date and will not be affected by my disability or by the passage of time.');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "Guardian. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'I intend that the authority given to my attorney in fact will eliminate the need for any court to appoint a guardian of my person. However, should such proceedings start; I nominate my attorney in fact to serve as the guardian of my person, without bond.');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "Enforcement by Attorney in Fact. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'My attorney in fact may take for me, at my expense, any action my attorney in fact considers advisable to enforce my wishes under this document.');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "No Expiration Date. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, "Release of Attorney in Fact's Personal Liability. My attorney in fact will not incur any personal liability to me or my estate for making reasonable choices in good faith concerning my health care.");
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "Copies the Same as Original. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'Any person may rely on a copy of this document.');
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Write(5, "Out of State Application. ");
$pdf->SetFont('Arial', '', 10);
$pdf->Write(5, 'I intend that this document be honored in any jurisdiction to the extent allowed by law.');
$pdf->Ln(10);

// OHIO DECLARATION
if ( !empty($livwill_set) || !empty($special_md_set) ) {
	
	$pdf->SetFont ( 'Arial', 'B', '16' );
	$pdf->Cell ( 0, 5, 'Ohio Declaration', 0, 1, 'L' );
	$pdf->Ln (3);
	$pdf->SetFont ( 'Arial', '', 10 );
	$pdf->Write(5, 'I state that this is my Ohio Declaration. I am of sound mind and not under or subject to duress, fraud or undue influence. I am a competent adult who understands and accepts the consequences of this action. I voluntarily declare my wish that my dying not be artificially prolonged. If I am unable to give directions regarding the use of life-sustaining treatment when I am in a terminal condition or a permanently unconscious state, I intend that this Declaration be honored by my family and physicians as the final expression of my legal right to refuse health care.');
	$pdf->Ln(7);
	if ( in_array('terminalCondition', $livwill_set) ) {
		$pdf->SetFont( 'Arial', 'B', 14);
		$pdf->Write(5, 'Health Care if I Am in a Terminal Condition');
		$pdf->Ln(7);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If I am in a terminal condition and unable to make my own health care decisions, I direct that my physician shall:');
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '1. Administer no life-sustaining treatment, including CPR and artificially or technologically supplied nutrition or hydration; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '2. Withdraw such treatment, including CPR, if such treatment has started; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '3. Issue a DNR Order; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '4. Permit me to die naturally and take no action to postpone my death, providing me with only that care necessary to make me comfortable and to relieve my pain.', 0, 'L');
		$pdf->Ln(7);
	}
	if ( in_array('permanentlyUnconscious', $livwill_set) ) {
		$pdf->SetFont( 'Arial', 'B', 14);
		$pdf->Write(5, 'Health Care if I Am in a Permanently Unconscious State');
		$pdf->Ln(7);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If I am in a permanently unconscious state, I direct that my physician shall:');
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '1. Administer no life-sustaining treatment, including CPR and artificially or technologically supplied nutrition or hydration unless, in the following section, I have authorized its withholding or withdrawal; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '2. Withdraw such treatment, including CPR, if such treatment has started; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '3. Issue a DNR Order; and', 0, 'L');
		$pdf->Ln(2);
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, '4. Permit me to die naturally and take no action to postpone my death, providing me with only that care necessary to make me comfortable and to relieve my pain.', 0, 'L');
		$pdf->Ln(7);
	}
	if ( !empty($special_md_set) ) {
		$pdf->Write( 5, 'I want to specifically authorize my physician to withhold or to withdraw artificially or technologically supplied nutrition or hydration if:');
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->Write(5, 'I am in a permanently unconscious state; and');
		$pdf->Ln();
		$pdf->Cell(5);
		$pdf->MultiCell(160, 5, 'My physician and at least one other physician who has examined me have determined, to a reasonable degree of medical certainty, that artificially or technologically supplied nutrition and hydration will not provide comfort to me or relieve my pain.');
		$pdf->Ln();
	}
	$pdf->Ln();
}

// ORGAN DONATION
if ( !empty($orgdon_set) || !empty($orgdon_freetext) ) {
	$pdf->SetFont( 'Arial', 'B', 14);
	$pdf->Write(5, 'Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont('Arial', '', 10);
	if ( in_array('donate', $orgdon_set) ) {
		$pdf->Write(5, 'Upon my death, I wish to make an anatomical gift.');
		$pdf->Ln();
	} else if ( in_array('doNotDonate', $orgdon_set) ) {
		$pdf->Write(5, 'Upon my death, I do NOT wish to make an anatomical gift.');
		$pdf->Ln();
	} else {
		$pdf->Write(5, 'In the hope that I may help others upon my death, I hereby give the following body parts:');
		$pdf->Ln();
		$pdf->Cell(5);
		if ( !empty( $orgdon_freetext) ) {
			$pdf->MultiCell(160, 5, "$orgdon_freetext", 0, 'L');
			$pdf->Ln(7);
		} else {
			$pdf->MultiCell(160, 7, '________________________________________________________________________________________________________________________________________________________________', 0, 'L');
			$pdf->Ln();
		}
	}
	$pdf->Ln();
}

// ===================================== BEGIN SIGNATURES
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Signatures', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write ( 5, 'These directions express my legal right to determine the level and extent of my own medical treatment. I intend my instructions to be carried out, unless I have rescinded them in a new writing or by clearly indicating that I have changed my mind. I understand that I may revoke this advance directive at any time. I understand and agree that if I have any prior directives, and if I sign this advance directive, my prior directives are revoked. I understand the full importance and meaning of this advanced directive, and I am emotionally and mentally competent to state my wishes here. If I have appointed a health care proxy or agent, I request that this document guide his or her decisions about my medical care.' );
$pdf->Ln ( 8 );
$pdf->SetFont ( 'Arial', 'B', '10' );
$pdf->Write ( 5, "$patient_full_name" );
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________      	Date   ______________' );
$pdf->Ln ( 14 );

// WITNESSES
$pdf->SetFont ( 'Arial', 'B', '10' );
$pdf->Write ( 5, 'Statement of Witnesses' );
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'I attest that the Declarant signed or acknowledged this Declaration in my presence, that the Principal appears to be of sound mind and not under or subject to duress, fraud or undue influence. I further attest that I am not an attorney in fact for the Declarant, I am not the attending physician of the Declarant, I am not the administrator of a nursing home in which the Declarant is receiving care, and I am an adult not related to the Declarant by blood, marriage or adoption.' );
$pdf->Ln ( 14 );

// WITNESS 1
$pdf->SetFont ( 'Arial', 'B', '10' );
$pdf->Write ( 5, 'Witness 1' );
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Name   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________      	Date   ______________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Address   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, '                ______________________________________________' );
$pdf->Ln ( 14 );

// WITNESS 2
$pdf->SetFont ( 'Arial', 'B', '10' );
$pdf->Write ( 5, 'Witness 2' );
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Name   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________      	Date   ______________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Address   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, '                ______________________________________________' );
$pdf->Ln ( 14 );




// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}
?>