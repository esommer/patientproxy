<?php
// VERMONT


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
	'patient_address' => 'patientInfo_patientData_streetAddress_fieldID',
	'patient_city' => 'patientInfo_patientData_city_fieldID',
	'patient_us_state_abbrev' => 'patientInfo_patientData_usStateReq_fieldID',
	'patient_zip' => 'patientInfo_patientData_zip_fieldID',
	'patient_email' => 'patientInfo_patientData_email_fieldID',
	'patient_phone' => 'patientInfo_patientData_dayPhone_fieldID',
	'patient_cellphone' => 'patientInfo_patientData_eveningPhone_fieldID',
	'proxy_circ_set' => 'proxyCircum_fieldSetThree_fieldID_SET', // noLonger, immediately, followingConditions
	'proxy_circ_freetext' => 'proxyCircum_fieldSetThree_followingConditions_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'hp_fullname' => 'healthProxy_proxy_fullName_fieldID',
	'hp_address' => 'healthProxy_proxy_streetAddress_fieldID',
	'hp_city' => 'healthProxy_proxy_city_fieldID',
	'hp_state' => 'healthProxy_proxy_usState_fieldID',
	'hp_zip' => 'healthProxy_proxy_zip_fieldID',
	'hp_relation' => 'healthProxy_proxy_relationship_fieldID',
	'hp_phone' => 'healthProxy_proxy_dayPhone_fieldID',
	'hp_cellphone' => 'healthProxy_proxy_eveningPhone_fieldID',
	'hp_email' => 'healthProxy_proxy_email_fieldID',
	'althp_fullname' => 'healthProxy_alternate_fullName_fieldID',
	'althp_address' => 'healthProxy_alternate_streetAddress_fieldID',
	'althp_city' => 'healthProxy_alternate_city_fieldID',
	'althp_state' => 'healthProxy_alternate_usState_fieldID',
	'althp_zip' => 'healthProxy_alternate_zip_fieldID',
	'althp_relation' => 'healthProxy_alternate_relationship_fieldID',
	'althp_phone' => 'healthProxy_alternate_dayPhone_fieldID',
	'althp_cellphone' => 'healthProxy_alternate_eveningPhone_fieldID',
	'althp_email' => 'healthProxy_alternate_email_fieldID',
	'althp2_fullname' => 'healthProxy_secondAlternate_fullName_fieldID',
	'althp2_address' => 'healthProxy_secondAlternate_streetAddress_fieldID',
	'althp2_city' => 'healthProxy_secondAlternate_city_fieldID',
	'althp2_state' => 'healthProxy_secondAlternate_usState_fieldID',
	'althp2_zip' => 'healthProxy_secondAlternate_zip_fieldID',
	'althp2_relation' => 'healthProxy_secondAlternate_relationship_fieldID',
	'althp2_phone' => 'healthProxy_secondAlternate_dayPhone_fieldID',
	'althp2_cellphone' => 'healthProxy_secondAlternate_eveningPhone_fieldID',
	'althp2_email' => 'healthProxy_secondAlternate_email_fieldID',
	'instructions_freetext' => 'instructions_freeTextElementSet_freeTextElement_fieldID',
	'doc_fullname' => 'othersInvolved_myDoctor_fullName_fieldID',
	'doc_address' => 'othersInvolved_myDoctor_streetAddress_fieldID',
	'doc_city' => 'othersInvolved_myDoctor_city_fieldID',
	'doc_state' => 'othersInvolved_myDoctor_usState_fieldID',
	'doc_zip' => 'othersInvolved_myDoctor_zip_fieldID',
	'doc_email' => 'othersInvolved_myDoctor_email_fieldID',
	'doc_phone' => 'othersInvolved_myDoctor_dayPhone_fieldID',
	'doc_cellphone' => 'othersInvolved_myDoctor_eveningPhone_fieldID',
	'doc2_fullname' => 'othersInvolved_myAlternateDoctor_fullName_fieldID',
	'doc2_address' => 'othersInvolved_myAlternateDoctor_streetAddress_fieldID',
	'doc2_city' => 'othersInvolved_myAlternateDoctor_city_fieldID',
	'doc2_state' => 'othersInvolved_myAlternateDoctor_usState_fieldID',
	'doc2_zip' => 'othersInvolved_myAlternateDoctor_zip_fieldID',
	'doc2_email' => 'othersInvolved_myAlternateDoctor_email_fieldID',
	'doc2_phone' => 'othersInvolved_myAlternateDoctor_dayPhone_fieldID',
	'doc2_cellphone' => 'othersInvolved_myAlternateDoctor_eveningPhone_fieldID',
	'may_consult' => 'othersInvolved_mayConsultSet_mayConsult_fieldID',
	'may_not_consult' => 'othersInvolved_mayNotConsultSet_mayNotConsult_fieldID',
	'give_info_freetext' => 'giveWithholdInformation_freeTextElementSet_freeTextElement_fieldID',
	'court_freetext' => 'noCourtAction_freeTextElementSet_freeTextElement_fieldID',
	'guardian_pick_set' => 'guardian_pickGuardianSet_fieldID_SET', // agentGuardian, otherGuardian
	'guardian_fullname' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_fullName_fieldID',
	'guardian_address' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_streetAddress_fieldID',
	'guardian_city' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_city_fieldID',
	'guardian_state' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_usState_fieldID',
	'guardian_zip' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_zip_fieldID',
	'guardian_email' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_email_fieldID',
	'guardian_phone' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_dayPhone_fieldID',
	'guardian_cellphone' => 'guardian_pickGuardianSet_otherGuardian_fieldID_personDataSet_eveningPhone_fieldID',
	'guardian_freetext' => 'guardian_alternateGuardianSet_alternateGuardian_fieldID',
	'not_guardian_freetext' => 'guardian_alternateGuardianSet_notGuardian_fieldID',
	'values_most_important_freetext' => 'valuesGoals_mostImportantSet_freeTextElement_fieldID',
	'values_general_advice_freetext' => 'valuesGoals_generalAdviceSet_freeTextElement_fieldID',
	'values_other_statement_freetext' => 'valuesGoals_otherStatementSet_freeTextElement_fieldID',

	'eol_set' => 'endOfLifeWishes_extendLife_fieldID_SET', // possibleTreatments, limitations, agentDecides
	'eol_lswithhold_set' => 'endOfLifeWishes_extendLife_limitations_fieldID_lsWithholdSet_fieldID_SET', // breathingMachines, tubeFeeding, antibiotics, otherMeds, otherMeans, other
	'eol_ls_freetext' => 'endOfLifeWishes_extendLife_limitations_fieldID_lsWithholdSet_other_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'eol_pain_hospice_set' => 'endOfLifeWishes_painHospice_fieldID_SET', // comfortRelief, painMedication, hospiceCare, dieAtHome, otherWishes
	'eol_pain_freetext' => 'endOfLifeWishes_painHospice_otherWishes_fieldID_freeTextElementSet_freeTextElement_fieldID',
	
	'treat_wish_set' => 'treatmentWishes_treatmentWishesSet_fieldID_SET', // DNR, trialTreatment, treatmentWithhold, likelyCost
	'treat_withhold_set' => 'treatmentWishes_treatmentWishesSet_treatmentWithhold_fieldID_unableToThinkSet_fieldID_SET', // breathingMachines, tubeFeeding, antibiotics, otherMeds, otherMeans, other
	'think_freetext' => 'treatmentWishes_treatmentWishesSet_treatmentWithhold_fieldID_unableToThinkSet_other_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'cost_freetext' => 'treatmentWishes_treatmentWishesSet_likelyCost_fieldID_freeTextElementSet_freeTextElement_fieldID',
	
	'pregnant_set' => 'pregnancylsTreatment_pregnantlsWithholdSet_fieldID_SET', // pregnantLSTreatments, pregnantLimitations, other, nolsTreatments
	'pregnant_withhold_set' => 'pregnancylsTreatment_pregnantlsWithholdSet_pregnantLimitations_fieldID_lsWithholdSet_fieldID_SET', // breathingMachines, tubeFeeding, antibiotics, otherMeds, otherMeans, other
	'pregnant_withhold_freetext' => 'pregnancylsTreatment_pregnantlsWithholdSet_pregnantLimitations_fieldID_lsWithholdSet_other_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'pregnant_freetext' => 'pregnancylsTreatment_pregnantlsWithholdSet_other_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'hospital_yes_name' => 'hospitalization_hosptialYesSet_hospital_fieldID',
	'hospital_yes_address' => 'hospitalization_hosptialYesSet_streetAddress_fieldID',
	'hospital_yes_city' => 'hospitalization_hosptialYesSet_city_fieldID',
	'hospital_yes_phone' => 'hospitalization_hosptialYesSet_dayPhone_fieldID',
	'hospital2_yes_name' => 'hospitalization_hosptialYesSet2_hospital_fieldID',
	'hospital2_yes_address' => 'hospitalization_hosptialYesSet2_streetAddress_fieldID',
	'hospital2_yes_city' => 'hospitalization_hosptialYesSet2_city_fieldID',
	'hospital2_yes_phone' => 'hospitalization_hosptialYesSet2_dayPhone_fieldID',
	'hospital_no_name' => 'hospitalization_hosptialNoSet_hospital_fieldID',
	'hospital2_no_name' => 'hospitalization_hosptialNoSet2_hospital_fieldID',
	'med_pref_freetext' => 'medicationPreference_medicationPreferenceSet_freeTextElement_fieldID',
	'med_avoid_freetext' => 'medicationPreference_medicationAvoidSet_freeTextElement_fieldID',
	'research_auth_agent' => 'researchConsent_authorizeAgentSet_fieldID_SET', // authorizeAgent
	'research_med_educ_set' => 'researchConsent_medicalEducationConsentSet_fieldID_SET', // radioIDo, radioIDoNot
	'research_treat_set' => 'researchConsent_treatmentStudiesConsentSet_fieldID_SET', // radioIDo, radioIDoNot
	'organ_wish_set' => 'organDonation_wishRefuseToDonateSet_fieldID_SET', // refuseToDonate, wishToDonate
	'organ_give_set' => 'organDonation_wishRefuseToDonateSet_wishToDonate_fieldID_organsSet_fieldID_SET', // anatomicalStudy, majorOrgans, eyeTissue
	'organ_agent_decide_set' => 'organDonation_agentDecisionSet_fieldID_SET', // agentDecision, followingDecision
	'organ_agent_freetext' => 'organDonation_agentDecisionSet_followingDecision_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'organ_anatomical' => 'organDonation_anatomicalStudySet_fieldID_SET', // anatomicalStudy
	'burial_set' => 'burial_burialArrangements_fieldID_SET', // alreadyMadeArrangements, casket, cremate, familyArrangements
	'funeral_fullname' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_fullName_fieldID',
	'funeral_address' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_streetAddress_fieldID',
	'funeral_city' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_city_fieldID',
	'funeral_state' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_usState_fieldID',
	'funeral_zip' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_zip_fieldID',
	'funeral_phone' => 'burial_burialArrangements_alreadyMadeArrangements_fieldID_funeralParlor_dayPhone_fieldID',
	'casket_freetext' => 'burial_burialArrangements_casket_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'cremate_freetext' => 'burial_burialArrangements_cremate_fieldID_freeTextElementSet_freeTextElement_fieldID',
	'burial_freetext' => 'burial_otherInstructionsSet_otherInstructions_fieldID',
	'body_set' => 'bodyAfterDeath_dispositionAgentSet_fieldID_SET', // myAgent, notMyAgent, familyToDecide
	'body_fullname' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_fullName_fieldID',
	'body_address' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_streetAddress_fieldID',
	'body_city' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_city_fieldID',
	'body_state' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_usState_fieldID',
	'body_zip' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_zip_fieldID',
	'body_email' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_email_fieldID',
	'body_phone' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_dayPhone_fieldID',
	'body_cellphone' => 'bodyAfterDeath_dispositionAgentSet_notMyAgent_fieldID_personDataSet_eveningPhone_fieldID',
	'autopsy_set' => 'bodyAfterDeath_autopsySet_fieldID_SET', // supportAutopsy, familyDecidesAutopsy
	'final_freetext' => 'otherInstructions_freeTextElementSet_freeTextElement_fieldID',
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
$pdf->Cell ( 0, 5, 'Advance Directive', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "I, $patient_full_name, born $patient_birth_date of ");
if ( !empty($patient_address) ) {
	$pdf->Write(5, "$patient_address ");
}
if ( !empty($patient_city) ) {
	$pdf->Write(5, "$patient_city, ");
}
$pdf->Write(5, "$patient_us_state_abbrev, ");
if ( !empty($patient_zip) ) {
	$pdf->Write(5, "$patient_zip, ");
}
if ( !empty($patient_phone) ) {
	$pdf->Write(5, "$patient_phone (p), ");
}
if (!empty($patient_cellphone) ) {
	$pdf->Write(5, "$patient_cellphone (c), ");
}
if ( !empty($patient_email) ) {
	$pdf->Write(5, "$patient_email (e), ");
}
$pdf->Write(5, "do set forth this Advance Directive today, $month $day, $year.");
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Appointment of a Health Proxy');
$pdf->SetFont ( 'Arial', '', '10' );
if ( !empty($proxy_circ_set_) || !empty($proxy_circ_freetext) ) {
	$pdf->Ln(7);
	$pdf->Write(5, 'I want my health proxy to make decisions for me');
	if ( in_array('noLonger', $proxy_circ_set) ) {
		$pdf->Write(5, ' when I am no longer able to make health care decisions for myself.');
	} else if ( in_array( 'immediately', $proxy_circ_set) ) {
		$pdf->Write(5, ' immediately, allowing my agent to make decisions for me right now.');
	} else {
		$pdf->Write(5, ' when the following condition or event occurs (to be determined as follows):');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		if ( !empty($proxy_circ_freetext) ) {
			$pdf->Write(5, "$proxy_circ_freetext");
		} else {
			$pdf->Write(5, '_______________________________________________________________');
		}
	}
	$pdf->Ln(7);
} 
// APPOINT PROXY & ALTERNATE
$whatSet = '';
// if all three are set
if ( !empty ( $hp_fullname ) && !empty ( $althp_fullname ) && !empty( $althp2_fullname) ) {
	$whatSet = 'all three';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. In the event that neither is willing, able, or reasonably available to make a health-care decision for me, I hereby appoint my second alternate health proxy.");
}
// else if two of three are set
else if ( !empty( $hp_fullname) && !empty($althp_fullname) && empty($althp2_fullname) ) {
	$whatSet = 'hp and alt';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( !empty( $hp_fullname) && empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'hp and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
else if ( empty($hp_fullname) && !empty($althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'alt and 3rd';
	$pdf->Write(5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate.");
}
// else if at least one is set
else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) && empty ( $althp2_fullname) ) {
	$whatSet = 'just hp';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document." );
}
else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) && empty( $althp2_fullname) ) {
	$whatSet = 'just alt';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document." );
}
else if ( empty ( $hp_fullname) && empty( $althp_fullname) && !empty($althp2_fullname) ) {
	$whatSet = 'just 3rd';
	$pdf->Write ( 5, "I, $patient_full_name, designate the following individual as my health proxy to make any and all health-care decisions for me, except to the extent I state otherwise in this document." );
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
		// relationship
		if ( !empty($hp_relation) || !empty($althp_relation) || !empty($althp2_relation) ) {
			$pdf->Cell ( 50, 5, "$hp_relation" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_relation" );
			$pdf->Cell ( 10, 5);
			$pdf->Cell ( 50, 5, "$althp2_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($hp_relation) || !empty($althp_relation) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_relation" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($hp_relation) || !empty($althp2_relation) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$hp_relation" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($althp_relation) || !empty($althp2_relation) ) {
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$althp_relation" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$althp2_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($hp_relation) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($althp_relation) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp_relation" );
			$pdf->Ln();
		}
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
		// relation
		if ( !empty($althp2_relation) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$althp2_relation" );
			$pdf->Ln();
		}
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
$pdf->Write(5, 'General guidance for my health proxy: When making health care decisions for me, my health proxy should think about what action would be consistent with past conversations we have had, my treatment preferences as expressed in this or any other document, my religious and other beliefs and values, and how I have handled medical and other important issues in the past. If what I would decide is still unclear, then my health proxy should make decisions for me that my health proxy believes are in my best interest, considering the benefits, burdens, and risks of my current circumstances and treatment options.');
$pdf->Ln(7);
if ( !empty($instructions_freetext) ) {
	$pdf->Write(5, "I give the following further instructions, if any, for my agent's guidance: $instructions_freetext");
	$pdf->Ln();
}
// _____________________________________ END HEALTH PROXY

// ===================================== BEGIN OTHER PERSONS
if ( !empty($doc_fullname) || !empty($doc2_fullname) || !empty($may_consult) || !empty($may_not_consult) || !empty($give_info_freetext) || !empty($court_freetext) || !empty($guardian_pick_set) || !empty($guardian_fullname) || !empty($guardian_freetext) || !empty($not_guardian_freetext) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', 'B', '14' );
	$pdf->Write(5, 'Others Who May Be Involved in My Care');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$docSet = '';
	// if both first doc and alt doc are set
	if ( !empty ( $doc_fullname ) && !empty ( $doc2_fullname ) ) {
		$docSet = 'both';
	} else if ( !empty ( $doc_fullname ) && empty ( $doc2_fullname ) ) {
		$docSet = 'just doc1';
	} else if ( empty ( $doc_fullname ) && !empty ( $doc2_fullname ) ) {
		$docSet = 'just doc2';
	}
	switch ( $docSet ) {
		case ( 'both' ):
			// heading
			$pdf->SetFont ( 'Arial', 'B', 12 );
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, 'Primary Care Physician' );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, 'Alternate Primary Care Physician' );
			$pdf->Ln ( 6 );
			$pdf->SetFont ( 'Arial', '', 10 );
			// names
			$pdf->Cell ( 25, 5 );
			$pdf->Cell ( 50, 5, "$doc_fullname" );
			$pdf->Cell ( 20, 5 );
			$pdf->Cell ( 50, 5, "$doc2_fullname" );
			$pdf->Ln();
			// streets
			if ( !empty($doc_address) || !empty($doc2_address) ) {
				$pdf->Cell ( 25, 5 );
				$pdf->Cell ( 50, 5, "$doc_address" );
				$pdf->Cell ( 20, 5 );
				$pdf->Cell ( 50, 5, "$doc2_address" );
				$pdf->Ln();
			}
			// cities, states zips
			if ( !empty($doc_city) || !empty($doc_state) || !empty($doc_zip) || !empty($doc2_city) || !empty($doc2_state) || !empty($doc2_zip) ) {
				$pdf->Cell ( 25, 5 );
				if ( !empty($doc_city) && !empty($doc_state) ) {
					// only want comma if city AND state are there
					$pdf->Cell ( 50, 5, "$doc_city, $doc_state $doc_zip" );
				} else {
					$pdf->Cell (50, 5, "$doc_city $doc_state $doc_zip" );
				}
				$pdf->Cell ( 20, 5 );
				if ( !empty($doc2_city) && !empty($doc2_state) ) {
					$pdf->Cell ( 50, 5, "$doc2_city, $doc2_state $doc2_zip" );
				} else {
					$pdf->Cell ( 50, 5, "$doc2_city $doc2_state $doc2_zip" );
				}
				$pdf->Ln();
			}
			// phones
			if ( !empty($doc_phone) || !empty($doc2_phone) ) {
				$pdf->Cell ( 25, 5 );
				$pdf->Cell ( 50, 5, "$doc_phone" );
				$pdf->Cell ( 20, 5 );
				$pdf->Cell ( 50, 5, "$doc2_phone" );
				$pdf->Ln();
			}
			// cells
			if ( !empty($doc_cellphone) || !empty($doc2_cellphone) ) {
				$pdf->Cell ( 25, 5 );
				$pdf->Cell ( 50, 5, "$doc_cellphone" );
				$pdf->Cell ( 20, 5 );
				$pdf->Cell ( 50, 5, "$doc2_cellphone" );
				$pdf->Ln();
			}
			// emails
			if ( !empty($doc_email) || !empty($doc2_email) ) {
				$pdf->Cell ( 25, 5 );
				$pdf->Cell ( 50, 5, "$doc_email" );
				$pdf->Cell ( 20, 5 );
				$pdf->Cell ( 50, 5, "$doc2_email" );
				$pdf->Ln();
			}
			break;
		case 'just doc1':
			// heading
			$pdf->SetFont ( 'Arial', 'B', 12 );
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, 'Primary Care Physician' );
			$pdf->Ln ( 6 );
			$pdf->SetFont ( 'Arial', '', 10 );
			// name
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$doc_fullname" );
			$pdf->Ln();
			// street
			if ( !empty($doc_address) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_address" );
				$pdf->Ln();
			}
			// city, state zip
			if ( !empty($doc_city) && !empty($doc_state) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_city, $doc_state $doc_zip" );
				$pdf->Ln();
			} else {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_city $doc_state $doc_zip" );
				$pdf->Ln();
			}
			// phone
			if ( !empty($doc_phone) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_phone" );
				$pdf->Ln();
			}
			// cell
			if ( !empty($doc_cellphone) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_cellphone" );
				$pdf->Ln();
			}
			// email
			if ( !empty($doc_email) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc_email" );
				$pdf->Ln();
			}
			break;
		case 'just doc2':
			// heading
			$pdf->SetFont ( 'Arial', 'B', 12 );
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, 'Primary Care Physician' );
			$pdf->Ln ( 6 );
			$pdf->SetFont ( 'Arial', '', 10 );
			// name
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$doc2_fullname" );
			$pdf->Ln();
			// street
			if ( !empty($doc2_address) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_address" );
				$pdf->Ln();
			}
			// city, state zip
			if ( !empty($doc2_city) && !empty($doc2_state) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_city, $doc2_state $doc2_zip" );
				$pdf->Ln();
			} else {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_city $doc2_state $doc2_zip" );
				$pdf->Ln();
			}
			// phone
			if ( !empty($doc2_phone) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_phone" );
				$pdf->Ln();
			}
			// cell
			if ( !empty($doc2_cellphone) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_cellphone" );
				$pdf->Ln();
			}
			// email
			if ( !empty($doc2_email) ) {
				$pdf->Cell ( 30, 5 );
				$pdf->Cell ( 50, 5, "$doc2_email" );
				$pdf->Ln();
			}
			break;
	}
	$pdf->Ln(7);
	if ( !empty($may_consult) ) {
		$pdf->Write(5, 'Other people whom my agent MAY consult about medical decisions on my behalf:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Multicell(150, 5, "$may_consult", 0, 'L');
		$pdf->Ln(7);	
	}
	if ( !empty($may_not_consult) ) {
		$pdf->Write(5, 'Other people whom my agent MAY NOT consult about medical decisions on my behalf:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Multicell(150, 5, "$may_not_consult", 0, 'L');
		$pdf->Ln(7);	
	}
	if ( !empty($give_info_freetext) ) {
		$pdf->Write(5, 'My health agent or health care provider may give information about my condition to the following adults and minors:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Multicell(150, 5, "$give_info_freetext", 0, 'L');
		$pdf->Ln(7);	
	}
	if ( !empty($court_freetext) ) {
		$pdf->Write(5, 'The person(s) named below shall NOT be entitled to bring a court action on my behalf concerning matters covered by this advance directive, nor serve as a health care decision maker for me:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$court_freetext");
		$pdf->Ln(7);	
	}
	if ( !empty($guardian_pick_set) || !empty($guardian_fullname) ) {
		$pdf->Write(5, 'If I need a guardian in the future, I ask the court to consider appointing');
		if ( in_array('agentGuardian', $guardian_pick_set) ) {
			$pdf->Write(5, ' my health care agent.');
		} else {
			$pdf->Write(5, ' the following person:');
			$pdf->Ln();
			$pdf->Cell(5, 10);
			if ( !empty($guardian_fullname) ) {
				$pdf->Write(5, "$guardian_fullname $guardian_address $guardian_city $guardian_state $guardian_zip $guardian_email $guardian_phone $guardian_cellphone");
			} else {
				$pdf->Write(5, '_________________________________________________________________________');
			}
		}
		$pdf->Ln(7);
	}
	if ( !empty($guardian_freetext) ) {
		$pdf->Write(5, 'Alternate preferred guardians:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Multicell(150, 5, "$guardian_freetext", 0, 'L');
		$pdf->Ln(7);
	}
	if ( !empty($not_guardian_freetext) ) {
		$pdf->Write(5, 'Persons I would not want to be my guardian:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Multicell(150, 5, "$not_guardian_freetext", 0, 'L');
		$pdf->Ln(7);
	}
}
// _____________________________________ END OTHER PERSONS
if ( !empty($values_most_important_freetext) || !empty($values_general_advice_freetext) || !empty($values_other_statement_freetext) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', 'B', '14' );
	$pdf->Write(5, 'Statement of Values and Goals');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( !empty($values_most_important_freetext) ) {
		$pdf->Write(5, "What is most important to me regarding my health care: $values_most_important_freetext");
		$pdf->Ln(7);
	}
	if ( !empty($values_general_advice_freetext) ) {
		$pdf->Write(5, "General advice about how to approach health care choices depending upon my current or future state of health or the chances of success of various treatments: $values_general_advice_freetext");
		$pdf->Ln(7);
	}
	if ( !empty($values_other_statement_freetext) ) {
		$pdf->Write(5, "Other statement of values and goals to help guide health care decisions made on my behalf: $values_other_statement_freetext");
		$pdf->Ln(7);
	}
}

// End-of-Life Wishes
if ( !empty($eol_set) || !empty($eol_lswithhold_set) || !empty($eol_ls_freetext) || !empty($eol_pain_hospice_set) || !empty($eol_pain_freetext) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', 'B', '14' );
	$pdf->Write(5, 'End-Of-Life Wishes');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( !empty($eol_set) || !empty($eol_ls_withhold_set) || !empty($eol_ls_freetext) ) {
		$pdf->Write(5, 'If the time comes when I am close to death or am unconscious and unlikely to become conscious again');
		if ( in_array('possibleTreatments', $eol_set) ) {
			$pdf->Write(5, ' I want all possible treatments to extend my life.');
		} else if ( in_array('limitations', $eol_set) || !empty($eol_lswithhold_set) || !empty($eol_ls_freetext) ) {
			$pdf->Write(5, 'I do not want my life extended by any of the following means:');
			$pdf->Ln();
			if ( !empty( $eol_lswithhold_set ) || !empty($eol_ls_freetext) ) {
				if ( in_array('breathingMachines', $eol_lswithhold_set) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'breathing machines (ventilator or respirator)');
					$pdf->Ln();
				}
				if ( in_array('tubeFeeding', $eol_lswithhold_set) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'tube feeding (feeding and hydration by medical means)');
					$pdf->Ln();
				}
				if ( in_array('antibiotics', $eol_lswithhold_set) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'antibiotics');
					$pdf->Ln();
				}
				if ( in_array('otherMeds', $eol_lswithhold_set) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'other medications whose purpose is to extend my life');
					$pdf->Ln();
				}
				if ( in_array('otherMeans', $eol_lswithhold_set) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'any other means');
					$pdf->Ln();
				}
				if ( in_array('other', $eol_lswithhold_set) || !empty($eol_ls_freetext) ) {
					$pdf->Cell(5, 10);
					$pdf->Write(5, 'other:');
					if ( !empty($eol_ls_freetext) ) {
						$pdf->Write(5, " $eol_ls_freetext");
					} else {
						$pdf->Write(5, ' ________________________________________');
					}
				}
			} 
		} else if ( in_array('agentDecides', $eol_set) ) {
			$pdf->Write(5, 'I want my agent to decide what treatments I receive, including tube feeding.');
		}
		$pdf->Ln(7);
	}
	if ( !empty($eol_pain_hospice_set) || !empty($eol_pain_freetext) ) {
		if ( in_array('comfortRelief', $eol_pain_hospice_set) ) {
			$pdf->Write(5, 'I want care that preserves my dignity and that provides comfort and relief from symptoms that are bothering me.');
			$pdf->Ln(7);
		}
		if ( in_array('painMedication', $eol_pain_hospice_set) ) {
			$pdf->Write(5, 'I want pain medication to be administered to me even though this may have the unintended effect of hastening my death.');
			$pdf->Ln(7);
		}
		if ( in_array('hospiceCare', $eol_pain_hospice_set) ) {
			$pdf->Write(5, ' I want hospice care when it is appropriate in any setting.');
			$pdf->Ln(7);
		}
		if ( in_array('dieAtHome', $eol_pain_hospice_set) ) {
			$pdf->Write(5, 'I would prefer to die at home if this is possible.');
			$pdf->Ln(7);
		}
		if ( in_array('otherWishes', $eol_pain_hospice_set) || !empty($eol_pain_freetext) ) {
			$pdf->Write(5, 'Other wishes and instructions:');
			$pdf->Write(5, 'other:');
			if ( !empty($eol_pain_freetext) ) {
				$pdf->Write(5, " $eol_pain_freetext");
			} else {
				$pdf->Write(5, ' ________________________________________');
			}
		}
	}
}

