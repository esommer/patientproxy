<?php
// INDIANA

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
	'prolong_set' => 'prolongLife_prolongLifeSet_fieldID_SET', // lpTreatment, lpTreatmentNo
	'nutrition_set' => 'nutrition_nutritionSet_fieldID_SET', // authorize, doNotAuthorize, authSurrogate
	'declare_freetext' => 'furtherDeclare_furtherDeclareSet_freeTextElement_fieldID',
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


// POWERS GRANTED
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Powers Granted to my Health Proxy');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'I grant my health proxy all powers available under Indiana Code, Title 16, Article 36, Chapter 1 to make health-care decisions for me in the event I am unable to make such decisions myself. These powers include, but are not limited to:');
$pdf->Ln(5);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(1) to consent to or refuse health care for me;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(2) to admit or release me from a hospital or health-care facility; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(3) to have access to my records, including medical records, concerning my condition.', 0, 'L');
$pdf->Ln(5);
$pdf->Write(5, 'I understand health care to include any medical care, treatment, service, or procedure to maintain, diagnose, treat, or provide for my physical or mental well-being. Health care also includes the providing of nutrition and hydration through intravenous, gastrostomy, or nasogastric tubes.');
$pdf->Ln(7);
$pdf->Write(5, 'I authorize my health proxy to make decisions in my best interest concerning withdrawal or withholding of health care. If at any time based on my previously expressed preferences and the diagnosis and prognosis, my health proxy is satisfied that certain health care is not or would not be beneficial or that such health care is or would be excessively burdensome, then my health proxy may express my will that such health care be withheld or withdrawn and may consent on my behalf that any or all health care be discontinued or not instituted, even if death may result.');
$pdf->Ln(7);
$pdf->Write(5, 'My health proxy must try to discuss this decision with me. However, if I am unable to communicate, my health proxy may make such a decision for me, after consultation with my physician or physicians and other relevant health-care givers. To the extent appropriate, my health proxy may also discuss this decision with my family and others to the extent they are available.');
$pdf->Ln(9);

// ADDITIONAL POWERS
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Additional Powers Granted to my Health Proxy as my Attorney-in-Fact (Notary Required)');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'If my signature of this document is witnessed by a notary public, I further grant my health proxy all powers available as my attorney-in-fact under Indiana Code 30-5-5-16 and 30-5-5-17 to make health-care decisions for me in the event I am unable to make such decisions myself, including, but not limited to:');
$pdf->Ln(5);
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(1) to employ or contract with servants, companions, or health care providers involved in my health care;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(2) to make anatomical gifts on my behalf;', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(3) to request an autopsy; and', 0, 'L');
$pdf->Ln(2);
$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
$pdf->MultiCell ( 150, 5, '(4) to make plans for the disposition of my body.', 0, 'L');
$pdf->Ln(9);

// REVOCATION
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, "Revocation of Health Proxy's Power and Appointment");
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'I may revoke the authority of my health proxy, including any powers granted to my health proxy as my attorney-in-fact, and all of the powers granted in this document, whenever I am capable of consenting to health care by notifying my health-care provider or my health proxy orally or in writing.');
$pdf->Ln(7);
$pdf->Write(5, 'I may revoke the appointment of my health proxy, and all of the powers granted in this document, whenever I am capable of consenting to health care by notifying my health proxy orally or in writing.');
$pdf->Ln(9);

// GUIDANCE
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Guidance for my Health Proxy');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, 'When making health-care decisions for me, my health proxy should think about what action would be consistent with past conversations we have had, my treatment preferences as expressed in this document, my religious and other beliefs and values, and how I have handled medical and other important issues in the past. If what I would decide is still unclear, then my health proxy should make decisions for me that my health proxy believes are in my best interest, considering the benefits, burdens, and risks of my current circumstances and treatment options.');
$pdf->Ln(7);

if ( !empty($instr_freetext) ) {
	$pdf->Write(5, 'In addition, my health-care should consider the following instructions in making health-care decisions on my behalf:');
	$pdf->Ln(5);
	$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
	$pdf->MultiCell(160, 5, "$instr_freetext", 0, 'L');
	$pdf->Ln(7);
}
// _____________________________________ END HEALTH PROXY


// ===================================== BEGIN DECLARATION OF WISHES
$pdf->Ln(5);
$pdf->SetTextColor ( 0, 0, 0 );
$pdf->SetFont ( 'Arial', 'B', '16' );
$pdf->Cell ( 0, 5, 'Declaration of Wishes', 0, 1, 'L' );
$pdf->SetFont ( 'Arial', '', 10 );

