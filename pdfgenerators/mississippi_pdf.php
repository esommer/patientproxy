<?php
// MISSISSIPPI

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
	'limits_immediate' => 'limitations_immediateSet_fieldID_SET', // immediate
	'prolong_set' => 'prolongLife_prolongLifeSet_fieldID_SET', // prolongLifeNo, prolongLifeYes
	'nutrition_set' => 'nutrition_nutritionSet_fieldID_SET', // artificialNutrition
	'relief_freetext' => 'relief_freeTextElementSet_freeTextElement_fieldID',
	'other_freetext' => 'otherWishes_freeTextElementSet_freeTextElement_fieldID',
	'pcp_fullname' => 'primaryCarePhysician_doctorData_fullName_fieldID',
	'pcp_address' => 'primaryCarePhysician_doctorData_streetAddress_fieldID',
	'pcp_city' => 'primaryCarePhysician_doctorData_city_fieldID',
	'pcp_state' => 'primaryCarePhysician_doctorData_usState_fieldID',
	'pcp_zip' => 'primaryCarePhysician_doctorData_zip_fieldID',
	'pcp_phone' => 'primaryCarePhysician_doctorData_phone_fieldID',
	'pcp2_fullname' => 'primaryCarePhysician_otherDoctorData_fullName_fieldID',
	'pcp2_addres' => 'primaryCarePhysician_otherDoctorData_streetAddress_fieldID',
	'pcp2_city' => 'primaryCarePhysician_otherDoctorData_city_fieldID',
	'pcp2_state' => 'primaryCarePhysician_otherDoctorData_usState_fieldID',
	'pcp2_zip' => 'primaryCarePhysician_otherDoctorData_zip_fieldID',
	'pcp2_phone' => 'primaryCarePhysician_otherDoctorData_phone_fieldID',
	'orgdon_set' => 'organDonation_donate_fieldID_SET', // entireBody, anyNeeded, followingOrgans
	'orgdon_list_freetext' => 'organDonation_donate_followingOrgans_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'orgdon_auth_freetext' => 'organDonation_authoritySet_freeTextElement_fieldID',
	'orgdon_purp_set' => 'organDonation_organPurpose_fieldID_SET' // transplantation, therapy, research, medicalScience, anyPurpose
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

// LIMITS
$pdf->Write(5, 'My health proxy is authorized to make all health-care decisions for me, including decisions to provide, withhold, or withdraw artificial nutrition and hydration, and all other forms of health care to keep me alive');
if ( !empty($limits_freetext) ) {
	$pdf->Write(5, ', except as I state here:');
	$pdf->Ln();
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$limits_freetext", 0, 'L');
} else {
	$pdf->Write(5, '.');
}

// WHEN EFFECTIVE
$pdf->Ln(7);
if ( !empty($limits_immediate) ) {
	$pdf->Write(5, "My health proxy's authority to make health-care decisions for me takes effect immediately.");
} else {
	$pdf->Write(5, "My health proxy's authority becomes effective when my primary physician determines that I am unable to make my own health-care decisions.");
}

// GUARDIANSHIP
$pdf->Ln(7);
$pdf->Write(5, 'My health proxy shall make health-care decisions for me in accordance with this power of attorney for health care, any instructions I give in this document, and my other wishes to the extent known to my health proxy. To the extent my wishes are unknown, my health proxy shall make health-care decisions for me in accordance with what my health proxy determines to be in my best interest. In determining my best interest, my health proxy shall consider my personal values to the extent known to my health proxy.');
$pdf->Ln(7);
$pdf->Write(5, 'If a guardian of my person needs to be appointed for me by a court, I nominate the health proxy designated in this form. If that health proxy is not willing, able, or reasonably available to act as guardian, I nominate the alternate health proxies whom I have named, in the order designated.');