// Treatment Wishes
if ( !empty($treat_wish_set) || !empty($treat_withhold_set) || !empty($think_freetext) || !empty($cost_freetext) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', 'B', '14' );
	$pdf->Write(5, 'Treatment Wishes');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('DNR', $treat_wish_set) ) {
		$pdf->Write(5, 'I wish to have a Do Not Resuscitate (DNR) Order written for me.');
		$pdf->Ln(7);
	}
	if ( in_array('trialTreatment', $treat_wish_set) ) {
		$pdf->Write(5, 'If I am in a critical health crisis that may not be life-ending and more time is needed to determine if I can get better, I want treatment started. If, after a reasonable period of time, it becomes clear that I will not get better, I want all life extending treatment stopped. This includes the use of breathing machines or tube feeding.');
		$pdf->Ln(7);
	}
	if ( in_array('treatmentWithhold', $treat_wish_set) || !empty($treat_withhold_set) || !empty($think_freetext) ) {
		$pdf->Write(5, 'If I am conscious but become unable to think or act for myself and will likely not improve, I do not want the following life-extending treatment:');
		$pdf->Ln();
		if ( in_array('breathingMachines', $treat_withhold_set) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'breathing machines (ventilator or respirator)');
			$pdf->Ln();
		}
		if ( in_array('tubeFeeding', $treat_withhold_set) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'tube feeding (feeding and hydration by medical means)');
			$pdf->Ln();
		}
		if ( in_array('antibiotics', $treat_withhold_set) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'antibiotics');
			$pdf->Ln();
		}
		if ( in_array('otherMeds', $treat_withhold_set) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'other medications whose purpose is to extend my life');
			$pdf->Ln();
		}
		if ( in_array('otherMeans', $treat_withhold_set) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'any other means');
			$pdf->Ln();
		}
		if ( in_array('other', $treat_withhold_set) || !empty($think_freetext) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'other:');
			if ( !empty($think_freetext) ) {
				$pdf->Write(5, " $think_freetext");
			} else {
				$pdf->Write(5, ' ________________________________________');
			}
		}
		$pdf->Ln(7);
	}
	if ( in_array('likelyCost', $treat_wish_set) || !empty($cost_freetext) ) {
		$pdf->Write(5, 'If the likely cost, risks and burdens of treatment are more than I wish to endure, I do not want life-extending treatment.');
		if ( !empty($cost_freetext) ) {
			$pdf->Write( 5, " The costs, risks and burdens that concern me the most are: $cost_freetext");
		}
		$pdf->Ln(7);
	}
}




