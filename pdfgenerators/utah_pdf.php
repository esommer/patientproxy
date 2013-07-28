<?php
// UTAH


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
    'patient_address' => 'patientInfo_patientData_streetAddress_fieldID',
	'patient_city' => 'patientInfo_patientData_city_fieldID',
	'patient_us_state_abbrev' => 'patientInfo_patientData_usStateReq_fieldID',
	'patient_zip' => 'patientInfo_patientData_zip_fieldID',
	'patient_birth_date' => 'patientInfo_patientData_birthDate_fieldID',
	'patient_phone' => 'patientInfo_patientData_phone_fieldID',
	'patient_cellphone' => 'patientInfo_patientData_cellPhone_fieldID',
	'hp_no_agent_set' => 'healthProxy_personData_fieldID_SET', // noAgent
	'hp_fullname' => 'healthProxy_personData_fullName_fieldID',
	'hp_address' => 'healthProxy_personData_streetAddress_fieldID',
	'hp_city' => 'healthProxy_personData_city_fieldID',
	'hp_state' => 'healthProxy_personData_usState_fieldID',
	'hp_zip' => 'healthProxy_personData_zip_fieldID',
	'hp_phone' => 'healthProxy_personData_phone_fieldID',
	'hp_cellphone' => 'healthProxy_personData_cellPhone_fieldID',
	'althp_fullname' => 'healthProxy_alternatePersonData_fullName_fieldID',
	'althp_address' => 'healthProxy_alternatePersonData_streetAddress_fieldID',
	'althp_city' => 'healthProxy_alternatePersonData_city_fieldID',
	'althp_state' => 'healthProxy_alternatePersonData_usState_fieldID',
	'althp_zip' => 'healthProxy_alternatePersonData_zip_fieldID',
	'althp_phone' => 'healthProxy_alternatePersonData_phone_fieldID',
	'althp_cellphone' => 'healthProxy_alternatePersonData_cellPhone_fieldID',
	'agentauth_medrecs_set' => 'agentAuthority_medicalRecords_fieldID_SET', // Y/N
	'agentauth_adminset_set' => 'agentAuthority_admissionSet_fieldID_SET', // Y/N
	'agentauth_expand_freetext' => 'agentAuthority_expandPowersSet_expandPowers_fieldID',
	'guardianship_set' => 'guardianship_guardianship_fieldID_SET', // Y/N
	'resdon_med_set' => 'researchDonation_medicalResearch_fieldID_SET', // Y/N
	'resdon_org_set' => 'researchDonation_organDonation_fieldID_SET', // Y/N
	'lw_set' => 'livingWill_livingWillSet_fieldID_SET', // agentDecision, prolongLife, notProlongLife, noPreference
	'lw_override_set' => 'livingWill_overrideSet_fieldID_SET', // Y/N
	'lw_limits_set' => 'livingWill_livingWillSet_notProlongLife_fieldID_limitationsSet_fieldID_SET', // noLimit, oneCondition
	'lw_limits_condition_set' => 'livingWill_livingWillSet_notProlongLife_fieldID_limitationsSet_oneCondition_fieldID_oneConditionSet_fieldID_SET', // progressiveIllness, closeToDeath, cannotCommunicate, recognition, vegetativeState
	'od_set' => 'organDonation_organDonationSet_fieldID_SET', // refuseToDonate, wishToDonate
	'od_gift_set' => 'organDonation_organDonationSet_wishToDonate_fieldID_givingSet_fieldID_SET', // anyOrgan, onlyTheFollowing
	'od_gift_freetext' => 'organDonation_organDonationSet_wishToDonate_fieldID_givingSet_wishToDonate_fieldID_specifyOrgansSet_specifyOrgans_fieldID',
	'addl_instr_freetext' => 'additionalInstructions_additionalInstructionsSet_instructions_fieldID'
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
if ( empty($hp_no_agent_set) ) {
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
		$pdf->Write ( 5, "I, $patient_full_name, hereby appoint the following person as my health proxy. In the event that this person is unable, unwilling, or reasonably unavailable to act as my agent, I hereby appoint my alternate. " );
		}
	// else if at least one is set
	else if ( !empty ( $hp_fullname ) && empty ( $althp_fullname ) ) {
		$whatSet = 'just proxy';
		$pdf->Write ( 5, "I, $patient_full_name, hereby appoint the following person as my health proxy. " );
		}
	else if ( empty ( $hp_fullname ) && !empty ( $althp_fullname ) ) {
		$whatSet = 'just alt';
		$pdf->Write ( 5, "I, $fullName, hereby appoint the following person as my health proxy. " );
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
	$pdf->Ln ( 8 );
		}
	
	// PROXY'S POWER
	$pdf->Write ( 5, 'If I cannot make decisions or speak for myself (in other words, after my physician or APRN finds that I lack health care decision making capacity), my agent has the power to make any health care decision I could have made such as, but not limited to:' );
	$pdf->Ln( 7 );
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Consent to, refuse, or withdraw any health care. This may include care to prolong my life such as food and fluids by tube, use of antibiotics, CPR (cardiopulmonary resuscitation), and dialysis, and mental health care, such as convulsive therapy and psychoactive medications. This authority is subject to any limitations listed below.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Hire and fire health care providers.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Ask questions and get answers from health care providers.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Consent to admission or transfer to a health care provider or health care facility, including a mental health facility, subject to any limitations listed below.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Get copies of my medical records.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
	$pdf->MultiCell ( 150, 5, 'Ask for consultations or second opinions.', 0, 'L' );
	$pdf->Ln ( 2);
	$pdf->Write ( 5, 'My agent cannot force health care against my will, even if a physician has found that I lack health care decision making capacity.' );
	$pdf->Ln(7);
	
	// AGENT AUTHORITY
	//if ( in_array('radioYes', $agentauth_medrecs_set) || in_array('radioYes', $agentauth_adminset_set) || !empty($agentauth_expand_freetext) ) {
	//if ( !empty($agentauth_medrecs_set) || !empty($agentauth_adminset_set) || !empty($agentauth_expand_freetext) ) {
		$pdf->Ln(10);
		$pdf->SetFont ( 'Arial', 'B', '16' );
		$pdf->Cell ( 0, 5, 'Agent Authority', 0, 1, 'L' );
		$pdf->Ln ( 5 );
		$pdf->SetFont ( 'Arial', '', 10 );
	//}
	if ( !empty($agentauth_medrecs_set) ) {
		if ( in_array('radioYes', $agentauth_medrecs_set) ) {
			$pdf->Write(5,'My agent may get copies of my medical records at any time, even when I can speak for myself.');
			$pdf->Ln(7);
		} else {
			$pdf->Write(5,'My agent may NOT get copies of my medical records at any time.');
			$pdf->Ln(7);
		}
	}
	if ( !empty($agentauth_adminset_set) ) {
		if ( in_array('radioYes', $agentauth_adminset_set) ) {
			$pdf->Write(5,'My agent may admit me to a licensed health care facility, such as a hospital, nursing home, assisted living, or other congregate facility for long-term placement other than convalescent or recuperative care, if I agree to be admitted at that time.');
			$pdf->Ln(7);
		} else {
			$pdf->Write(5, 'My agent may NOT admit me to a licensed health care facility, such as a hospital, nursing home, assisted living, or other congregate facility for long-term placement other than convalescent or recuperative care.');
			$pdf->Ln(7);
		}
	}
	if ( !empty($agentauth_expand_freetext) ) {
		$pdf->Write(5,'Other powers or restrictions of my agent include:'); 
		$pdf->Ln(7);
		$pdf->Cell( 10, 5, '', 0, 0, 'R' );
		$pdf->Write(5,"$agentauth_expand_freetext");
		$pdf->Ln(7);
	}
	if ( !empty($guardianship_set) ) {
		if ( in_array('radioYes', $guardianship_set) ) {
			$pdf->Write(5,'I, being of sound mind and not under duress, fraud, or other undue influence, do hereby nominate my agent, or if my agent is unable or unwilling to serve, I hereby nominate my alternate agent, to serve as my guardian in the event that, after the date of this instrument, I become incapacitated.');
			$pdf->Ln(7);
		} else {
			$pdf->Write(5, 'I, being of sound mind and not under duress, fraud, or other undue influence, do NOT nominate my agent or anyone else to serve as my guardian in the event that, after the date of this instrument, I become incapacitated.');
			$pdf->Ln(7);
		}
	}
	if ( !empty($resdon_med_set) ) {
		if ( in_array('radioYes', $resdon_med_set) ) {
			$pdf->Write(5,'I authorize my agent to consent to my participation in medical research or clinical trials, even if I may not benefit from the results.');
			$pdf->Ln(7);
		} else {
			$pdf->Write(5,'I do NOT authorize my agent to consent to my participation in medical research or clinical trials, whether or not I may benefit from the results.');
			$pdf->Ln(7);
		}
	}
	if ( !empty($resdon_org_set) ) {
		if ( in_array('radioYes', $resdon_org_set) ) {
			$pdf->Write(5,'If I have not otherwise agreed to organ donation, my agent may consent to the donation of my organs for the purpose of organ transplantation.');
			$pdf->Ln(7);
		} else {
			$pdf->Write(5,'If I have not otherwise agreed to organ donation, my agent may NOT consent to the donation of my organs for the purpose of organ transplantation.');
			$pdf->Ln(7);
		}
	}
}
// _____________________________________ END HEALTH PROXY


