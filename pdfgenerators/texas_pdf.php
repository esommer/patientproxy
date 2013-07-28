<?php
// TEXAS


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
	'hp_fullname' => 'healthProxy_personDataSet_fullName_fieldID',
	'hp_address' => 'healthProxy_personDataSet_streetAddress_fieldID',
	'hp_city' => 'healthProxy_personDataSet_city_fieldID',
	'hp_state' => 'healthProxy_personDataSet_usState_fieldID',
	'hp_zip' => 'healthProxy_personDataSet_zip_fieldID',
	'hp_phone' => 'healthProxy_personDataSet_dayPhone_fieldID',
	'hp_cellphone' => 'healthProxy_personDataSet_eveningPhone_fieldID',
	'hp_email' => 'healthProxy_personDataSet_email_fieldID',
	'althp_fullname' => 'alternate_personDataSet_fullName_fieldID',
	'althp_address' => 'alternate_personDataSet_streetAddress_fieldID',
	'althp_city' => 'alternate_personDataSet_city_fieldID',
	'althp_state' => 'alternate_personDataSet_usState_fieldID',
	'althp_zip' => 'alternate_personDataSet_zip_fieldID',
	'althp_phone' => 'alternate_personDataSet_dayPhone_fieldID',
	'althp_cellphone' => 'alternate_personDataSet_eveningPhone_fieldID',
	'althp_email' => 'alternate_personDataSet_email_fieldID',
	'althp2_fullname' => 'alternate_personDataSet2_fullName_fieldID',
	'althp2_address' => 'alternate_personDataSet2_streetAddress_fieldID',
	'althp2_city' => 'alternate_personDataSet2_city_fieldID',
	'althp2_state' => 'alternate_personDataSet2_usState_fieldID',
	'althp2_zip' => 'alternate_personDataSet2_zip_fieldID',
	'althp2_phone' => 'alternate_personDataSet2_dayPhone_fieldID',
	'althp2_cellphone' => 'alternate_personDataSet2_eveningPhone_fieldID',
	'althp2_email' => 'alternate_personDataSet2_email_fieldID',
	'limits_freetext' => 'limitations_freeTextElementSet_freeTextElement_fieldID',
	'location_text' => 'locationDuration_locationDurationSet_location_fieldID',
	'loc_name1' => 'locationDuration_institutions_name_fieldID',
	'loc_addr1' => 'locationDuration_institutions_address_fieldID',
	'loc_name2' => 'locationDuration_institutions_name2_fieldID',
	'loc_addr2' => 'locationDuration_institutions_address2_fieldID',
	'duration_date' => 'locationDuration_durationSet_duration_fieldID',
	'tc_set' => 'terminalCondition_terminalConditionSet_fieldID_SET', // discontinue, keptAlive
	'ic_set' => 'irreversibleCondition_irreversibleConditionSet_fieldID_SET', // discontinue, keptAlive
	'orgdon_set' => 'organDonation_wishRefuseToDonateSet_fieldID_SET', // refuseToDonate, writtenSigned, wishToDonate
	'orgdon_wish_set' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_organsSet_fieldID_SET', // anyNeeded, theFollowing
	'orgdon_wish_freetext' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_organsSet_theFollowing_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'orgdon_purp_set' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_purpose_fieldID_SET', // anyPurpose, therapeutic
	'orgdon_signed_freetext' => 'organDonation_wishRefuseToDonateSet_writtenSigned_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'addtl_freetext' => 'additionalRequests_freeTextElementSet_freeTextElement_fieldID'
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
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. If I revoke the authority of my health proxy and first alternate health proxy or in the event that neither is willing, able, or reasonably available to make a health-care decision for me, I hereby appoint my second alternate health proxy.");
}
// else if two of three are set
else if ( !empty( $hp_fullname) && !empty($althp_fullname) && empty($althp2_fullname) ) {
	$whatSet = 'hp and alt';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( !empty( $hp_fullname) && empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'hp and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( empty($hp_fullname) && !empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'alt and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician. If I revoke my health proxy's authority or in the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) && empty ( $althp2_fullname) ) {
	$whatSet = 'just hp';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician:" );
}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) && empty( $althp2_fullname) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician:" );
}
else if ( empty ( $hp_fullname) && empty( $althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'just 3rd';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physician:" );
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

if ( !empty($limits_freetext) ) {
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Limits');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, "Limitations on the decision-making authority of my health proxy are as follows: $limits_freetext");
	$pdf->Ln(7);
}
if ( !empty($location_text) || !empty($loc_name1) || !empty($loc_addr1) || !empty($loc_name2) || !empty($loc_addr2) ) {
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Location of Copies');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( !empty($location_text) ) {
		$pdf->Write(5, "The original of this document is kept at: $location_text");
		$pdf->Ln(7);
	}
	if ( !empty($loc_name1) || !empty($loc_addr1) || !empty($loc_name2) || !empty($loc_addr2) ) {
		$pdf->Write(5, 'The following individuals or institutions have signed copies of this document:');
		$pdf->Ln(7);
		if ( !empty($loc_name1) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, "Name: $loc_name1");
			$pdf->Ln();
		}
		if ( !empty($loc_addr1) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, "Name: $loc_addr1");
			$pdf->Ln();
		}
		if ( !empty($loc_name2) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, "Name: $loc_name2");
			$pdf->Ln();
		}
		if ( !empty($loc_addr2) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, "Name: $loc_addr2");
			$pdf->Ln();
		}
	}