if ( !empty($pregnant_set) || !empty($pregnant_withhold_set) || !empty($pregnant_withhold_freetext) ) {
	$pdf->Write(5, 'If it is determined that I am pregnant at the time this Advance Directive becomes effective,');
	if ( in_array('pregnantLSTreatments', $pregnant_set) ) {
		$pdf->Write(5, ' I want all life sustaining treatment.');
	} else if ( in_array('pregnantLimitations', $pregnant_set) || !empty($pregnant_withhold_set) || !empty($pregnant_withhold_freetext) ) {
		$pdf->Write(5, ' I want my life extended by only the following means:');
		$pdf->Ln();
		if ( !empty( $pregnant_withhold_set ) || !empty($pregnant_withhold_freetext) ) {
			if ( in_array('breathingMachines', $pregnant_withhold_set) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'breathing machines (ventilator or respirator)');
				$pdf->Ln();
			}
			if ( in_array('tubeFeeding', $pregnant_withhold_set) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'tube feeding (feeding and hydration by medical means)');
				$pdf->Ln();
			}
			if ( in_array('antibiotics', $pregnant_withhold_set) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'antibiotics');
				$pdf->Ln();
			}
			if ( in_array('otherMeds', $pregnant_withhold_set) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'other medications whose purpose is to extend my life');
				$pdf->Ln();
			}
			if ( in_array('otherMeans', $pregnant_withhold_set) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'any other means');
				$pdf->Ln();
			}
			if ( in_array('other', $pregnant_withhold_set) || !empty($pregnant__withhold_freetext) ) {
				$pdf->Cell(5, 10);
				$pdf->Write(5, 'the following:');
				if ( !empty($pregnant_withhold_freetext) ) {
					$pdf->Write(5, " $pregnant_withhold_freetext");
				} else {
					$pdf->Write(5, ' ________________________________________');
				}
				$pdf->Ln();
			}
		} 
	} else if ( in_array('nolsTreatments', $pregnant_set) ) {
		$pdf->Write(5, ' no life sustaining treatment.');
	}
	$pdf->Ln(7);
}

