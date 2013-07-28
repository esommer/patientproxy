<?php
// WISCONSIN

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
	'patient_address' => 'patientInfo_patientData_streetAddress_fieldID',
	'patient_city' => 'patientInfo_patientData_city_fieldID',
	'patient_zip' => 'patientInfo_patientData_zip_fieldID',
	'hp_fullname' => 'healthProxy_personData_fullName_fieldID',
	'hp_address' => 'healthProxy_personData_streetAddress_fieldID',
	'hp_city' => 'healthProxy_personData_city_fieldID',
	'hp_state' => 'healthProxy_personData_usState_fieldID',
	'hp_zip' => 'healthProxy_personData_zip_fieldID',
	'althp_fullname' => 'healthProxy_alternatePersonData_fullName_fieldID',
	'althp_address' => 'healthProxy_alternatePersonData_streetAddress_fieldID',
	'althp_city' => 'healthProxy_alternatePersonData_city_fieldID',
	'althp_state' => 'healthProxy_alternatePersonData_usState_fieldID',
	'althp_zip' => 'healthProxy_alternatePersonData_zip_fieldID',
	'nursing_set' => 'nursingHome_nursingHomeSet_fieldID_SET', // radioYes, radioNo
	'residence_set' => 'nursingHome_communityResidence_fieldID_SET', // radioYes, radioNo
	'feeding_set' => 'feedingTube_feedingTubeRadio_fieldID_SET', // radioYes, radioNo
	'pregnant_set' => 'pregnantWomen_pregnantWomenRadio_fieldID_SET', // radioYes, radioNo
	'statement_freetext' => 'statementDesires_desiresLimitsFieldset_desiresLimitations_fieldID',
	'disclosure_set' => 'physicalMentalDisclosure_physicalMentalRadioSet_fieldID_SET', // requestReview, executeDocs, consentDisclosure
	'terminal_set' => 'terminalCondition_terminalConditionRadioSet_fieldID_SET', // terminalRadioYes, terminalRadioNo
	'pvslife_set' => 'pvsLifeTube_pvsLifeRadio_fieldID_SET', // pvsLifeRadioYes, pvsLifeRadioNo
	'pvstube_set' => 'pvsLifeTube_pvsTubeRadio_fieldID_SET', // pvsTubeRadioYes, pvsTubeRadioNo
	'organ_set' => 'organDonation_organDonationSet_fieldID_SET', // wishToDonate, anyOrgan, refuseToDonate
	'organs_freetext' => 'organDonation_organDonationSet_wishToDonate_fieldID_specifyOrganSet_specifyOrgans_fieldID',
	'anatomical_set' => 'organDonation_anatomicalStudySet_fieldID_SET' // anatomicalStudy
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
$pdf->Cell ( 0, 5, 'Wisconsin Power of Attorney for Health Care', 0, 1, 'L' );
$pdf->Ln ( 3 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "I, $patient_full_name, of $patient_address $patient_city, $patient_us_state_abbrev $patient_zip, born $patient_birth_date, being of sound mind, intend by this document to create a power of attorney for health care. My executing this power of attorney for health care is voluntary. Despite the creation of this power of attorney for health care, I expect to be fully informed about and allowed to participate in any health care decision for me, to the extent that I am able. For the purposes of this document, 'health care decision' means an informed decision to accept, maintain, discontinue or refuse any care, treatment, service or procedure to maintain, diagnose or treat my physical or mental condition. In addition, I may, by this document, specify my wishes with respect to making an anatomical gift upon my death.");
$pdf->Ln(9);


$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Designation of Health Care Agent', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);



// APPOINT PROXY & ALTERNATE
$whatSet = '';
// if both first proxy and alt proxy are set
if ( !empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
	$whatSet = 'both';
	$pdf->Write ( 5, "If I am no longer able to make health care decisions for myself, due to my incapacity, I hereby designate the following person as my health proxy to make health-care decisions on my behalf. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. " );
	}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) ) {
	$whatSet = 'just proxy';
	$pdf->Write ( 5, "If I am no longer able to make health care decisions for myself, due to my incapacity, I hereby designate the following person as my health proxy to make health-care decisions on my behalf. " );
	}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "If I am no longer able to make health care decisions for myself, due to my incapacity, I hereby designate the following person as my health proxy to make health-care decisions on my behalf. " );
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
$pdf->Ln(7);
}

