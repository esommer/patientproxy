<?php
// KENTUCKY

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
	'althp_fullname' => 'healthProxy_alternatePersonData_fullName_fieldID',
	'althp_address' => 'healthProxy_alternatePersonData_streetAddress_fieldID',
	'althp_city' => 'healthProxy_alternatePersonData_city_fieldID',
	'althp_state' => 'healthProxy_alternatePersonData_usState_fieldID',
	'althp_zip' => 'healthProxy_alternatePersonData_zip_fieldID',
	'althp_phone' => 'healthProxy_alternatePersonData_phone_fieldID',
	'althp_cellphone' => 'healthProxy_alternatePersonData_cellPhone_fieldID',
	'althp_email' => 'healthProxy_alternatePersonData_email_fieldID',
	'instr_freetext' => 'otherInstructions_freeTextElementSet_freeTextElement_fieldID',
	'prolong_set' => 'prolongLife_prolongLifeSet_fieldID_SET', // lpTreatment, lpTreatmentNo
	'nutrition_set' => 'nutrition_nutritionSet_fieldID_SET', // authorize, doNotAuthorize, authSurrogate
	'orgdon_set' => 'organDonation_wishRefuseToDonateSet_fieldID_SET', // wishToDonate, refuseToDonate
	'other_freetext' => 'otherDirections_freeTextElementSet_freeTextElement_fieldID'
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
// if both first proxy and alt proxy are set
if ( !empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
	$whatSet = 'both';
	$pdf->Write ( 5, "I, $patient_full_name, hereby appoint the following person as my health proxy to make health-care decisions on my behalf whenever I am incapable of making my own health-care decisions. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. " );
	}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) ) {
	$whatSet = 'just proxy';
	$pdf->Write ( 5, "I, $patient_full_name, hereby appoint the following person as my health proxy to make health-care decisions on my behalf whenever I am incapable of making my own health-care decisions. " );
	}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "I, $fullName, hereby appoint the following person as my health proxy to make health-care decisions on my behalf whenever I am incapable of making my own health-care decisions. " );
	}
$pdf->Ln ( 8 );
switch ( $whatSet ) {
	case ( 'both' ):
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
	case 'just proxy':
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
$pdf->Ln (10);	
}


// DESIGNATION OF POWERS
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'When making health-care decisions for me, my health proxy should think about what action would be consistent with past conversations we have had, my treatment preferences as expressed in this or any other document where I have recorded my wishes, my religious and other beliefs and values, and how I have handled medical and other important issues in the past. If what I would decide is still unclear, then my health proxy should make decisions for me that my health proxy believes are in my best interest, considering the benefits, burdens, and risks of my current circumstances and treatment options.');
$pdf->Ln(7);
$pdf->Write(5, 'I give the following instructions as further guidance to my surrogate:');
$pdf->Ln(5);
if ( !empty($instr_freetext) ) {
	$pdf->Cell(10, 5, '', 0, 0, 'R');
	$pdf->MultiCell(150, 5, "$instr_freetext", 0, 'L');
} else {
	$pdf->Cell(10, 5, '', 0, 0, 'R');
	$pdf->MultiCell(150, 5, '______________________________________________________________________________________________________________________________________________________', 0, 'L');
}
$pdf->Ln(7);
$pdf->Write(5, 'Any prior designation is revoked.');
$pdf->Ln(7);
// _____________________________________ END HEALTH PROXY



// ===================================== BEGIN INSTRUCTIONS
// HEALTH CARE INSTRUCTIONS
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Write(5, 'Health Care Instructions');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'My wishes regarding healthcare, life-prolonging treatment and artificially provided nutrition and hydration to be provided to me if I no longer have decisional capacity, have a terminal condition, or become permanently unconscious have been indicated by checking and initialing the appropriate lines below. If I do not designate a health proxy, the following are my directions to my attending physician. If I have designated a health proxy, my health proxy shall comply with my wishes as indicated below:');

// PROLONG LIFE
if ( !empty($prolong_set) ) {
	$pdf->Ln(9);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Life-Prolonging Treatment');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('lpTreatment', $prolong_set) ) {
		$pdf->Write(5, 'I direct that life-prolonging treatment be withheld or withdrawn, and that I be permitted to die naturally with only the administration of medication or the performance of any medical treatment deemed necessary to alleviate pain.');
	} else {
		$pdf->Write(5, 'I DO NOT authorize that life-prolonging treatment be withheld or withdrawn.');
	}
}

// NUTRITION
if ( !empty($nutrition_set) ) {
	$pdf->Ln(9);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Artificially-Provided Nutrition and Hydration');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('authorize', $nutrition_set) ) {
		$pdf->Write(5, 'I authorize the withholding or withdrawal of artificially provided food, water, or other artificially provided nourishment or fluids.');
	} else if ( in_array('doNotAuthorize', $nutrition_set) ) {
		$pdf->Write(5, 'I DO NOT authorize the withholding or withdrawal of artificially provided food, water, or other artificially provided nourishment or fluids.');
	} else {
		$pdf->Write(5, 'I authorize my health proxy, designated above, to withhold or withdraw artificially provided nourishment or fluids, or other treatment if the health proxy determines that withholding or withdrawing is in my best interest; but I do not mandate that withholding or withdrawing.');
	}
}

// ORGAN DONATION
if ( !empty($orgdon_set) ) {
	$pdf->Ln(9);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('refuseToDonate', $orgdon_set) ) {
		$pdf->Write(5, 'I DO NOT authorize the giving of all or any part of my body upon my death.');
	} else {
		$pdf->Write(5, 'I authorize the giving of all or any part of my body upon death for any purpose specified in KRS 311.185.');
	}
}

// OTHER DIRECTIONS
if ( !empty($other_freetext) ) {
	$pdf->Ln(9);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Other Instructions');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, "$other_freetext");
}

$pdf->Ln(9);
$pdf->Write(5, 'In the absence of my ability to give directions regarding the use of life-prolonging treatment and artificially-provided nutrition and hydration, it is my intention that this directive shall be honored by my attending physician, my family, and any health proxy designated pursuant to this directive as the final expression of my legal right to refuse medical or surgical treatment and I accept the consequences of the refusal.');
$pdf->Ln(7);
$pdf->Write(5, 'If I have been diagnosed as pregnant and that diagnosis is known to my attending physician, directions regarding life-prolonging treatments and artificially-provided nutrition and hydration in this directive shall have no force or effect during the course of my pregnancy.');
$pdf->Ln(7);
$pdf->Write(5, 'I understand the full meaning and significance of this directive, and I am emotionally and mentally competent to make this directive.');
// _____________________________________ END INSTRUCTIONS


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
$pdf->Write(5, "I, $patient_full_name, the principal and/or declarant, sign my name or direct another person to sign my name to this instrument, and do hereby declare to the undersigned witness(es) that I sign it willingly, and I execute it as my free and voluntary act for the purposes herein expressed, and that I am of sound mind, and under no constraint or undue influence. I understand the full importance of this declaration.");
$pdf->Ln(7);
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
$pdf->Write(5, "In our joint presence, the grantor, who is of sound mind and eighteen years of age, or older, voluntarily dated and signed this writing or directed it to be dated and signed for the grantor.");
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