// ===================================== BEGIN LIVING WILL
// LIVING WILL SET
if ( !empty($lw_set) ) {
	$pdf->Ln(10);
	$pdf->SetFont ( 'Arial', 'B', '16' );
	$pdf->Cell ( 0, 5, 'Living Will', 0, 1, 'L' );
	$pdf->Ln ( 5 );
	$pdf->SetFont ( 'Arial', '', 10 );
	$pdf->Write ( 5, 'I want my health care providers to follow the instructions I give them when I am being treated, even if my instructions conflict with these or other advance directives. My health care providers should always provide health care to keep me as comfortable and functional as possible.' );
	$pdf->Ln( 7 );
	if ( in_array('agentDecision', $lw_set) ) {
		$pdf->SetFont ( 'Arial', 'B', 10 );
		$pdf->Write (5, 'I choose to let my agent make decisions. ');
		$pdf->SetFont ('Arial', '', 10);
		$pdf->Write(5, 'I have chosen my agent carefully. I have talked with my agent about my health care wishes. I trust my agent to make the health care decisions for me that I would make under the circumstances.');
		$pdf->Ln(7);
	}
	if ( in_array('prolongLife', $lw_set) ) {
		$pdf->SetFont ( 'Arial', 'B', 10 );
		$pdf->Write (5, 'I choose to prolong my life. ');
		$pdf->SetFont ('Arial', '', 10);
		$pdf->Write(5, 'Regardless of my condition or prognosis, I want my health care team to try to prolong my life as long as possible within the limits of generally accepted health care standards.');
		$pdf->Ln(7);
	}
	if ( in_array('notProlongLife', $lw_set) ) {
		$pdf->SetFont ( 'Arial', 'B', 10 );
		$pdf->Write (5, 'I choose not to receive care for the purpose of prolonging life. ');
		$pdf->SetFont ('Arial', '', 10);
		$pdf->Write(5, 'This includes food and fluids by tube, antibiotics, CPR, or dialysis being used to prolong my life. I always want comfort care and routine medical care that will keep me as comfortable and functional as possible, even if that care may not prolong my life.');
		$pdf->Ln(5);	
		if ( !empty($lw_limits_set) ) {
			if ( in_array('noLimit', $lw_limits_set) ) {
				$pdf->Write(5, 'I put no limit on the ability of my health care provider or agent to withhold or withdraw life-sustaining care.');
				$pdf->Ln(7);
			}
			if ( in_array('oneCondition', $lw_limits_set) ) {
				$pdf->Ln(2);
				$pdf->Write (5, 'My health care provider should withhold or withdraw life-sustaining care if at least one of the following conditions is met:');
				$pdf->Ln(5);
				if ( !empty($lw_limits_condition_set) ) {
					if ( in_array('progressiveIllness', $lw_limits_condition_set) ) {
						$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
						$pdf->Write(5, 'I have a progressive illness that will cause death.');
						$pdf->Ln(5);
					}
					if ( in_array('closeToDeath', $lw_limits_condition_set) ) {
						$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
						$pdf->Write(5, 'I am close to death, and I am unlikely to recover.');
						$pdf->Ln(5);
					}
					if ( in_array('cannotCommunicate', $lw_limits_condition_set) ) {
						$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
						$pdf->Write(5, 'I cannot communicate, and it is unlikely that my condition will improve.');
						$pdf->Ln(5);
					}
					if ( in_array('recognition', $lw_limits_condition_set) ) {
						$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
						$pdf->Write(5, 'I do not recognize my friends or family, and it is unlikely that my condition will improve.');
						$pdf->Ln(5);
					}
					if ( in_array('vegetativeState', $lw_limits_condition_set) ) {
						$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
						$pdf->Write(5, 'I am in a persistent vegetative state.');
						$pdf->Ln(5);
					}
				}
			}
		}
	}
	if ( in_array('noPreference', $lw_set) ) {
		$pdf->SetFont ( 'Arial', 'B', 10 );
		$pdf->Write (5, 'I do NOT wish to express preferences about end-of-life health care wishes in this Directive. ');
		$pdf->SetFont ('Arial', '', 10);
		$pdf->Ln(7);	
	}
}