$pdf->Write(5, 'Neither my health care agent nor my alternate health care agent whom I have designated is my health care provider, an employee of my health care provider, an employee of a health care facility in which I am a patient or a spouse of any of those persons, unless he or she is also my relative. For purposes of this document, "incapacity" exists if 2 physicians or a physician and a psychologist who have personally examined me sign a statement that specifically expresses their opinion that I have a condition that means that I am unable to receive and evaluate information effectively or to communicate decisions to such an extent that I lack the capacity to manage my health care decisions. A copy of that statement must be attached to this document.');
$pdf->Ln(9);
// _____________________________________ END HEALTH PROXY

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'General Statement of Authority Granted', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, 'Unless I have specified otherwise in this document, if I ever have incapacity I instruct my health care provider to obtain the health care decision of my health care agent, if I need treatment, for all of my health care and treatment. I have discussed my desires thoroughly with my health care agent and believe that he or she understands my philosophy regarding the health care decisions I would make if I were able. I desire that my wishes be carried out through the authority given to my health care agent under this document.');
$pdf->Ln(7);
$pdf->Write(5, 'If I am unable, due to my incapacity, to make a health care decision, my health care agent is instructed to make the health care decision for me, but my health care agent should try to discuss with me any specific proposed health care if I am able to communicate in any manner, including by blinking my eyes. If this communication cannot be made, my health care agent shall base his or her decision on any health care choices that I have expressed prior to the time of the decision. If I have not expressed a health care choice about the health care in question and communication cannot be made, my health care agent shall base his or her health care decision on what he or she believes to be in my best interest.');
$pdf->Ln(9);

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Limitations on Mental Health Treatment', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, 'My health care agent may not admit or commit me on an inpatient basis to an institution for mental diseases, an intermediate care facility for the mentally retarded, a state treatment facility or a treatment facility. My health care agent may not consent to experimental mental health research or psychosurgery, electroconvulsive treatment or other drastic mental health treatment procedures for me.');
$pdf->Ln(9);

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Admission to Nursing Homes or Community-Based Residential Facilities', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, 'My health care agent may admit me to a nursing home or community- based residential facility for short -term stays for recuperative care or respite care.');
if ( !empty( $nursing_set ) ) {
	 if ( in_array('radioYes', $nursing_set) ) {
	 	$pdf->Write(5, ' My health care agent may admit me to a nursing home for a purpose other than recuperative care or respite care.');
	 } else {
	 	$pdf->Write(5, ' My health care agent may not admit me to a nursing home for a purpose other than recuperative care or respite care.');
	 }
} else {
	$pdf->Write(5, ' My health care agent may only admit me to a nursing home for short-term stays for recuperative care or respite care.');
}
if ( !empty( $residence_set ) ) {
	 if ( in_array('radioYes', $residence_set) ) {
	 	$pdf->Write(5, ' My health care agent may admit me to a community-based residential facility for a purpose other than recuperative care or respite care.');
	 } else {
	 	$pdf->Write(5, ' My health care agent may not admit me to a community-based residential facility for a purpose other than recuperative care or respite care.');
	 }
} else {
	$pdf->Write(5, ' My health care agent may only admit me to a community-based residential facility for short-term stays for recuperative care or respite care.');
}
$pdf->Ln(9);

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Provision of a Feeding Tube', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, 'My health care agent may not have orally ingested nutrition or hydration withheld or withdrawn from me unless provision of the nutrition or hydration is medically contraindicated.');
if ( !empty($feeding_set) ) {
	if ( in_array('radioYes', $feeding_set) ) {
		$pdf->Write(5, ' My health care agent may have a feeding tube withheld or withdrawn from me, unless my physician has advised that, in his or her professional judgment, this will cause me pain or will reduce my comfort.');
	} else {
		$pdf->Write(5, ' My health care agent may not have a feeding tube withheld or withdrawn from me.');
	}
} else {
	$pdf->Write(5, ' My health care agent may not have a feeding tube withdrawn from me.');
}
$pdf->Ln(9);

if ( !empty($pregnant_set) ) {
$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Health Care Decisions for Pregnant Women', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
	if ( in_array('radioYes', $pregnant_set) ) {
		$pdf->Write(5, 'My health care agent may make health care decisions for me even if my agent knows I am pregnant.');
	} else {
		$pdf->Write(5, 'My health care agent may not make health care decisions for me if my health care agent knows I am pregnant.');
	}
$pdf->Ln(9);
}