if ( !empty($hospital_yes_name) || !empty($hospital_yes_address) || !empty($hospital_yes_city) || !empty($hospital_yes_phone) || !empty($hospital2_yes_name) || !empty($hospital2_yes_address) || !empty($hospital2_yes_city) || !empty($hospital2_yes_phone) || !empty($hospital_no_name) || !empty($hospital2_no_name) ) {
	if ( !empty ( $hospital_yes_name ) && !empty ( $hospital2_yes_name ) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, the following facilities are listed in order of preference:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital_yes_name $hospital_yes_address $hospital_yes_city $hospital_yes_phone");
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital2_yes_name $hospital2_yes_address $hospital2_yes_city $hospital2_yes_phone");
		$pdf->Ln(7);
	} else if ( !empty ( $hospital_yes_name ) && empty ( $hospital2_yes_name ) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, I prefer the following facility:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital_yes_name $hospital_yes_address $hospital_yes_city $hospital_yes_phone");
		$pdf->Ln(7);
	} else if ( empty ( $hospital_yes_name ) && !empty ( $hospital2_yes_name ) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, I prefer the following facility:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital2_yes_name $hospital2_yes_address $hospital2_yes_city $hospital2_yes_phone");
		$pdf->Ln(7);
	}
	if ( !empty($hospital_no_name) && !empty($hospital2_no_name) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, I would like to avoid being treated in the following facilities:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital_no_name");
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital2_no_name");
		$pdf->Ln(7);
	} else if ( !empty($hospital_no_name) && empty($hospital2_no_name) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, I would like to avoid being treated in the following facility:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital_no_name");
		$pdf->Ln(7);
	} else if ( empty($hospital_no_name) && !empty($hospital2_no_name) ) {
		$pdf->Write(5, 'If I need care in a hospital or treatment facility, I would like to avoid being treated in the following facility:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$hospital2_no_name");
		$pdf->Ln(7);
	}
}

if ( !empty($med_pref_freetext) ) {
	$pdf->Write(5, 'I prefer the following medications or treatments:');
	$pdf->Ln();
	$pdf->Cell(5, 10);
	$pdf->Multicell(150, 5, "$med_pref_freetext", 0, 'L');
	$pdf->Ln(7);
}
if ( !empty($med_avoid_freetext) ) {
	$pdf->Write(5, 'Avoid use of the following medications or treatments:');
	$pdf->Ln();
	$pdf->Cell(5, 10);
	$pdf->Multicell(150, 5, "$med_avoid_freetext", 0, 'L');
	$pdf->Ln(7);
}

if ( !empty($research_auth_agent) ) {
	$pdf->Write(5, 'I authorize my agent to consent to my participation in student medical education, treatment studies, or drug trials.');
	$pdf->Ln(7);
}

if ( !empty($research_med_educ_set) ) {
	if ( in_array('radioIDo', $research_med_educ_set) ) {
		$pdf->Write(5, 'I wish to participate in student medical education.');
		$pdf->Ln(7);
	} else {
		$pdf->Write(5, 'I do not wish to participate in student medical education.');
		$pdf->Ln(7);
	}
}
if ( !empty($research_treat_set) ) {
	if ( in_array('radioIDo', $research_treat_set) ) {
		$pdf->Write(5, 'I wish to participate in treatment studies or drug trials.');
		$pdf->Ln(7);
	} else {
		$pdf->Write(5, 'I do not wish to participate in treatment studies or drug trials.');
		$pdf->Ln(7);
	}
}

if ( !empty($organ_wish_set) || !empty($organ_give_set) || !empty($organ_agent_decide_set) || !empty($organ_agent_freetext) || !empty($organ_anatomical) ) {
	$pdf->Write(5, 'I want my agent (if I have appointed one) and all who care about me to follow my wishes about organ donation if that is an option at the time of my death:');
	$pdf->Ln();
	$pdf->Cell(5, 10);
	if ( !empty($organ_wish_set) || !empty($organ_give_set) ) {
		if ( in_array('refuseToDonate', $organ_wish_set) ) {
			$pdf->Write(5, 'I do not wish to be an organ donor.');
			$pdf->Ln();
		} else {
			$pdf->Write(5, 'I wish to donate the following organs and tissues:');
			$pdf->Ln();
			if ( !empty($organ_give_set) ) {
				if ( in_array('anyNeeded', $organ_give_set) ) {
					$pdf->Cell(5, 20);
					$pdf->Write(5, 'Any needed organs or tissues.');
					$pdf->Ln();
				}
				if ( in_array('majorOrgans', $organ_give_set) ) {
					$pdf->Cell(5, 20);
					$pdf->Write(5, 'Major organs (heart, lungs, kidneys, etc.)');
					$pdf->Ln();
				}
				if ( in_array('skinBones', $organ_give_set) ) {
					$pdf->Cell(5, 20);
					$pdf->Write(5, 'Tissues such as skin and bones.');
					$pdf->Ln();
				}
				if ( in_array('eyeTissue', $organ_give_set) ) {
					$pdf->Cell(5, 20);
					$pdf->Write(5, 'Eye tissue such as corneas.');
					$pdf->Ln();
				}
			}		
		}
		$pdf->Ln(2);
	}
	if ( !empty($organ_agent_decide_set) ) {
		$pdf->Write(5, 'I wish my agent to make any decisions for anatomical gifts.');
		$pdf->Ln(7);
	}
	if ( !empty($organ_agent_freetext) ) {
		$pdf->Write(5, 'I wish the following person(s) to make any decisions for anatomical gifts:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$organ_agent_freetext");
		$pdf->Ln(7);
	}
	if ( !empty($organ_anatomical) ) {
		$pdf->Write(5, 'I desire to donate my body to research or educational programs.');
		$pdf->Ln(7);
	}
}

if ( !empty($burial_set) || !empty($funeral_fullname) || !empty($casket_freetext) || !empty($cremate_freetext) || !empty($burial_freetext) ) {
	if ( in_array('alreadyMadeArrangements', $burial_set) || !empty($funeral_fullname) ) {
		$pdf->Write(5, 'I have already made funeral or cremation arrangements with:');
		$pdf->Ln();
		$pdf->Cell(5, 10);
		$pdf->Write(5, "$funeral_fullname $funeral_address $funeral_city $funeral_state $funeral_zip $funeral_phone");
		$pdf->Ln();
	}
	if ( in_array('casket', $burial_set) || !empty($casket_freetext) ) {
		$pdf->Write(5, 'I want a funeral followed by burial in a casket at the following location, if possible:');
		$pdf->Ln();
		if ( !empty($casket_freetext) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, "$casket_freetext");
		} else {
			$pdf->Cell(5, 10);
			$pdf->Write(5, '_____________________________________________________________');
		}		
	}
	if ( in_array('cremate', $burial_set) || !empty($cremate_freetext) ) {
		$pdf->Write(5, 'I want to be cremated and want my ashes buried or distributed as follows:');
		$pdf->Ln();
		if ( !empty($cremate_freetext) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, "$cremate_freetext");
		} else {
			$pdf->Cell(5, 10);
			$pdf->Write(5, '_____________________________________________________________');
		}
	}
	if ( in_array('familyArrangements', $burial_set) || !empty($burial_freetext) ) {
		$pdf->Write(5, 'I want to have arrangements made at the direction of my agent or family.');
		$pdf->Ln();
		if ( !empty($burial_freetext) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, "Other instructions: $burial_freetext");
		} else {
			$pdf->Cell(5, 10);
			$pdf->Write(5, 'Other instructions: _____________________________________________________________');
		}
	}
	$pdf->Ln(7);
}

