<?php
// OKLAHOMA

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
	'term_set' => 'terminalCondition_lSSet_fieldID_SET', // lSYes, lSNo, lSMD
	'pers_set' => 'persistentlyUnconscious_lSSet_fieldID_SET', // lSYes, lSNo, lSMD
	'end_set' => 'endStageCondition_lSSet_fieldID_SET', // lSYes, lSNo, lSMD
	'gen_freetext' => 'generalInstructions_freeTextElementSet_freeTextElement_fieldID',
	'futher_freetext' => 'furtherDirections_freeTextElementSet_freeTextElement_fieldID',
	'donate_set' => 'furtherDirections_donate_fieldID_SET', // entireBody, followingOrgans
	'donate_freetext' => 'furtherDirections_donate_followingOrgans_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'donate_purpose' => 'furtherDirections_organPurpose_fieldID_SET' // transplantation, therapy, medicalScience, dentalScience
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



// ===================================== BEGIN LIVING WILL
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Living Will', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "If I, $patient_full_name, am incapable of making an informed decision regarding my health care, I direct my health are providers to follow my instructions below.");
$pdf->Ln(7);
$pdf->Write(5, "If my attending physician and another physician determine that I am no longer able to make decisions regarding my medical treatment, I direct my attending physician and other health care providers, pursuant to the Oklahoma Advance Directive Act, to follow my instructions as set forth below.");
$pdf->Ln(7);