if ( !empty ( $statement_freetext ) ) {
	$pdf->SetFont( 'Arial', '', '14' );
	$pdf->Cell ( 0, 5, 'Statement of Desires, Special Provisions or Limitations', 0, 1, 'L');
	$pdf->Ln(3);
	$pdf->SetFont( 'Arial', '', 10);
	$pdf->Write(5, 'In exercising authority under this document, my health care agent shall act consistently with my following stated desires, if any, and is subject to any special provisions or limitations that I specify. The following are specific desires, provisions or limitations that I wish to state:');
	$pdf->Ln();
	$pdf->Cell(5, 10);
	$pdf->Write(5, "$statement_freetext");
	$pdf->Ln(9);
}

if ( !empty($disclosure_set) ) {
	$pdf->SetFont( 'Arial', '', '14' );
	$pdf->Cell ( 0, 5, 'Disclosure of Information Relating to my Physical or Mental Health', 0, 1, 'L');
	$pdf->Ln(3);
	$pdf->SetFont( 'Arial', '', 10);
	$pdf->Write(5,'Subject to any limitations in this document, my health care agent has the authority to do all of the following:');
	if ( in_array('requestReview', $disclosure_set) ) {
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, 'Request, review and receive any information, oral or written, regarding my physical or mental health, including medical and hospital records.');
	}
	if ( in_array('executeDocs', $disclosure_set) ) {
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, 'Execute on my behalf any documents that may be required in order to obtain this information.');
	}
	if ( in_array ('consentDisclosure', $disclosure_set ) ) {
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, 'Consent to the disclosure of this information.');
	}
	$pdf->Ln(9);
}

// ORGAN DONATION
if ( !empty($organ_set) || !empty($organs_freetext) || !empty($anatomical_set) ) {
	$pdf->SetFont( 'Arial', '', '14' );
	$pdf->Cell ( 0, 5, 'Organ Donation', 0, 1, 'L');
	$pdf->Ln(3);
	$pdf->SetFont( 'Arial', '', 10);
	$pdf->Write(5, 'Upon my death:');
	$pdf->Ln();
	if ( in_array('wishToDonate', $organ_set) || !empty($organs_freetext) ) {
		$pdf->Write(5, 'I wish to donate only the following organs or parts:');
		if ( !empty( $organs_freetext) ) {
			$pdf->Write( 5, " $organs_freetext");
		} else {
			$pdf->Write(5, '___________________________________________________');
		}
	} else if ( in_array('anyOrgan', $organ_set) ) {
		$pdf->Write(5, 'I wish to donate any needed organ or part.');
	} else {
		$pdf->Write(5, 'I refuse to make an anatomical gift. (If this revokes a prior commitment that I have made to make an anatomical gift to a designated donee, I will attempt to notify the donee to which or to whom I agreed to donate.)');
	}
	$pdf->Ln();
	if ( !empty($anatomical_set) ) {
		$pdf->Write(5, 'I wish to donate my body for anatomical study if needed.');
	}
	$pdf->Ln(10);
}

$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Declarations to Physicians', 0, 1, 'L' );
$pdf->Ln ( 3 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "I, $patient_full_name, being of sound mind, voluntarily state my desire that my dying not be prolonged under the circumstances specified in this document. Under those circumstances, I direct that I be permitted to die naturally. If I am unable to give directions regarding the use of life-sustaining procedures or feeding tubes, I intend that my family and physician honor this document as the final expression of my legal right to refuse medical or surgical treatment.");
$pdf->Ln(7);
$pdf->Write(5, "Automatic revocation under Wis. Stat. § 155.40(2) of the Power of Attorney for Health Care due to the principal's divorce, annulment of marriage, or termination of domestic partnership with his or her health care agent shall have no effect on this Declaration to Physicians, which shall survive the invalidation of the Power of Attorney for Health Care.");
$pdf->Ln(9);

$pdf->Write(5, 'If I have a TERMINAL CONDITION, as determined by two physicians who have personally examined me, I do not want my dying to be artificially prolonged and I do not want life-sustaining procedures to be used.');
if ( !empty( $terminal_set ) ) {
	$pdf->Write(5, 'In addition, the following are my directions regarding the use of feeding tubes:');
	if ( in_array('terminalRadioYes', $terminal_set ) ) {
		$pdf->Write(5, ' I want feeding tubes used if I have a terminal condition.');
	} else {
		$pdf->Write(5, ' I do not want feeding tubes used if I have a terminal condition.');
	}
}
$pdf->Ln(7);

