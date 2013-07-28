<?php
// OREGON

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
	'limits_freetext' => 'limitations_limitSet_freeTextElement_fieldID',
	'limits_honor_set' => 'limitations_honorLivingWillSet_fieldID_SET', // honorLivingWill
	'limits_ls_set' => 'limitations_lifeSupportSet_fieldID_SET', // lifeSupport
	'limits_tf_set' => 'limitations_tubeFeedingSet_fieldID_SET', // tubeFeeding
	'close_ls_set' => 'closeToDeath_tFSet_fieldID_SET', // tFYes, tFMD, tFNo
	'close_tf_set' => 'closeToDeath_lSSet_fieldID_SET', // lSYes, lSMD, lSNo
	'perm_ls_set' => 'permanentlyUnconscious_tFSet_fieldID_SET', // tFYes, tFMD, tFNo
	'perm_tf_set' => 'permanentlyUnconscious_lSSet_fieldID_SET', // lSYes, lSMD, lSNo
	'adv_ls_set' => 'advancedProgIllness_tFSet_fieldID_SET', // tFYes, tFMD, tFNo
	'adv_tf_set' => 'advancedProgIllness_lSSet_fieldID_SET', // lSYes, lSMD, lSNo
	'ext_ls_set' => 'extraordinarySuffering_tFSet_fieldID_SET', // tFYes, tFMD, tFNo
	'ext_tf_set' => 'extraordinarySuffering_lSSet_fieldID_SET', // lSYes, lSMD, lSNo
	'gen_nat_set' => 'generalInstructions_dieNaturallySet_fieldID_SET', // dieNaturally
	'gen_freetext' => 'generalInstructions_freeTextElementSet_freeTextElement_fieldID',
	'otherdocs_set' => 'otherDocuments_otherDocumentsSet_fieldID_SET', // previouslySigned, revokeIt, noPrevious
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
$pdf->Ln(9);
	}
// _____________________________________ END HEALTH PROXY



// ===================================== BEGIN LIMITATIONS

if ( !empty($limits_freetext) ) {
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Limits');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, "Special Conditions or Instructions: $limits_freetext");
	$pdf->Ln(7);
}
if ( !empty($limits_honor_set) ) {
	$pdf->Write(5, 'I have executed a Health Care Instruction or Directive to Physicians. My representative is to honor it.');
	$pdf->Ln(7);
}

// LIFE SUPPORT
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Life Support');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, '"Life support" refers to any medical means for maintaining life, including procedures, devices and medications. If you refuse life support, you will still get routine measures to keep you clean and comfortable.');
$pdf->Ln(7);
if ( !empty($limits_ls_set) ) {
	$pdf->Write(5, 'My representative MAY decide about life support for me.');
} else {
	$pdf->Write(5, 'My representative MAY NOT decide about life support for me.');
}

// TUBE FEEDING
$pdf->Ln(9);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Tube Feeding');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'One sort of life support is food and water supplied artificially by medical device, known as tube feeding.');
$pdf->Ln(7);
if ( !empty($limits_ls_set) ) {
	$pdf->Write(5, 'My representative MAY decide about tube feeding for me.');
} else {
	$pdf->Write(5, 'My representative MAY NOT decide about tube feeding for me.');
}