$pdf->Ln(10);
}

$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Duration');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'I understand that this power of attorney exists indefinitely from the date I execute this document unless I establish a shorter time or revoke the power of attorney. If I am unable to make health care decisions for myself when this power of attorney expires, the authority I have granted my agent continues to exist until the time I become able to make health care decisions for myself.');
$pdf->Ln();
if ( !empty($duration_date) ) {
	$pdf->Write(5, "This power of attorney ends on the following date: $duration_date");
	$pdf->Ln(10);
} else {
	$pdf->Ln();
}

$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Prior Designations Revoked');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'I revoke any prior medical power of attorney.');
$pdf->Ln(10);
/*
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Acknowledgment of Disclosure Statement');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'I have been provided with a disclosure statement explaining the effect of this document. I have read and understood that information contained in the disclosure statement, and signed the acknowledgment on page 2 of this form prior to execution of this advance directive.');
*/
if ( !empty($ic_set) || !empty($tc_set) || !empty($addl_freetext) ) {
	$pdf->SetTextColor ( 0, 0, 0 );
	$pdf->SetFont ( 'Arial', 'B', '16' );
	$pdf->Cell ( 0, 5, 'Advance Directive', 0, 1, 'L' );
	$pdf->Ln ( 5 );
	$pdf->SetFont ( 'Arial', '', 10 );
	$pdf->Write(5, "I, $patient_full_name, recognize that the best health care is based upon a partnership of trust and communication with my physician. My physician and I will make health care decisions together as long as I am of sound mind and able to make my wishes known, If there comes a time that I am unable to make medical decisions about myself because of illness or injury, I direct that the following treatment preferences be honored:");
	$pdf->Ln(7);
	if ( !empty($tc_set) ) {
		$pdf->Write(5, 'If, in the judgment of my physician, I am suffering with a terminal condition from which I am expected to die within six months, even with available life-sustaining treatment provided in accordance with prevailing standards of medical care, ');
		if ( in_array('discontinue', $tc_set) ) {
			$pdf->Write(5,'I request that all treatments other than those needed to keep me comfortable be discontinued or withheld and my physician allow me to die as gently as possible.');
			$pdf->Ln();
		} else {
			$pdf->Write(5, 'I request that I be kept alive in this terminal condition using available life-sustaining treatment. This does not apply to hospice care.');
			$pdf->Ln();
		}
		$pdf->Ln(2);
	}
	if ( !empty($ic_set) ) {
		$pdf->Write(5, 'If, in the judgment of my physician, I am suffering with an irreversible condition so that I cannot care for myself or make decisions for myself and am expected to die without life-sustaining treatment provided in accordance with prevailing standards of care, ');
		if ( in_array('discontinue', $ic_set) ) {
			$pdf->Write(5,'I request that all treatments other than those needed to keep me comfortable be discontinued or withheld and my physician allow me to die as gently as possible.');
			$pdf->Ln();
		} else {
			$pdf->Write(5, 'I request that I be kept alive in this terminal condition using available life-sustaining treatment. This does not apply to hospice care.');
			$pdf->Ln();
		}
		$pdf->Ln(2);
	}
	if ( !empty($addtl_freetext) ) {
		$pdf->Write(5, "Additional Requests: $addtl_freetext");
	}
	$pdf->Ln(7);
}
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
		$pdf->Write(5, 'Pursuant to Texas law, I hereby give, effective on my death ');
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
$pdf->Write(5, "I am not the person appointed as agent by this document. I am not related to the principal by blood or marriage. I would not be entitled to any portion of the principal's estate on the principal's death. I am not the attending physician of the principal or an employee of the attending physician. I have no claim against any portion of the principal's estate on the principal's death. Furthermore, if I am an employee of a health care facility in which the principal is a patient, I am not involved in providing direct patient care to the principal and am not an officer, director, partner or business office employee of the health care facility of any parent organization of the health care facility.");
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