if ( !empty($body_set) || !empty($body_fullname) ) {
	if ( in_array('myAgent', $body_set) ) {
		$pdf->Write(5, 'I want my health care agent to decide arrangements after my death. If he or she is not available, I want my alternate agent to decide.');
		$pdf->Ln(7);
	} else if ( in_array('notMyAgent', $body_set) || !empty($body_fullname) ) {
		$pdf->Write(5, 'I appoint the following person to decide about and arrange for the disposition of my body after my death:');
		if ( !empty($body_fullname) ) {
			$pdf->Cell(5, 10);
			$pdf->Write(5, "$body_fullname $body_address $body_city $body_state $body_zip $body_email $body_phone $body_cellphone");
			$pdf->Ln(7);
		} else {
			$pdf->Cell(5, 10);
			$pdf->Write(5, '_____________________________________________________________');
			$pdf->Ln(7);
		}
	} else {
		$pdf->Write(5, 'I want my family to decide.');
		$pdf->Ln(7);
	}
}

if ( !empty($autopsy_set) ) {
	$pdf->Write(5, 'If an autopsy is suggested following my death,');
	if ( in_array('supportAutopsy', $autopsy_set) ) {
		$pdf->Write(5, ' I support having an autopsy performed.');
		$pdf->Ln(7);
	} else {
		$pdf->Write(5, ' I would like my agent or family to decide whether to have it done.');
		$pdf->Ln(7);
	}
}