// HEALTH CARE INSTRUCTIONS
if ( !empty($close_ls_set) || !empty($close_tf_set) || !empty($perm_ls_set) || !empty($perm_tf_set) || !empty($adv_ls_set) || !empty($adv_tf_set) || !empty($ext_ls_set) || !empty($ext_tf_set) ) {
	$pdf->Ln(9);
	$pdf->Write(5, 'Here are my desires about my health care if my doctor and another knowledgeable doctor confirm that I am in a medical condition described below:');
	$pdf->Ln(7);
	// CLOSE TO DEATH
	if ( !empty($close_ls_set) || !empty($close_tf_set) ) {
		$pdf->SetFont('Arial', '', '14');
		$pdf->Write(5, 'Close to Death');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If I am close to death and life support would only postpone the moment of my death:');
		if ( !empty($close_tf_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('tFYes', $close_tf_set) ) {
				$pdf->Write(5, 'I want to receive tube feeding.');
			} else if ( in_array('tfMD', $close_tf_set) ) {
				$pdf->Write(5, 'I want tube feeding only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I DO NOT WANT tube feeding.');
			}
		}
		if ( !empty($close_ls_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('lSYes', $close_ls_set) ) {
				$pdf->Write(5, 'I want any other life support that may apply.');
			} else if ( in_array('lSMD', $close_ls_set) ) {
				$pdf->Write(5, 'I want life support only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I want NO life support.');
			}
		}
		$pdf->Ln(9);
	}
	// PERMANENTLY UNCONSCIOUS
	if ( !empty($perm_ls_set) || !empty($perm_tf_set) ) {
		$pdf->SetFont('Arial', '', '14');
		$pdf->Write(5, 'Permanently Unconscious');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If I am unconscious and it is very unlikely that I will ever become conscious again:');
		if ( !empty($perm_tf_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('tFYes', $perm_tf_set) ) {
				$pdf->Write(5, 'I want to receive tube feeding.');
			} else if ( in_array('tfMD', $perm_tf_set) ) {
				$pdf->Write(5, 'I want tube feeding only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I DO NOT WANT tube feeding.');
			}
		}
		if ( !empty($perm_ls_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('lSYes', $perm_ls_set) ) {
				$pdf->Write(5, 'I want any other life support that may apply.');
			} else if ( in_array('lSMD', $perm_ls_set) ) {
				$pdf->Write(5, 'I want life support only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I want NO life support.');
			}
		}
		$pdf->Ln(9);
	}
	// ADVANCED PROGRESSIVE ILLNESS
	if ( !empty($adv_ls_set) || !empty($adv_tf_set) ) {
		$pdf->SetFont('Arial', '', '14');
		$pdf->Write(5, 'Advanced Progressive Illness');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If I have a progressive illness that will be fatal and the illness is in an advanced stage, and I am consistently and permanently unable to communicate, swallow food and water safely, care for myself and recognize my family and other people, and it is very unlikely that my condition will substantially improve:');
		if ( !empty($adv_tf_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('tFYes', $adv_tf_set) ) {
				$pdf->Write(5, 'I want to receive tube feeding.');
			} else if ( in_array('tfMD', $adv_tf_set) ) {
				$pdf->Write(5, 'I want tube feeding only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I DO NOT WANT tube feeding.');
			}
		}
		if ( !empty($adv_ls_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('lSYes', $adv_ls_set) ) {
				$pdf->Write(5, 'I want any other life support that may apply.');
			} else if ( in_array('lSMD', $adv_ls_set) ) {
				$pdf->Write(5, 'I want life support only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I want NO life support.');
			}
		}
		$pdf->Ln(9);
	}
	// EXTRAORDINARY SUFFERING
	if ( !empty($ext_ls_set) || !empty($ext_tf_set) ) {
		$pdf->SetFont('Arial', '', '14');
		$pdf->Write(5, 'Extraordinary Suffering');
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 10);
		$pdf->Write(5, 'If life support would not help my medical condition and would make me suffer permanent and severe pain:');
		if ( !empty($ext_tf_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('tFYes', $ext_tf_set) ) {
				$pdf->Write(5, 'I want to receive tube feeding.');
			} else if ( in_array('tfMD', $ext_tf_set) ) {
				$pdf->Write(5, 'I want tube feeding only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I DO NOT WANT tube feeding.');
			}
		}
		if ( !empty($ext_ls_set) ) {
			$pdf->Ln();
			$pdf->Cell(10, 5);
			if ( in_array('lSYes', $ext_ls_set) ) {
				$pdf->Write(5, 'I want any other life support that may apply.');
			} else if ( in_array('lSMD', $ext_ls_set) ) {
				$pdf->Write(5, 'I want life support only as my physician recommends.');
			} else {
				$pdf->Write(5, 'I want NO life support.');
			}
		}
		$pdf->Ln(9);
	}
}	