if ( !empty($pvslife_set) ) {
	$pdf->Write(5, 'If I am in a PERSISTENT VEGETATIVE STATE, as determined by two physicians who have personally examined me, the following are my directions regarding the use of life-sustaining procedures:');
	if ( in_array('pvsLifeRadioYes', $pvslife_set) ) {
		$pdf->Write(5, ' I want life-sustaining procedures used if I am in a persistent vegetative state.');
	} else {
		$pdf->Write(5, ' I do not want life-sustaining procedures used if I am in a persistent vegetative state.');
	}
$pdf->Ln(7);
}

if ( !empty($pvstube_set) ) {
	$pdf->Write(5, 'If I am in a PERSISTENT VEGETATIVE STATE, as determined by two physicians who have personally examined me, the following are my directions regarding the use of feeding tubes:');
	if ( in_array('pvsTubeRadioYes', $pvstube_set) ) {
		$pdf->Write(5, ' I want feeding tubes used if I am in a persistent vegetative state.');
	} else {
		$pdf->Write(5, ' I do not want feeding tubes used if I am in a persistent vegetative state.');
	}
$pdf->Ln(7);
}


$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Directives to Attending Physicians', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->MultiCell(150, 5, '1. This document authorizes the withholding or withdrawing of life-sustaining procedures or of feeding tubes when two physicians, one of whom is the attending physician, have personally examined and certified in writing that the patient has a terminal condition or is in a persistent vegetative state.', 0, 'L');
$pdf->Ln(3);
$pdf->MultiCell(150, 5, "2. The choices in this document were made by a competent adult. Under the law the patient's stated desires must be followed unless you believe the withholding or withdrawing of life-sustaining procedures or feeding tubes would cause the patient pain or reduced comfort and that the pain or discomfort cannot be alleviated through pain relief measures. If the patient's stated desires are that life-sustaining procedures or feeding tubes be used, this directive must be followed.", 0, 'L');
$pdf->Ln(3);
$pdf->MultiCell(150, 5, '3. If you feel that you cannot comply with this document, you must make a good faith attempt to transfer the patient to another physician who will comply. Refusal or failure to do so constitutes unprofessional conduct.', 0, 'L');
$pdf->Ln(3);
$pdf->MultiCell(150, 5, '4. If you know that the patient is pregnant, this document shall have no effect during her pregnancy.', 0, 'L');
$pdf->Ln(9);

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Location of Copies', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, 'The person making this living will may use the following space to record the names of those individuals and health care providers to whom he or she has given copies of this document:');
$pdf->Ln();
$pdf->Write(5, '__________________________________________________________________________________________________________________________________________________________________________');

$pdf->Ln(9);

// BEGIN LEGAL
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
$pdf->Write(5, 'Printed Name _______________________________________________________');
$pdf->Ln(7);
$pdf->Write(5, '(The signing of this document by the principal revokes all previous powers of attorney for health care and declaration to physicians documents.)');
$pdf->Ln(9);

$pdf->SetFont( 'Arial', '', '14' );
$pdf->Cell ( 0, 5, 'Statement of Witnesses', 0, 1, 'L');
$pdf->Ln(3);
$pdf->SetFont( 'Arial', '', 10);
$pdf->Write(5, "I know the principal personally and I believe him or her to be of sound mind and at least 18 years of age. I believe that his or her execution of this power of attorney for health care is voluntary. I am at least 18 years of age, am not related to the principal by blood, marriage or adoption and am not directly financially responsible for the principal's health care. I am not a health care provider who is serving the principal at this time, an employee of the health care provider, other than a chaplain or a social worker, or an employee, other than a chaplain or a social worker, of an inpatient health care facility in which the declarant is a patient. I am not the principal's health care agent. To the best of my knowledge, I am not entitled to and do not have a claim on the principal's estate.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness 1: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness 1 printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness 1 address: ____________________________________________');
$pdf->Ln(10);
$pdf->Write(5,'Signature of Witness 2: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness 2 printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness 2 address: ____________________________________________');
$pdf->Ln(10);


// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}
?>