if ( !empty($final_freetext) ) {
	$pdf->Write(5, "I give the following instructions: $final_freetext");
	$pdf->Ln(7);
}

// SIGNATURE
$pdf->Ln(10);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Signature', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "I, $patient_full_name, declare that this document reflects my desires regarding my future health care, (organ and tissue donation and disposition of my body after death, and that I am signing this advance directive of my own free will.");
$pdf->Ln(7);
$pdf->Write(5, 'Signature: ______________________________________________');
$pdf->Ln(7);
$pdf->Write(5, 'Date: _______________________');
$pdf->Ln(7);

// WITNESSES
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Witnesses');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "I affirm that the Principal appears to understand the nature of an Advance Directive and to be free from duress or undue influence.");
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

$pdf->Write(5, 'Acknowledgement by the person who explained the Advance Directive if the principal is a current patient or resident in a hospital, or other health care facility:');
$pdf->Ln();
$pdf->Write(5, 'I affirm that:');
$pdf->Ln();
$pdf->Cell(5, 10);
$pdf->Write(5, 'The maker of this Advance Directive is a current patient or resident in a hospital, nursing home or residential care facility,');
$pdf->Ln();
$pdf->Write(5, 'I am an ombudsman, recognized member of the clergy, an attorney licensed to practice in Vermont, or a probate division of the superior court designee or hospital designee, and');
$pdf->Ln();
$pdf->Cell(5, 10);
$pdf->Write(5, 'I have explained the nature and effect of the Advance Directive to the Principal and it appears that the Principal is willingly and voluntarily executing it.');
$pdf->Ln(7);
$pdf->Write(5,'Signature: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Address: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Phone: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Title/Position: ____________________________________________');
$pdf->Ln(7);
// _____________________________________ END LEGAL



// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}

?>