if ( !empty($gen_nat_set) ) {
	$pdf->SetFont('Arial', '', '14');
	$pdf->Write(5, 'General Instructions');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 10);
	$pdf->Write(5, 'I do not want my life to be prolonged by life support. I also do not want tube feeding as life support. I want my doctors to allow me to die naturally if my doctor and another knowledgeable doctor confirm I am in any of the medical conditions listed above.');
	$pdf->Ln(9);
}

if ( !empty($gen_freetext) ) {
	$pdf->SetFont('Arial', '', '14');
	$pdf->Write(5, 'Additional Conditions or Instructions:');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(10, 5);
	$pdf->MultiCell(150, 5, "$gen_freetext", 0, 'L');
	$pdf->Ln(9);
}

if ( !empty($otherdocs_set) ) {
	$pdf->SetFont('Arial', '', '14');
	$pdf->Write(5, 'Other Documents');
	$pdf->Ln();
	$pdf->SetFont('Arial', '', 10);
	if ( in_array('previouslySigned', $otherdocs_set) ) {
		$pdf->Write(5, 'I have previously signed a health care power of attorney. I want it to remain in effect.');
	} else if ( in_array('revokeIt', $otherdocs_set) ) {
		$pdf->Write(5, 'I have a health care power of attorney, and I REVOKE IT.');
	} else {
		$pdf->Write(5, 'I DO NOT have a health care power of attorney.');
	}
}
// _____________________________________ END LIMITATIONS



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
		$pdf->Write(5, 'Pursuant to Oregon law, I hereby give, effective on my death ');
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
$pdf->Write(5, "I, $patient_full_name, the principal and/or declarant, sign my name or direct another person to sign my name to this instrument, and do hereby declare to the undersigned witness(es) that I sign it willingly, and I execute it as my free and voluntary act for the purposes herein expressed, and that I am of sound mind, and under no constraint or undue influence. I understand the full importance of this declaration.");
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
$pdf->Write(5, 'Witnesses');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "We declare that the person signing this advance directive:");
$pdf->Ln();
$pdf->Cell(10,5);
$pdf->MultiCell(150, 5, '(a) Is personally known to us or has provided proof of identity;', 0, 'L');
$pdf->Ln();
$pdf->Cell(10,5);
$pdf->MultiCell(150, 5, '(b) Signed or acknowledged that person’s signature on this advance directive in our presence;', 0, 'L');
$pdf->Ln();
$pdf->Cell(10,5);
$pdf->MultiCell(150, 5, '(c) Appears to be of sound mind and not under duress, fraud or undue influence;', 0, 'L');
$pdf->Ln();
$pdf->Cell(10,5);
$pdf->MultiCell(150, 5, '(d) Has not appointed either of us as health care representative or alternative representative; and', 0, 'L');
$pdf->Ln();
$pdf->Cell(10,5);
$pdf->MultiCell(150, 5, '(e) Is not a patient for whom either of us is attending physician.', 0, 'L');
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

// ACCEPTANCE OF PROXIES
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Acceptance of Representatives');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "I accept this appointment and agree to serve as health care representative. I understand I must act consistently with the desires of the person I represent, as expressed in this advance directive or otherwise made known to me. I understand that this document allows me to decide about that person's health care only while that person cannot do so. I understand that the person who appointed me may revoke this appointment. If I learn that this document has been suspended or revoked, I will inform the person's current health care provider if known to me. If I do not know the desires of the person I represent, I have a duty to act in what I believe in good faith to be that person's best interest.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Health Care Representative: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Health Care Representative printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Signature of Alternate Health Care Representative: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Alternate Health Care Representative printed name: ____________________________________________');
$pdf->Ln(7);
// _____________________________________ END LEGAL


// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}
?>