// PROLONG
if ( !empty($prolong_set) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'In regard to end-of-life decisions, ');
	if ( in_array('prolongLifeNo', $prolong_set) ) {
		$pdf->Write(5, 'I do not want my life to be prolonged if:');
		$pdf->Ln();
		$pdf->Cell(10, 5);
		$pdf->MultiCell(150, 5, '(i) I have an incurable and irreversible condition that will result in my death within a relatively short time,', 0, 'L');
		$pdf->Cell(10, 5);
		$pdf->MultiCell(150, 5, '(ii) I become unconscious and, to a reasonable degree of medical certainty, I will not regain consciousness, or ', 0, 'L');
		$pdf->Cell(10, 5);
		$pdf->MultiCell(150, 5, '(iii) the likely risks and burdens of treatment would outweigh the expected benefits.', 0, 'L');
	} else {
		$pdf->Write(5, 'I want my life to be prolonged as long as possible within the limits of generally accepted health-care standards.');
	}
}

// NUTRITION
if ( !empty($nutrition_set) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'Artificial nutrition and hydration must be provided regardless of my condition and regardless of my end-of-life decision wishes.');
} else {
	$pdf->Ln(7);
	$pdf->Write(5, 'Artificial nutrition and hydration must be provided, withheld or withdrawn in accordance with my wishes for end-of-life care.');
}

// PAIN RELIEF
$pdf->Ln(7);
$pdf->Write(5, 'I direct that treatment for alleviation of pain or discomfort be provided at all times, even if it hastens my death');
if ( !empty($relief_freetext) ) {
	$pdf->Write(5, ', with the following exceptions:');
	$pdf->Ln();
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$relief_freetext", 0, 'L');
} else {
	$pdf->Write(5, '.');
}

// OTHER WISHES
if ( !empty($other_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, "I further direct that: $other_freetext");
}

// COPY
$pdf->Ln(7);
$pdf->Write(5, 'A copy of this form has the same effect as the original.');

// PHYSICIAN
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Primary Care Physician');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$whatSet2 = '';
// if both physicians set
if ( !empty ( $pcp_fullname ) && !empty ( $pcp2_fullname ) ) {
	$whatSet2 = 'both';
	$pdf->Write ( 5, 'I designate the following physician as my primary physician. If the physician I have designated is not willing, able, or reasonably available to act as my primary physician, I designate the following alternate physician as my primary physician.' );
	}
// else if at least one is set
else if ( !empty ( $pcp_fullname ) && empty ( $pcp2_fullname ) ) {
	$whatSet2 = 'just first';
	$pdf->Write ( 5, 'I designate the following physician as my primary physician.' );
	}
else if ( empty ( $pcp_fullname ) && !empty ( $pcp2_fullname ) ) {
	$whatSet2 = 'just second';
	$pdf->Write ( 5, 'I designate the following physician as my primary physician.' );
	}