// ORGAN DONATION
if ( !empty($od_set) ) {
	if ( in_array('refuseToDonate', $od_set) ) {
		$pdf->Write (5, 'I do not want to be an organ donor.');
		$pdf->Ln(7);
	}
	if ( in_array('wishToDonate', $od_set) ) {
		$pdf->Write(5, 'I want to be an organ donor. In the event of my death I request that my agent inform my family/next of kin of my desires to be an organ and tissue donor if possible.');
		if ( !empty($od_gift_set) ) {
			$pdf->Write(5,' I wish to give ');
			if ( in_array('anyOrgan', $od_gift_set) ) {
				$pdf->Write(5,'any organs/tissues.');
				$pdf->Ln(7);
			} else {
				$pdf->Write(5,'only the following organs/tissues:');
				$pdf->Ln(7);
				if ( !empty($od_gift_freetext) ) {
					$pdf->Cell( 10, 5, '', 0, 0, 'R' );
					$pdf->Write(5, "$od_gift_freetext");
					$pdf->Ln(7);
				} else {
					$pdf->Cell( 10, 5, '', 0, 0, 'R' );
					$pdf->Write(5, '________________________________________________________________');
					$pdf->Ln(7);
				}
			}
		}
	}
}

// ADDITIONAL INSTRUCTIONS
if ( !empty($addl_instr_freetext) ) {
	$pdf->Write(5, "$addl_instr_freetext");
	$pdf->Ln(7);
}
// _____________________________________ END LIVING WILL

