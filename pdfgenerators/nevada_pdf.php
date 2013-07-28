<?php
// NEVADA

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
	'althp2_fullname' => 'alternateHP_personData2_fullName_fieldID',
	'althp2_address' => 'alternateHP_personData2_streetAddress_fieldID',
	'althp2_city' => 'alternateHP_personData2_city_fieldID',
	'althp2_state' => 'alternateHP_personData2_usState_fieldID',
	'althp2_zip' => 'alternateHP_personData2_zip_fieldID',
	'althp2_phone' => 'alternateHP_personData2_phone_fieldID',
	'althp2_cellphone' => 'alternateHP_personData2_cellPhone_fieldID',
	'althp2_email' => 'alternateHP_personData2_email_fieldID',
	'limits_freetext' => 'limitations_freeTextElementSet_freeTextElement_fieldID',
	'limits_expire' => 'limitations_expDateSet_expDate_fieldID',
	'desires_set' => 'statementOfDesires_desiresSet_fieldID_SET', // lifeProlonged, coma, incurable, artificialNutrition, benefits
	'other_freetext' => 'otherDesires_freeTextElementSet_freeTextElement_fieldID',
	'ls_set' => 'lifeSustaining_lifeSustainingSet_fieldID_SET', // lsNo, lsFT, lsYes
	'ls_freetext' => 'lifeSustaining_furtherDirectSet_freeTextElement_fieldID',
	'orgdon_set' => 'organDonation_wishRefuseToDonateSet_fieldID_SET', // refuseToDonate, writtenSigned, wishToDonate
	'orgdon_wish_set' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_organsSet_fieldID_SET', // anyNeeded, theFollowing
	'orgdon_wish_freetext' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_organsSet_theFollowing_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'orgdon_purp_set' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_purpose_fieldID_SET', // anyPurpose, therapeutic
	'orgdon_signed_freetext' => 'organDonation_wishRefuseToDonateSet_writtenSigned_fieldID_freeTextElementSet_freeTextElement_fieldID'
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

// APPOINT PROXY & ALTERNATE
$whatSet = '';
// if all three are set
if ( !empty ( $hp_fullname ) && !empty ( $althp_fullname ) && !empty( $althp2_fullname) ) {
	$whatSet = 'all three';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. If I revoke the authority of my health proxy and first alternate health proxy or in the event that neither is willing, able, or reasonably available to make a health-care decision for me, I hereby appoint my second alternate health proxy.");
}
// else if two of three are set
else if ( !empty( $hp_fullname) && !empty($althp_fullname) && empty($althp2_fullname) ) {
	$whatSet = 'hp and alt';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( !empty( $hp_fullname) && empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'hp and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( empty($hp_fullname) && !empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'alt and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) && empty ( $althp2_fullname) ) {
	$whatSet = 'just hp';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me:" );
}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) && empty( $althp2_fullname) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me:" );
}
else if ( empty ( $hp_fullname) && empty( $althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'just 3rd';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make health-care decisions for me:" );
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
$pdf->Ln (10);
}

// _____________________________________ END HEALTH PROXY


// ===================================== BEGIN AGENT'S AUTHORITY
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Write(5, "Agent's Authority");
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'By this document I intend to create a durable power of attorney by appointing the person designated above to make health care decisions for me. This power of attorney shall not be affected by my subsequent incapacity.');
$pdf->Ln(7);
$pdf->Write(5, 'In the event that I am incapable of giving informed consent with respect to health care decisions, I hereby grant to the agent named above full power and authority: to make health care decisions for me before, or after my death, including consent, refusal of consent, or withdrawal of consent to any care, treatment, service, or procedure to maintain, diagnose, or treat a physical or mental condition; to request, review and receive any information, verbal or written, regarding my physical or mental health, including, without limitation, medical and hospital records; to execute on my behalf any releases or other documents that may be required to obtain medical care and/or medical and hospital records, EXCEPT any power to enter into any arbitration agreements or execute any arbitration clauses in connection with admission to any health care facility including any skilled nursing facility, and subject only to the limitations and special provisions, if any, set forth in this document.');
$pdf->Ln(9);

// LIMITATIONS
$pdf->SetFont('Arial', '', '14');
$pdf->Write(5, 'Special Provisions and Limitations');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', '10');
$pdf->Write(5, 'My health proxy, name above, is not permitted to consent to any of the following: commitment to or placement in a mental health treatment facility, convulsive treatment, psychosurgery, sterilization, or abortion.');
$pdf->Ln(7);
if ( !empty($limits_freetext) ) {
	$pdf->Write(5, 'In exercising the authority under this durable power of attorney for health care, the authority of my agent is subject to the following special provisions and limitations:');
	$pdf->Ln();
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$limits_freetext", 0, 'L');
	$pdf->Ln(7);
}	

