<?php
// KANSAS


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
	'instr_freetext' => 'instructions_instructionsSet_freeTextElement_fieldID',
	'prohib_freetext' => 'limitations_prohibitionsSet_freeTextElement_fieldID',
	'limit_freetext' => 'limitations_limitationsSet_freeTextElement_fieldID',
	'further_freetext' => 'furtherDirections_furtherDirectionsSet_freeTextElement_fieldID',
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

// _____________________________________ END HEALTH PROXY



// ===================================== BEGIN DECLARATION OF WISHES
// POWERS GRANTED
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Powers Granted to my Health Proxy');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "I, $patient_full_name, designate and appoint the above-named health proxy or, in the event the person I appoint above is unable, unwilling or unavailable to serve, I appoint the above-named alternate health proxy to be my agent for health care decisions and pursuant to the language stated below, on my behalf to:");
$pdf->Ln(7);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(1) Consent, refuse consent, or withdraw consent to any care, treatment, service, or procedure to maintain, diagnose, or treat a physical or mental condition, and to make decisions about organ donation, autopsy, and disposition of the body;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(2) make all necessary arrangements at any hospital, psychiatric hospital or psychiatric treatment facility, hospice, nursing home or similar institution; to employ or discharge health care personnel, to include physicians, psychiatrists, psychologists, dentists, nurses, therapists, or any other person who is licensed, certified, or otherwise authorized or permitted by the laws of this state to administer health care, as the agent shall deem necessary for my physical, mental, and emotional well being; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(3) request, receive, and review any information, verbal or written, regarding my personal affairs or physical or mental health, including medical and hospital records, and to execute any releases of other documents that may be required in order to obtain such information.', 0, 'L');

if ( !empty($instr_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'In exercising the grant of authority set forth above my agent for health care decisions shall:');
	$pdf->Ln(5);
	$pdf->Write(5, "$instr_freetext");
}

// LIMITATIONS & PROHIBITIONS
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Limitations of Authority');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'The powers of the agent herein shall be limited to the extent set out in writing in this durable power of attorney for health care decisions, and by my wishes setout in this document, and shall not include the power to revoke or invalidate any previously existing declaration made in accordance with the Natural Death Act.');
if ( !empty($prohib_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'The agent shall be prohibited from authorizing consent for the following items:');
	$pdf->Ln(5);
	$pdf->Cell(10, 5, '', 0, 0, 'R');
	$pdf->MultiCell(160, 5, "$prohib_freetext", 0, 'L');
}
if ( !empty($limit_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'This durable power of attorney for health care decisions shall be subject to the additional following limitations:');
	$pdf->Ln(5);
	$pdf->Cell(10, 5, '', 0, 0, 'R');
	$pdf->MultiCell(160, 5, "$limit_freetext", 0, 'L');
}

// EFFECTIVE TIME
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Effective Time');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'This power of attorney for health care decisions shall become effective upon my disability or incapacity.');

// REVOCATION
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Revocation');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'Any durable power of attorney for health care decisions I have previously made is hereby revoked.');

// DECLARATION
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Declaration');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "I, $patient_full_name, being of sound mind, willfully and voluntarily make known my desire that my dying shall not be artificially prolonged under the circumstances set forth below, and do hereby declare:");
$pdf->Ln(5);
$pdf->Write(5, 'If at any time I should have an incurable injury, disease, or illness certified to be a terminal condition by two physicians who have personally examined me, one of whom shall be my attending physician, and the physicians have determined that my death will occur whether or not life-sustaining procedures are utilized, and where the application of life-sustaining procedures would serve only to artificially prolong the dying process, I direct that such procedures be withheld or withdrawn, and that I be permitted to die naturally with only the administration of medication or the performance of any medical procedure deemed necessary to provide me with comfort care.');

// FURTHER DIRECTIONS
if ( !empty($further_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'I further direct that:');
	$pdf->Ln(5);
	$pdf->Cell(10, 5, '', 0, 0, 'R');
	$pdf->Write(5, "$further_freetext");
}
$pdf->Ln(7);
$pdf->Write(5, 'In the absence of my ability to give directions regarding the use of such life-sustaining procedures, it is my intention that this declaration shall be honored by my agent (if any), family, and physician(s) as the final expression of my legal right to refuse medical or surgical treatment and accept the consequences from such refusal.');
// _____________________________________ END DECLARATION OF WISHES


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
		$pdf->Write(5, 'Pursuant to Kansas law, I hereby give, effective on my death ');
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
$pdf->Write(5, 'I understand the full importance of this document and I am emotionally and mentally competent to appoint an agent and/or make this declaration.');
$pdf->Ln(7);
$pdf->Write(5, 'Signed _______________________________________________________');
$pdf->Ln(7);
$pdf->Write(5, 'Date ____________________________');
$pdf->Ln(7);
$pdf->Write(5, 'City, County, and State of Residence ________________________________________');
$pdf->Ln(7);

// WITNESSES
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Witness 1');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "The declarant has been personally known to me and I believe him or her to be of sound mind. I did not sign the declarant's signature above for or at the direction of the declarant. I am not appointed above as the declarant's agent. I am not related to the declarant by blood or marriage, entitled to any portion of the estate of the declarant according to the laws of interstate succession or under any will of declarant or codicil thereto, or directly financially responsible for the declarant's medical care.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness Address: ________________________________________________________________');
$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Witness 2');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "The declarant has been personally known to me and I believe him or her to be of sound mind. I did not sign the declarant's signature above for or at the direction of the declarant. I am not appointed above as the declarant's agent. I am not related to the declarant by blood or marriage, entitled to any portion of the estate of the declarant according to the laws of interstate succession or under any will of declarant or codicil thereto, or directly financially responsible for the declarant's medical care.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness Address: ________________________________________________________________');
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