// TERMINAL CONDITION
if ( !empty($term_set) ) {
	$pdf->Write(5, 'If I have a terminal condition, that is, an incurable and irreversible condition that even with the administration of life-sustaining treatment will, in the opinion of the attending physician and another physician, result in death within six (6) months:');
	$pdf->Ln();
	if ( in_array('lSYes', $term_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, except that if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	} else if ( in_array('lSNo', $term_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, including artificially administered nutrition and hydration.');
	} else {
		$pdf->Write(5, 'I direct that I be given life-sustaining treatment and, if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	}
	$pdf->Ln(7);
}

// PERSISTENTLY UNCONSCIOUS
if ( !empty($pers_set) ) {
	$pdf->Write(5, 'If I am persistently unconscious, that is, I have an irreversible condition, as determined by the attending physician and another physician, in which thought and awareness of self and environment are absent:');
	$pdf->Ln();
	if ( in_array('lSYes', $pers_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, except that if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	} else if ( in_array('lSNo', $pers_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, including artificially administered nutrition and hydration.');
	} else {
		$pdf->Write(5, 'I direct that I be given life-sustaining treatment and, if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	}
	$pdf->Ln(7);
}

// END STAGE CONDITION
if ( !empty($end_set) ) {
	$pdf->Write(5, 'If I have an end-stage condition, that is, a condition caused by injury, disease, or illness, which results in severe and permanent deterioration indicated by incompetency and complete physical dependency for which treatment of the irreversible condition would be medically ineffective:');
	$pdf->Ln();
	if ( in_array('lSYes', $end_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, except that if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	} else if ( in_array('lSNo', $end_set) ) {
		$pdf->Write(5, 'I direct that my life not be extended by life-sustaining treatment, including artificially administered nutrition and hydration.');
	} else {
		$pdf->Write(5, 'I direct that I be given life-sustaining treatment and, if I am unable to take food and water by mouth, I wish to receive artificially administered nutrition and hydration.');
	}
	$pdf->Ln(7);
}

//OTHER
if ( !empty($gen_freetext) ) {
	$pdf->Write(5, "Other Instructions: $gen_freetext");
	$pdf->Ln(7);
}
// _____________________________________ END LIVING WILL



// ===================================== BEGIN HEALTH PROXY
$pdf->Ln(9);
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
	$pdf->Write ( 5, "If my attending physician and another physician determine that I am no longer able to make decisions regarding my medical treatment, I direct my attending physician and other health care providers pursuant to the Oklahoma Advance Directive Act to follow the instructions of the health care proxy appointed below. If my health care proxy is unable unwilling, or not reasonably available to serve, I appoint my alternate health care proxy with the same authority." );
	}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) ) {
	$whatSet = 'just proxy';
	$pdf->Write ( 5, "If my attending physician and another physician determine that I am no longer able to make decisions regarding my medical treatment, I direct my attending physician and other health care providers pursuant to the Oklahoma Advance Directive Act to follow the instructions of the health care proxy appointed below." );
	}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "If my attending physician and another physician determine that I am no longer able to make decisions regarding my medical treatment, I direct my attending physician and other health care providers pursuant to the Oklahoma Advance Directive Act to follow the instructions of the health care proxy appointed below." );
	}
$pdf->Ln(7);
$pdf->Write(5, 'My health care proxy is authorized to make whatever medical treatment decisions I could make if I were able, except that decisions regarding life-sustaining treatment and artificially administered nutrition and hydration can be made by my health care proxy or alternate health care proxy only as I indicate in this document.');
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
$pdf->Ln (7);
}

$pdf->Write(5, 'If I have not designated a health care proxy, I am deliberately declining to designate a health care proxy.');
$pdf->Ln(7);
$pdf->Write(5, 'When making health-care decisions for me, my health care proxy should think about what action would be consistent with past conversations we have had, my treatment preferences as expressed in this document, my religious and other beliefs and values, and how I have handled medical and other important issues in the past. If what I would decide is still unclear, then my health care proxy should make decisions for me that my health care proxy believes are in my best interest, considering the benefits, burdens, and risks of my current circumstances and treatment options.');

if ( !empty($further_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, "I further direct that: $further_freetext");
}
$pdf->Ln (10);
// _____________________________________ END HEALTH PROXY



// ===================================== BEGIN ORGAN DONATION
if ( !empty($donate_set) ) {
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, 'Upon my death, I wish to donate');
	if ( in_array('entireBody', $donate_set) ) {
		$pdf->Write(5, ' my body for anatomical study if needed.');
	} else if ( in_array('followingOrgans', $donate_set) ) {
		$pdf->Write(5, ' any needed organs, tissues, or eyes.');
	} else {
		$pdf->Write(5, ' only the following organs, tissues, or eyes:');
		if ( !empty($donate_freetext) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			$pdf->MultiCell(150, 5, "$donate_freetext", 0, 'L');
		} else {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			$pdf->MultiCell(150, 5, '_____________________________________________________');
		}
	}
	$pdf->Ln(7);
	if ( !empty($donate_purpose) ) {
		$pdf->Write(5, 'I authorize the use of my organs, tissues, or eyes for:');
		$pdf->Ln();
		if ( in_array('transplantation', $donate_purpose) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Transplantation');
			$pdf->Ln();
		}
		if ( in_array('therapy', $donate_purpose) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Therapy');
			$pdf->Ln();
		}
		if ( in_array('medicalScience', $donate_purpose) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Advancement of medical science, research, or education');
			$pdf->Ln();
		}
		if ( in_array('dentalScience', $donate_purpose) ) {
			$pdf->Cell(10, 5);
			$pdf->Write(5, 'Advancement of dental science, research, or education');
		}
	}
}
// _____________________________________ END ORGAN DONATION



// ===================================== BEGIN LEGAL
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'General Provisions');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'a. I understand that I must be eighteen (18) years of age or older to execute this form.');
$pdf->Ln();
$pdf->Write(5, 'b. I understand that my witnesses must be eighteen (18) years of age or older and shall not be related to me and shall not inherit from me.');
$pdf->Ln();
$pdf->Write(5, 'c. I understand that if I have been diagnosed as pregnant and that diagnosis is known to my attending physician, I will be provided with life-sustaining treatment and artificially administered hydration and nutrition unless I have, in my own words, specifically authorized that during a course of pregnancy, life-sustaining treatment and/or artificially administered hydration and/or nutrition shall be withheld or withdrawn.');
$pdf->Ln();
$pdf->Write(5, 'd. In the absence of my ability to give directions regarding the use of life-sustaining procedures, it is my intention that this advance directive shall be honored by my family and physicians as the final expression of my legal right to choose or refuse medical or surgical treatment including, but not limited to, the administration of any life-sustaining procedures, and I accept the consequences of such choice or refusal.');
$pdf->Ln();
$pdf->Write(5, 'e. This advance directive shall be in effect until it is revoked.');
$pdf->Ln();
$pdf->Write(5, 'f. I understand that I may revoke this advance directive at any time.');
$pdf->Ln();
$pdf->Write(5, 'g. I understand and agree that if I have any prior directives, and if I sign this advance directive, my prior directives are revoked.');
$pdf->Ln();
$pdf->Write(5, 'h. I understand the full importance of this advance directive and I am emotionally and mentally competent to make this advance directive.');
$pdf->Ln();
$pdf->Write(5, "i. I understand that my physician(s) shall make all decisions based upon his or her best judgment applying with ordinary care and diligence the knowledge and skill that is possessed and used by members of the physician's profession in good standing engaged in the same field of practice at that time, measured by national standards.");
$pdf->Ln(9);

// SIGNATURE
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
$pdf->Write(5, "This advance directive was signed in my presence.");
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
// _____________________________________ END LEGAL



// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}
?>