// DURATION
$pdf->SetFont('Arial', '', '14');
$pdf->Write(5, 'Duration');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', '10');
$pdf->Write(5, 'I understand that this power of attorney will exist indefinitely from the date I execute this document unless I establish a shorter time. If I am unable to make health care decisions for myself when this power of attorney expires, the authority I have granted my attorney-in-fact will continue to exist until the time when I become able to make health care decisions for myself.');
if ( !empty($limits_expire) ) {
	$pdf->Ln(7);
	$pdf->Write(5, "I wish to have this power of attorney end on the following date: $limits_expire");
}

// STATEMENT OF DESIRES
$pdf->Ln(9);
$pdf->SetFont('Arial', '', '14');
$pdf->Write(5, 'Statement of Desires');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', '10');
if ( !empty($desires_set) ) {
	if ( in_array('lifeProlonged', $desires_set) ) {
		$pdf->Write(5, 'I desire that my life be prolonged to the greatest extent possible, without regard to my condition, the chances I have for recovery or long-term survival, or the cost of the procedures.');
		$pdf->Ln(7);
	}
	if ( in_array('coma', $desires_set) ) {
		$pdf->Write(5, 'If I am in a coma which my doctors have reasonably concluded is irreversible, I desire that life-sustaining or prolonging treatments not be used.');
		$pdf->Ln(7);
	}
	if ( in_array('incurable', $desires_set) ) {
		$pdf->Write(5, 'If I have an incurable or terminal condition or illness and no reasonable hope of long-term recovery or survival, I desire that life-sustaining or prolonging treatments not be used.');
		$pdf->Ln(7);
	}
	if ( in_array('artificialNutrition', $desires_set) ) {
		$pdf->Write(5, 'Withholding or withdrawal of artificial nutrition and hydration may result in death by starvation or dehydration. I want to receive or continue receiving artificial nutrition and hydration by way of the gastro-intestinal tract after all other treatment is withheld.');
		$pdf->Ln(7);
	}
	if ( in_array('benefits', $desires_set) ) {
		$pdf->Write(5, 'I do not desire treatment to be provided and/or continued if the burdens of the treatment outweigh the expected benefits. My attorney-in-fact is to consider the relief of suffering, the preservation or restoration of functioning, and the quality as well as the extent of the possible extension of my life.');
		$pdf->Ln(7);
	}
}
if ( !empty($other_freetext) ) {
	$pdf->Write(5, 'Other or additional statements of desires:');
	$pdf->Ln();
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$other_freetext", 0, 'L');
	$pdf->Ln(7);
}

$pdf->Write(5, 'I revoke any prior durable power of attorney for health care.');
$pdf->Ln(7);
$pdf->Write(5, 'If my designated agent is my spouse or is one of my children, then I waive any conflict of interest in carrying out the provisions of this Durable Power of Attorney for Health Care that said spouse or child may have by reason of the fact that he or she may be a beneficiary of my estate.');
$pdf->Ln(7);
$pdf->Write(5, 'If the legality of any provision of this durable power of attorney for health care is questioned by my physician, my agent or a third party, then my agent is authorized to commence an action for declaratory judgment as to the legality of the provision in question. The cost of any such action is to be paid from my estate. Durable power of attorney for health care must be construed and interpreted in accordance with the laws of the State of Nevada.');
$pdf->Ln(7);
$pdf->Write(5, 'If, after execution of this durable power of attorney for health care, incompetency proceedings are initiated either for my estate or my person, I hereby nominate as my guardian or conservator for consideration by the court my agent herein named, in the order named.');
$pdf->Ln(7);
$pdf->Write(5, 'I agree to, authorize and allow full release of information by any government agency, medical provider, business, creditor or third party who may have information pertaining to my health care, to my agent named herein, pursuant to the Health Insurance Portability and Accountability Act of 1996, Public Law 104-191, as amended, and applicable regulations.');
$pdf->Ln(9);

// STATEMENT OF DESIRES
$pdf->Ln(9);
$pdf->SetFont('Arial', '', '14');
$pdf->Write(5, 'Life-Sustaining Treatment');
$pdf->Ln(7);
$pdf->SetFont('Arial', '', '10');
$pdf->Write(5, 'If I should lapse into an incurable and irreversible condition that, without the administration of life-sustaining treatment, will, in the opinion of my attending physician, cause my death within a relatively short time (a terminal condition) and I am no longer able to make decisions regarding my medical treatment, I direct my attending physician, pursuant to the Nevada Uniform Act on the Rights of the Terminally Ill, to:');
if ( !empty($ls_set) ) {
	if ( in_array('lsNo', $ls_set) ) {
		$pdf->Write(5, 'Keep me comfortable and allow natural death to occur. I do not want any life-sustaining treatment or other medical interventions used to try to extend my life. I do not want to receive nutrition and fluids by tube or other medical means.');
		$pdf->Ln(7);
	}
	if ( in_array('lsFT', $ls_set) ) {
		$pdf->Write(5, 'Keep me comfortable and allow natural death to occur. I do not want any life-sustaining treatment or other medical interventions used to try to extend my life. If I am unable to take enough nourishment by mouth, however, I want to receive nutrition and fluids by tube or other medical means.');
		$pdf->Ln(7);
	}
	if ( in_array('lsYes', $ls_set) ) {
		$pdf->Write(5, 'Try to extend my life for as long as possible, using all available life-sustaining treatment or other medical interventions that in reasonable medical judgment would prevent or delay my death. If I am unable to take enough nourishment by mouth, I want to receive nutrition and fluids by tube or other medical means.');
		$pdf->Ln(7);
	}
} else {
	$pdf->Write(5, '_____________________________________________________________');
	$pdf->Ln(7);
}
$pdf->Write(5, 'Any questions regarding how to interpret or apply my declaration shall be resolved by my agent appointed under a durable power of attorney for health care, if I have appointed one.');
if ( !empty($ls_freetext) ) {
	$pdf->Write(5, "I further direct that: $ls_freetext");
}
$pdf->Ln(9);
// _____________________________________ END AGENT'S AUTHORITY