// REVOCATION
$pdf->Ln(10);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Revocation of Directive', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, 'I may revoke or change this Directive by:');
$pdf->Ln(7);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '1. Writing "void" across the form, or burning, tearing, or otherwise destroying or defacing this document or directing another person to do the same on my behalf;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '2. Signing a written revocation of the Directive, or directing another person to sign a written revocation on my behalf;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '3. Stating that I wish to revoke the Directive in the presence of a witness who is 18 years of age or older; will not be appointed as my agent in a substitute directive; will not become a default surrogate if the Directive is revoked; and signs and dates a written document confirming my statement;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '4. Signing a new directive. (If you sign more than one Advance Health Care Directive, the most recent one applies.)', 0, 'L');
$pdf->Ln(2);
$pdf->Write(5,'Note: If you do not want emergency medical services providers to provide CPR or other life sustaining measures, you must work with a physician or APRN to complete an order that reflects your wishes on a form approved by the Utah Department of Health.');
$pdf->Ln(7);

// SIGNATURE
$pdf->Ln(10);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Signature', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5, "I, $patient_full_name, sign this Directive voluntarily. I understand the choices I have made and declare that I am emotionally and mentally competent to make this Directive. My signature on this form revokes any living will or power of attorney form, naming a health care agent, that I have completed in the past.");
$pdf->Ln(7);
$pdf->Write(5, 'Signature: ______________________________________________');
$pdf->Ln(7);
$pdf->Write(5, 'Date: _______________________');
$pdf->Ln(7);
$pdf->Write(5, 'City, County, and State of Residence: ________________________________________');
$pdf->Ln(7);

// WITNESSES
$pdf->Ln(10);
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Witnesses', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'Arial', '', 10 );
$pdf->Write(5,'I have witnessed the signing of this Directive, I am 18 years of age or older, and I am not:');
$pdf->Ln(7);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '1. Related to the declarant by blood or marriage;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, "2. Entitled to any portion of the declarant's estate according to the laws of intestate succession of any state or jurisdiction or under any will or codicil of the declarant;", 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '3. A beneficiary of a life insurance policy, trust, qualified plan, pay on death account, or transfer on death deed that is held, owned, made, or established by, or on behalf of, the declarant;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '4. Entitled to benefit financially upon the death of the declarant;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '5. Entitled to a right to, or interest in, real or personal property upon the death of the declarant;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, "6. Directly financially responsible for the declarant's medical care;", 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, '7. A health care provider who is providing care to the declarant or an administrator at a health care facility in which the declarant is receiving care;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell(160, 5, 'or 8. The appointed agent or alternate agent.', 0, 'L');
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'If the witness is signing to confirm an oral directive, describe below the circumstances under which the directive was made:');
$pdf->Ln(7);
$pdf->Write(5,'_____________________________________________________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'_____________________________________________________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'_____________________________________________________________________________________');
// _____________________________________ END LEGAL



// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}

?>