// PROLONG LIFE
if ( !empty($prolong_set) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Regarding Prolongment of Life');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, "I, $patient_full_name, being at least eighteen (18) years old and of sound mind, willfully and voluntarily exercise my right to determine the course of my health care and to provide clear and convincing proof of my treatment decisions. If at any time I have an incurable injury, disease, or illness determined to be a terminal condition and am unable to make decisions, I declare that:");
	$pdf->Ln(5);
	if ( in_array('lpTreatment', $prolong_set) ) {
		$pdf->Write(5, '(Life-Prolonging Procedures Declaration) I want the use of life-prolonging procedures that would extend my life under all circumstances. This includes appropriate nutrition and hydration, the administration of medication, and the performance of all other medical procedures necessary to extend my life, to provide comfort care, or to alleviate pain.');
		$pdf->Ln(7);
	} else {
		$pdf->Write(5, '(Living Will Declaration) I request that my dying shall not be artificially prolonged. If my death will occur within a short time and the use of life prolonging procedures would serve only to artificially prolong the dying process, I direct that such procedures be withheld or withdrawn, and that I be permitted to die naturally with only the performance or provision of any medical procedure or medication necessary to provide me with comfort care or to alleviate pain, and, if I have so indicated, the provision of artificially supplied nutrition and hydration.');
		$pdf->Ln(7);
	}
}

// NUTRITION
if ( !empty($nutrition_set) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Regarding Artificial Nutrition and Hydration');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('authorize', $nutrition_set) ) {
		$pdf->Write(5, 'I wish to receive artificially supplied nutrition and hydration, even if the effort to sustain life is futile or excessively burdensome to me.');
		$pdf->Ln(7);
	} else if ( in_array('doNotAuthorize', $nutrition_set) ) {
		$pdf->Write(5, 'I do not wish to receive artificially supplied nutrition and hydration, if the effort to sustain life is futile or excessively burdensome to me.');
		$pdf->Ln(7);
	} else {
		$pdf->Write(5, 'I intentionally make no decision concerning artificially supplied nutrition and hydration, leaving the decision to my health proxy appointed under Indiana Code 16-36-1-7 or my attorney-in- fact with health-care powers under Indiana Code 30-5-5.');
		$pdf->Ln(7);
	}
}

// FURTHER DECLARATIONS
if ( !empty($declare_freetext) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Further Declarations');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	$pdf->Write(5, "$declare_freetext");
	$pdf->Ln(7);
}
$pdf->Write(5, 'In the absence of my ability to give directions regarding the use of life-prolonging procedures, it is my intention that this declaration be honored by my family and physician as the final expression of my legal right to refuse medical or surgical treatment and accept the consequences of the refusal. My health proxy, under Indiana Code 16-36-1-7 or my attorney-in-fact, under Indiana Code 30-5-5, if I have appointed one, is responsible for interpreting this declaration if there is a disagreement as to its applicability.');
$pdf->Ln(9);
// _____________________________________ END DECLARATION OF WISHES


// ===================================== BEGIN ORGAN DONATION
if ( !empty($orgdon_set) ) {
	$pdf->Ln(5);
	$pdf->SetFont ( 'Arial', '', '14' );
	$pdf->Write(5, 'Regarding Organ Donation');
	$pdf->Ln(7);
	$pdf->SetFont ( 'Arial', '', '10' );
	if ( in_array('refuseToDonate', $orgdon_set) ) {
		$pdf->Write(5, 'I do not want to make an organ or tissue donation and I do not want my attorney for health care, proxy, or other agent or family to do so.');
		$pdf->Ln(7);
	} else if ( in_array('writtenSigned', $orgdon_set) ) {
		$pdf->Write(5, 'I have already signed a written agreement or donor card regarding organ and tissue donation with the following individual or institution:');
		if ( !empty($orgdon_signed_freetext) ) {
			$pdf->Write(5, " $orgdon_signed_freetext");
		} else {
			$pdf->Write(5, ' ______________________________');
		}
	} else {
		$pdf->Write(5, 'Pursuant to Indiana law, I hereby give, effective on my death ');
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
$pdf->Write(5, 'Witness 1');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "The declarant has been personally known to me, and I believe (him/her) to be of sound mind. I am competent and at least eighteen (18) years old. I further attest that I did not sign the declarant's signature above for or at the direction of the declarant. I am not a parent, spouse, or child of the declarant. I am not entitled to any part of the declarant's estate or directly financially responsible for the declarant's medical care.");
$pdf->Ln(7);
$pdf->Write(5,'Signature of Witness: _____________________________________');
$pdf->Ln(7);
$pdf->Write(5,'Date: _____________________');
$pdf->Ln(7);
$pdf->Write(5,'Witness printed name: ____________________________________________');
$pdf->Ln(7);
$pdf->Ln(5);
$pdf->SetFont ( 'Arial', '', '14' );
$pdf->Write(5, 'Witness 2');
$pdf->Ln(7);
$pdf->SetFont ( 'Arial', '', '10' );
$pdf->Write(5, "The declarant has been personally known to me, and I believe (him/her) to be of sound mind. I am competent and at least eighteen (18) years old. I further attest that I did not sign the declarant's signature above for or at the direction of the declarant. I am not a parent, spouse, or child of the declarant. I am not entitled to any part of the declarant's estate or directly financially responsible for the declarant's medical care.");
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