// ===================================== BEGIN ORGAN DONATION
if ( !empty($orgdon_set) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Regarding Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('refuseToDonate', $orgdon_set) ) {
		$pdf->Write(5, 'I do not want to make an organ or tissue donation, and I do not want my agent, guardian, or family to do so.');
		$pdf->Ln(7);
	} else if ( in_array('writtenSigned', $orgdon_set) ) {
		$pdf->Write(5, 'I have already signed a written agreement or donor card regarding organ and tissue donation with the following individual or institution:');
		if ( !empty($orgdon_signed_freetext) ) {
			$pdf->Write(5, " $orgdon_signed_freetext");
		} else {
			$pdf->Write(5, ' ______________________________');
		}
	} else {
		$pdf->Write(5, 'Pursuant to Nevada law, I hereby give, effective on my death ');
		if ( !empty($orgdon_wish_set) ) {
			if ( in_array('anyNeeded', $orgdon_wish_set) ) {
				$pdf->Write(5, 'any needed organ or parts.');
				$pdf->Ln(7);
			} else {
				$pdf->Write(5, 'the following parts or organs: ');
				if ( !empty($orgdon_wish_freetext) ) {
					$pdf->Write(5, "$orgdon_wish_freetext");
				} else {
					$pdf->Write(5, '_____________________________________________________');
				}
			}
			if ( !empty($orgdon_purp_set) ) {
				$pdf->Ln(5);
				$pdf->Write(5, 'My gift is for ');
				if ( in_array('anyPurpose', $orgdon_purp_set) ) {
					$pdf->Write(5, 'any legally authorized purpose.');
				} else {
					$pdf->Write(5, 'transplant or therapeutic purposes only.');
				}
			}
		}
	}
	$pdf->Ln(5);
}
// _____________________________________ END ORGAN DONATION



// ===================================== BEGIN LEGAL
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Execution of Document', 0, 1, 'L' );
$pdf->SetFont ( 'Arial', '', 10 );

// SIGNATURE
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Signature of Declarant');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'Signed _______________________________________________________');
$pdf->Ln(7);
$pdf->Write(5, 'Date ____________________________');
$pdf->Ln(7);
$pdf->Write(5, 'City, County, and State of Residence ________________________________________');
$pdf->Ln(7);
$pdf->Write(5, 'Address of the Declarant ____________________________________________________________________________________');
$pdf->Ln(7);

// WITNESSES
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Witnesses');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "I declare under penalty of perjury that the principal is personally known to me, that the principal signed or acknowledged this advance directive in my presence, and that the principal appears to be of sound mind and under no duress, fraud, or undue influence. I further declare that I am not the person appointed as agent by this document, and that I am not a provider of health care, an employee of a provider of health care, the operator of a community care facility, nor an employee of an operator of a health care facility.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);

// NOTARY
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Notary');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write ( 5, 'I,  _________________________________________________________, a licensed Notary Public, hereby certify that the principal named above appeared before me and swore to me and to the witnesses in my presence that this instrument is an advance directive document, and that he/she willingly and voluntarily made and executed it as his/her free act and deed for the purposes expressed in it. I further certify that  __________________________________  and  ________________________________________, witnesses, appeared before me and swore that they witnessed the principal named above sign the attached health care power of attorney, believing him/her to be of sound mind; and also swore that at the time they witnessed the signing (i) they were not related within the third degree to him/her or his/her spouse, and (ii) they did not know nor have a reasonable expectation they they would be entitled to any portion of his/her estate upon his/her death under any will or codicil thereto then existing or under the Intestate Succession Act as it provided at that time, and (iii) they were not a physician attending him/her, nor an employee of an attending physician, nor an employee of a health facility in which he/she was a patient, nor an employee of an nursing home or any group-care home in which he/she resided, and (iv) they did not have a claim against him/her. I further certify that I am satisfied as to the genuineness and due execution of the instrument.' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'This the  _________________  day of  ______________________, 20 ________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Country of  __________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'State of  _____________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Notary Public  _________________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'My commission Expires:  _________________________________________________' );
$pdf->Ln ( 8 );
// _____________________________________ END LEGAL



// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}
?>