$pdf->Ln ( 8 );
switch ( $whatSet2 ) {
	case 'both':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, 'Primary Physician' );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Physician' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// names
		$pdf->Cell ( 25, 5 );
		$pdf->Cell ( 50, 5, "$pcp_fullname" );
		$pdf->Cell ( 20, 5 );
		$pdf->Cell ( 50, 5, "$pcp2_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($pcp_address) || !empty($pcp2_address) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$pcp_address" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($pcp_city) || !empty($pcp_state) || !empty($pcp_zip) || !empty($pcp2_city) || !empty($pcp2_state) || !empty($pcp2_zip) ) {
			$pdf->Cell ( 25, 5 );
			if ( !empty($pcp_city) && !empty($pcp_state) ) {
				// only want comma if city AND state are there
				$pdf->Cell ( 50, 5, "$pcp_city, $pcp_state $pcp_zip" );
			} else {
				$pdf->Cell (50, 5, "$pcp_city $pcp_state $pcp_zip" );
			}
			$pdf->Cell ( 20, 5 );
			if ( !empty($pcp2_city) && !empty($pcp2_state) ) {
				$pdf->Cell ( 50, 5, "$pcp2_city, $pcp2_state $pcp2_zip" );
			} else {
				$pdf->Cell ( 50, 5, "$pcp2_city $pcp2_state $pcp2_zip" );
			}
			$pdf->Ln();
		}
		// phones
		if ( !empty($pcp_phone) || !empty($pcp2_phone) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$pcp_phone" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_phone" );
			$pdf->Ln();
		}
		break;
	case 'just first':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Primary Physician' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// name
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$pcp_fullname" );
		$pdf->Ln();
		// street
		if ( !empty($pcp_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp_address" );
			$pdf->Ln();
		}
		// city, state zip
		if ( !empty($pcp_city) && !empty($pcp_state) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp_city, $pcp_state $pcp_zip" );
			$pdf->Ln();
		} else {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp_city $pcp_state $pcp_zip" );
			$pdf->Ln();
		}
		// phone
		if ( !empty($pcp_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp_phone" );
			$pdf->Ln();
		}
		break;
	case 'just second':
		// heading
		$pdf->SetFont ( 'Arial', 'B', 12 );
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Primary Physician' );
		$pdf->Ln ( 6 );
		$pdf->SetFont ( 'Arial', '', 10 );
		// name
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$pcp2_fullname" );
		$pdf->Ln();
		// street
		if ( !empty($pcp2_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_address" );
			$pdf->Ln();
		}
		// city, state zip
		if ( !empty($pcp2_city) && !empty($pcp2_state) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_city, $pcp2_state $pcp2_zip" );
			$pdf->Ln();
		} else {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_city $pcp2_state $pcp2_zip" );
			$pdf->Ln();
		}
		// phone
		if ( !empty($pcp2_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$pcp2_phone" );
			$pdf->Ln();
		}
		break;
}

if ( !empty($orgdon_set) ) {
	$pdf->Ln(9);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, 'Upon my death, I wish to donate');
	if ( in_array('entireBody', $orgdon_set) ) {
		$pdf->Write(5, ' my body for anatomical study if needed.');
	} else if ( in_array('anyNeeded', $orgdon_set) ) {
		$pdf->Write(5, ' any needed organs, tissues, or eyes.');
	} else {
		$pdf->Write(5, ' only the following organs, tissues, or eyes:');
		if ( !empty($orgdon_list_freetext) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			$pdf->MultiCell(150, 5, "$orgdon_list_freetext", 0, 'L');
		} else {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			$pdf->MultiCell(150, 5, '_____________________________________________________');
		}
	}
	$pdf->Ln(7);
	if ( !empty($orgdon_purp_set) ) {
		$pdf->Write(5, 'I authorize the use of my organs, tissues, or eyes for:');
		$pdf->Ln();
		if ( in_array('transplantation', $orgdon_purp_set) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Transplantation');
			$pdf->Ln();
		}
		if ( in_array('therapy', $orgdon_purp_set) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Therapy');
			$pdf->Ln();
		}
		if ( in_array('research', $orgdon_purp_set) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Research');
			$pdf->Ln();
		}
		if ( in_array('medicalScience', $orgdon_purp_set) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Medical Science');
			$pdf->Ln();
		}
		if ( in_array('anyPurpose', $orgdon_purp_set) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Any purpose authorized by law');
		}
	}
}
if ( !empty($orgdon_auth_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'This authority granted to my patient advocate to make an anatomical gift is limited as follows:');
	$pdf->Ln();
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$orgdon_auth_freetext", 0, 'L');
}
	
// _____________________________________ END AGENT AUTHORITY



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
$pdf->Write(5, "I declare under penalty of perjury pursuant to Section 97-9-61, Mississippi Code of 1972, that the principal is personally known to me, that the principal signed or acknowledged this advance directive in my presence, that the principal appears to be of sound mind and under no duress, fraud or undue influence, that I am not the person appointed as agent by this document, and that I am not a health-care provider, nor an employee of a health-care provider or facility. I am not related to the principal by blood, marriage or adoption, and to the best of my knowledge, I am not entitled to any part of the estate of the principal upon the death of the principal under a will now existing or by operation of law.");
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