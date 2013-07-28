<?php
// GENERAL STATE

session_start();
if ($output_s == false ) {
require_once ( '../extensions/fpdf/pdfadd.php' );
}

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
$pdf->AddFont('CrimsonText-Roman', '', 'CrimsonText-Roman.php');
$pdf->AddFont('CrimsonText-Semibold', '', 'CrimsonText-Semibold.php');
$pdf->SetFont('CrimsonText-Roman', '', 12);
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
	'auth_recs_set' => 'authHealthRecs_authRecsSet_fieldID_SET', // authRecs, authRecsImmediate
	'auth_recs_contradict_set' => 'authHealthRecs_contradictionSet_fieldID_SET', //contradict, noContradict
	'lw_apply_set' => 'livingWillApply_lwApplySet_fieldID_SET', // lwPostponeDeath, lwComaVeg, lwNoCommunicate, lwTerminal, lwOther
	'lw_other_freetext' => 'livingWillApply_lwApplySet_lwOther_fieldID_freeTextSet_freeText_fieldID',
	'ls_set' => 'lifeSustainTrmt_lifeSusSet_fieldID_SET', // lsAll, lsOnlyImprove, lsWithhold, lsComfort
	'ls_withhold_set' => 'lifeSustainTrmt_lifeSusSet_lsWithhold_fieldID_lsWithholdSet_fieldID_SET', // lsNoCPR, lsNoDialysis, lsNoSurgery, lsNoIntub, lsNoDrugs, lsNoElecFib, lsNoOther
	'ls_whset_noother_freetext' => 'lifeSustainTrmt_lifeSusSet_lsWithhold_fieldID_lsWithholdSet_lsNoOther_fieldID_freeTextSet_freeText_fieldID',
	'ls_whset_trialintub_set' => 'lifeSustainTrmt_lifeSusSet_lsWithhold_fieldID_trialIntubSet_fieldID_SET',
	'anh_set' => 'artNutrHydr_artNutHydSet_fieldID_SET', // anhMostEffect, anhAvoid, anhNone, anhSpecify
	'anh_avoid_set' => 'artNutrHydr_artNutHydSet_anhAvoid_fieldID_anhAvoidSet_fieldID_SET', // anhNoNoseMouth, anhNoSurgInsert, anhNoIV
	'anh_specify_freetext' => 'artNutrHydr_artNutHydSet_anhSpecify_fieldID_freeTextSet_freeText_fieldID',
	'ps_set' => 'painSuffer_painSufferSet_fieldID_SET', // psMaxConscious, psContact, psMinSuffer, psOwnWords
	'ps_ownwords_freetext' => 'painSuffer_painSufferSet_psOwnWords_fieldID_freeTextSet_freeText_fieldID',
	'ownwords_freetext' => 'ownWords_freeTextSet_freeText_fieldID',
	'od_set' => 'organDonation_orgDonSet_fieldID_SET', // orgDonNone, orgDonAny, orgDonSpecify
	'od_specify_freetext' => 'organDonation_orgDonSet_orgDonSpecify_fieldID_freeTextSet_freeText_fieldID',
	'od_purp_set' => 'organDonation_odPurposeSet_fieldID_SET', // odTransplant, odTherapy, odResearch, odEducation
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
$pdf->SetFont ( 'CrimsonText-Roman', '', 14 );
$pdf->Cell ( 0, 5, "$patient_full_name", 0, 1, 'R' );
$pdf->SetFont( 'CrimsonText-Roman', '', 12 );

// BIRTHDATE
if ( !empty ( $patient_birth_date ) ) {
	$pdf->SetFont ( 'CrimsonText-Roman', '', 14 );
	$pdf->SetTextColor ( 150, 150, 150 );
	$pdf->Cell ( 0, 5, "(DOB: $patient_birth_date)", 0, 1, 'R' );
	$pdf->SetFont( 'CrimsonText-Roman', '', 12 );
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
$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
if ( !empty($patient_full_name) || !empty($patient_birth_date) || !empty($patient_us_state_abbrev) || !empty($hp_fullname) || !empty($hp_address) || !empty($hp_city) || !empty($hp_state) || !empty($hp_zip) || !empty($hp_phone) || !empty($hp_cellphone) || !empty($hp_email) || !empty($althp_fullname) || !empty($althp_address) || !empty($althp_city) || !empty($althp_state) || !empty($althp_zip) || !empty($althp_phone) || !empty($althp_cellphone) || !empty($althp_email) || !empty($auth_recs_set) || !empty($auth_recs_contradict_set) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', '16' );
	$pdf->SetTextColor (86,22,118);
	$pdf->Cell ( 0, 5, 'Health Proxy', 0, 1, 'L' );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 5 );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->Write ( 5, 'This document shall take effect in the event that I become unable to make or communicate my health care decisions. ' );
}
// ACCESS TO HEALTH RECORDS
if ( !empty($auth_recs_set) ) {
	$pdf->Write ( 5, 'I authorize my health proxy to get access to all my health records' );
	if ( in_array('authRecs', $auth_recs_set) ) {
		$pdf->Write ( 5, ' once this directive becomes active.' );
	} else if ( in_array('authRecsImmediate', $auth_recs_set) ) {
		$pdf->Write(5,' immediately upon execution of this directive.');
	}
	$pdf->Ln ( 8 );
}

// ALLOW CONTRADICT
if ( !empty($auth_recs_contradict_set) ) {
	$pdf->Write(5,'My health proxy should follow what health care instructions (life support, artificial nutrition and hydration, etc) I specify in this directive,');
	if ( in_array('contradict', $auth_recs_contradict_set) ) {
		$pdf->Write(5,' and may contradict those instructions upon their own judgement.');
	} else if ( in_array('noContradict', $auth_recs_contradict_set) ) {
		$pdf->Write(5,' and may not contradict those instructions.');
	}
	$pdf->Ln(8);
}

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
		$pdf->SetFont ( 'CrimsonText-Semibold', '', 14 );
		$pdf->SetTextColor (86,22,118);
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Cell ( 10, 5 );
		$pdf->Cell ( 50, 5, 'Alternate Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetTextColor (0,0,0);
		$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
		// names
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, "$hp_fullname" );
		$pdf->Cell ( 10, 5 );
		$pdf->Cell ( 50, 5, "$althp_fullname" );
		$pdf->Ln();
		// streets
		if ( !empty($hp_address) || !empty($althp_address) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_address" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_address" );
			$pdf->Ln();
		}
		// cities, states zips
		if ( !empty($hp_city) || !empty($hp_state) || !empty($hp_zip) || !empty($althp_city) || !empty($althp_state) || !empty($althp_zip) ) {
			$pdf->Cell ( 30, 5 );
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
			$pdf->Ln();
		}
		// phones
		if ( !empty($hp_phone) || !empty($althp_phone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_phone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_phone" );
			$pdf->Ln();
		}
		// cells
		if ( !empty($hp_cellphone) || !empty($althp_cellphone) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_cellphone" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_cellphone" );
			$pdf->Ln();
		}
		// emails
		if ( !empty($hp_email) || !empty($althp_email) ) {
			$pdf->Cell ( 30, 5 );
			$pdf->Cell ( 50, 5, "$hp_email" );
			$pdf->Cell ( 10, 5 );
			$pdf->Cell ( 50, 5, "$althp_email" );
			$pdf->Ln();
		}
		break;
	case 'just proxy':
		// heading
		$pdf->SetFont ( 'CrimsonText-Semibold', '', 14 );
		$pdf->SetTextColor (86,22,118);
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetTextColor (0,0,0);
		$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
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
		$pdf->SetFont ( 'CrimsonText-Semibold', '', 14 );
		$pdf->SetTextColor (86,22,118);
		$pdf->Cell ( 30, 5 );
		$pdf->Cell ( 50, 5, 'Health Proxy' );
		$pdf->Ln ( 6 );
		$pdf->SetTextColor (0,0,0);
		$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
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
	}
$pdf->Ln ( 8 );
// _____________________________________ END HEALTH PROXY


// ===================================== BEGIN LIVING WILL
if ( !empty($lw_apply_set) || !empty($lw_other_freetext) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', '16' );
	$pdf->SetTextColor (86,22,118);
	$pdf->Cell ( 0, 5, 'Living Will', 0, 1, 'L' );
	$pdf->Ln ( 5 );
	$pdf->SetTextColor (0,0,0);
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->Write ( 5, "I, $patient_full_name, being of sound mind, make this statement as a directive to be followed in any of the following circumstances:" );
	$pdf->Ln( 7 );
	if ( in_array ( 'lwPostponeDeath', $lw_apply_set ) ) {
		$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
		$pdf->MultiCell ( 150, 5, 'If my doctors reason I am close to death and life support would only postpone the moment of my death.', 0, 'L' );
		$pdf->Ln ( 2);
		}
	if ( in_array ( 'lwComaVeg', $lw_apply_set ) ) {
		$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
		$pdf->MultiCell ( 150, 5, 'If I am in a deep coma, persistent vegetative state, or have suffered other severe neurologic injury which my doctors reason is irreversible.', 0, 'L' );
		$pdf->Ln ( 2);
		}
	if ( in_array ( 'lwNoCommunicate', $lw_apply_set ) ) {
		$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
		$pdf->MultiCell ( 150, 5, 'If I am irreversibly demented to the point that I can no longer recognize my friends and family nor can I convey my wishes about medical care.', 0, 'L' );
		$pdf->Ln ( 2);
		}
	if ( in_array ( 'lwTerminal', $lw_apply_set ) ) {
		$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
		$pdf->MultiCell ( 150, 5, 'If my doctors reason I have a serious and irreversible condition or illness that I am unlikely to recover from, and I am no longer able to communicate my wishes.', 0, 'L' );
		$pdf->Ln ( 2);
		}
	if ( in_array ( 'lwOther', $lw_apply_set ) ) {
		$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
		if ( !empty ( $lw_other_freetext ) ) {
			$pdf->MultiCell ( 150, 5, "$lw_other_freetext", 0, 'L' );
			}
		else {
			$pdf->MultiCell ( 150, 5, 'Or if _____________________________________________________________________', 0, 'L' );
			}
		$pdf->Ln ( 2);
		}
	}
// _____________________________________ END LIVING WILL



// ===================================== BEGIN SPECIFIC WISHES
if ( !empty($ls_set) || !empty($ls_withholdset) || !empty ( $ls_whset_noother_freetext ) || !empty ( $ls_whset_trialintub_set ) || !empty ( $anh_set ) || !empty ( $anh_avoid_set ) || !empty($anh_specify_freetext) || !empty ( $ps_set ) || !empty($ps_ownwords_freetext) ) {
	$pdf->Ln ( 4 );
	$pdf->Write ( 5, 'In the circumstances specified above, I direct my doctors to act in accordance with the following wishes:' );
	$pdf->Ln ( 12 );
}

// LIFE SUSTAINING TREATMENT
if ( !empty($ls_set) || !empty($ls_withholdset) || !empty ( $ls_whset_noother_freetext ) || !empty ( $ls_whset_trialintub_set ) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', 12 );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'In regard to life sustaining treatment:' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
	if ( in_array ( 'lsAll', $ls_set ) ) {
		$pdf->Write ( 5, 'I would like all available treatment, including life-support treatment, administered in accordance with the highest standards of medical care.' );
		}
	if ( in_array ( 'lsOnlyImprove', $ls_set ) ) {
		$pdf->Write ( 5, 'I would like all available treatment, including life-support treatment, however if the treatment is not improving my condition I request that it be stopped.' );
		}
	if ( in_array ( 'lsWithhold', $ls_set ) || !empty($ls_withholdset) || !empty($ls_whset_noother_freetext) || !empty($ls_whset_trialintub_set) ) {
		$pdf->Write ( 5, 'I ask to withhold only certain specific life-support therapies.' );
		if ( !empty($ls_withhold_set) || !empty($ls_whset_noother_freetext) ) {
			$pdf->Write ( 5, ' I would like to receive all available treatment except the following:' );
			$pdf->Ln ( 8 );
			if ( in_array ( 'lsNoCPR', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Cardiopulmonary Resuscitation (CPR)', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoDialysis', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Dialysis', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoSurgery', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Major Curative Surgery', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoIntub', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Intubation (mechanical respiration)', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoDrugs', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Other Drugs (besides for comfort)', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoElecFib', $ls_withhold_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'No Electric Fibrillation', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'lsNoOther', $ls_withhold_set ) || !empty($ls_whset_noother_freetext) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				if ( !empty ( $ls_whset_noother_freetext ) ) {
					$pdf->MultiCell ( 150, 5, "$ls_whset_noother_freetext", 0, 'L' );
				} else {
					$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
				}
				$pdf->Ln ( 2 );
			}
		}
		if ( !empty ( $ls_whset_trialintub_set ) ) {
			$pdf->Write ( 5, 'Allow a trial period of Intubation (mechanical respiration), but if there is no improvement in my condition, I ask that it be removed.' );
			$pdf->Ln (2);
		}
	}
	if ( in_array ( 'lsComfort', $ls_set ) ) {
		$pdf->Write ( 5, 'I ask to withhold (or if already started, to stop) all forms of therapy, including life-support treatment, that are not intended solely for my comfort.' );
	}
$pdf->Ln ( 8 );
}

// ARTIFICIAL NUTRITION & HYDRATION
if ( !empty ( $anh_set ) || !empty ( $anh_avoid_set ) || !empty($anh_specify_freetext) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', 12 );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'In regard to artificial nutrition and hydration:' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
	if ( in_array ( 'anhMostEffect', $anh_set ) ) {
		$pdf->Write ( 5, 'I want to receive nutrition and hydration by the most effective means.' );
	}
	if ( in_array ( 'anhAvoid', $anh_set ) || !empty($anh_avoid_set) || !empty($anh_specify_freetext) ) {
		$pdf->Write ( 5, 'I feel strongly that I do not want certain means of artificial nutrition used.' );
		if ( !empty ( $anh_avoid_set ) ) {
			$pdf->Write ( 5, ' I would like to receive all available treatment except the following:' );
			$pdf->Ln ( 8 );
			if ( in_array ( 'anhNoNoseMouth', $anh_avoid_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'I do not want placement of a feeding tube through the nose or mouth to the stomach, even if this is deemed to be the best choice for me by my doctors.', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'anhNoSurgInsert', $anh_avoid_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'I do not want surgical insertion of a feeding tube directly into the stomach, even if this is deemed to be the best choice for me by my doctors.', 0, 'L' );
				$pdf->Ln ( 2 );
			}
			if ( in_array ( 'anhNoIV', $anh_avoid_set ) ) {
				$pdf->Cell ( 10, 5, chr(149), 0, 0, 'R' );
				$pdf->MultiCell ( 150, 5, 'I do not want intravenous administration of nutrition and hydration, even if there are no other options.', 0, 'L' );
				$pdf->Ln ( 2 );
			}
		}
	}
	if ( in_array ( 'anhNone', $anh_set ) ) {
		$pdf->Write ( 5, 'I do not want to be fed or hydrated by any artificial means.' );
	}
	if ( in_array ( 'anhSpecify', $anh_set ) || !empty($anh_specify_freetext) ) {
		$pdf->Write ( 5, 'The following are my wishes about artificial nutrition and hydration:' );
		if ( !empty ( $anh_specify_freetext ) ) {
			$pdf->Ln( 5 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell (150, 5, "$anh_specify_freetext", 0, 'L');
		} else {
			$pdf->Ln(10);
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
			$pdf->Ln(5);
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
			$pdf->Ln(5);
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
		}
	}
	$pdf->Ln ( 8 );
}

// PAIN & SUFFERING
if ( !empty ( $ps_set ) || !empty($ps_ownwords_freetext) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', 12 );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'In regard to relief of pain and suffering:' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
	if ( in_array ( 'psMaxConscious', $ps_set ) ) {
		$pdf->Write ( 5, 'I ask that every attempt be made to maximize consciousness.' );
	}
	if ( in_array ( 'psContact', $ps_set ) ) {
		$pdf->Write ( 5, 'I ask that you manage my pain in a way to maximize contact with my family and friends even if it means for me greater physical suffering.' );
	}
	if ( in_array ( 'psMinSuffer', $ps_set ) ) {
		$pdf->Write ( 5, 'I would like every attempt to be made to minimize my suffering, even if it may hasten my death.' );
	}
	if ( in_array ( 'psOwnWords', $ps_set ) || !empty($ps_ownwords_freetext) ) {
		$pdf->Write ( 5, 'The following are my wishes about pain relief:' );
		if ( !empty ( $ps_ownwords_freetext ) ) {
			$pdf->Ln ( 5 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, "$ps_ownwords_freetext", 0, 'L' );
		} else {
			$pdf->Ln ( 10 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
			$pdf->Ln ( 10 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
			$pdf->Ln ( 10 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '___________________________________________________________________________', 0, 'L' );
		}
	}
	$pdf->Ln ( 8 );	
}

// _____________________________________ END SPECIFIC WISHES



// ===================================== BEGIN FINAL NOTES & ORGAN DONATION
// OWN WORDS
if ( !empty ( $ownwords_freetext ) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', 12 );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'The following are additional wishes that I would like to convey to my family and care providers.' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
	$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
	$pdf->MultiCell ( 130, 5, "$ownwords_freetext", 0, 'L' );
	$pdf->Ln ( 8 );
}

// ORGAN DONATION
if ( !empty ( $od_set ) || !empty($od_specify_freetext) || !empty($od_purp_set) ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', 12 );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'Organ Donation:' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
	$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
	$pdf->Write ( 5, 'Upon my death, ' );
	if ( in_array ( 'orgDonNone', $od_set ) ) {
		$pdf->Write ( 5, 'I do not give any of my organs, tissues, or parts and do not want my agent, guardian, or family to make a donation on my behalf.' );
	}
	if ( in_array ( 'orgDonAny', $od_set ) ) {
		$pdf->Write ( 5, 'I give any needed organs, tissues, or parts.' );
	}
	if ( in_array ( 'orgDonSpecify', $od_set ) || !empty($od_specify_freetext) ) {
		$pdf->Write ( 5, 'I give the following organs, tissues, or parts only:' );
		if ( !empty ( $od_specify_freetext ) ) {
			$pdf->Ln ( 5 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, "$od_specify_freetext", 0, 'L' );
		} else {
			$pdf->Ln ( 5 );
			$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
			$pdf->MultiCell ( 150, 5, '_____________________________________________________________________________', 0, 'L' );
		}
	}
	if ( !empty ( $od_purp_set ) && ( $od_set[0] != 'orgDonNone' ) ) {
		$pdf->Ln(5);
		$pdf->Cell ( 10, 5, '', 0, 0, 'R' );
		$pdf->MultiCell ( 150, 5, 'My gift is for the following purposes:', 0, 'L' );
		if ( in_array ( 'odTransplant', $od_purp_set ) ) {
			$pdf->Cell ( 20, 5, chr(149), 0, 0, 'R' );
			$pdf->MultiCell ( 140, 5, 'Transplant', 0, 'L' );
			$pdf->Ln ( 2 );
		}
		if ( in_array ( 'odTherapy', $od_purp_set ) ) {
			$pdf->Cell ( 20, 5, chr(149), 0, 0, 'R' );
			$pdf->MultiCell ( 140, 5, 'Therapy', 0, 'L' );
			$pdf->Ln ( 2 );
		}
		if ( in_array ( 'odResearch', $od_purp_set ) ) {
			$pdf->Cell ( 20, 5, chr(149), 0, 0, 'R' );
			$pdf->MultiCell ( 140, 5, 'Research', 0, 'L' );
			$pdf->Ln ( 2 );
		}
		if ( in_array ( 'odEducation', $od_purp_set ) ) {
			$pdf->Cell ( 20, 5, chr(149), 0, 0, 'R' );
			$pdf->MultiCell ( 140, 5, 'Education', 0, 'L' );
			$pdf->Ln ( 2 );
		}
	}
	$pdf->Ln ( 8 );
}
// _____________________________________ END FINAL NOTES & ORGAN DONATION




// ===================================== BEGIN SIGNATURES
$pdf->SetFont ( 'CrimsonText-Semibold', '', '16' );
$pdf->SetTextColor (86,22,118);
$pdf->Cell ( 0, 5, 'Signatures', 0, 1, 'L' );
$pdf->Ln ( 5 );
$pdf->SetFont ( 'CrimsonText-Roman', '', 12 );
$pdf->SetTextColor (0,0,0);
$pdf->Write ( 5, 'These directions express my legal right to determine the level and extent of my own medical treatment. I intend my instructions to be carried out, unless I have rescinded them in a new writing or by clearly indicating that I have changed my mind. I understand that I may revoke this advance directive at any time. I understand and agree that if I have any prior directives, and if I sign this advance directive, my prior directives are revoked. I understand the full importance and meaning of this advanced directive, and I am emotionally and mentally competent to state my wishes here. If I have appointed a health care proxy or agent, I request that this document guide his or her decisions about my medical care.' );
$pdf->Ln ( 8 );
$pdf->SetFont ( 'CrimsonText-Semibold', '', '12' );
$pdf->SetTextColor (86,22,118);
$pdf->Write ( 5, "$patient_full_name" );
$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
$pdf->SetTextColor (0,0,0);
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________      Date   ______________' );
$pdf->Ln ( 14 );

// WITNESSES
$pdf->SetFont ( 'CrimsonText-Semibold', '', '14' );
$pdf->SetTextColor (86,22,118);
$pdf->Write ( 5, 'Statement of Witnesses' );
$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
$pdf->SetTextColor (0,0,0);
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'I declare that the person who signed this document appeared to execute the living will willingly and free from duress. He or she signed (or asked another to sign for him or her) this document in my presence.' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, "I also declare that I am not the person's above appointed health proxy; I am not the person's healthcare provider, nor an employee or employer thereof; I am not financially responsible for the person's health care; I am not an employee of any insurance provider for the person; I am not a creditor to the person nor entitled to any portion of the person's estate by way of will or other legal document; I am not related by blood, adoption, or marriage to the person." );
$pdf->Ln ( 14 );

// WITNESS 1
$pdf->SetFont ( 'CrimsonText-Semibold', '', '12' );
$pdf->SetTextColor (86,22,118);
$pdf->Write ( 5, 'Witness 1' );
$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
$pdf->SetTextColor (0,0,0);
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Name   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________      Date   ______________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Address   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, '                ______________________________________________' );
$pdf->Ln ( 14 );

// WITNESS 2
$pdf->SetFont ( 'CrimsonText-Semibold', '', '12' );
$pdf->SetTextColor (86,22,118);
$pdf->Write ( 5, 'Witness 2' );
$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
$pdf->SetTextColor (0,0,0);
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Name   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________    Date   ______________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Address   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, '                ______________________________________________' );
$pdf->Ln ( 14 );

// PRIMARY CARE PHYSICIAN
$pdf->SetFont ( 'CrimsonText-Semibold', '', '14' );
$pdf->SetTextColor (86,22,118);
$pdf->Write ( 5, 'Primary Care Physician (Optional)' );
$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
$pdf->SetTextColor (0,0,0);
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Name   ______________________________________________' );
$pdf->Ln ( 8 );
$pdf->Write ( 5, 'Signature   _____________________________________________    Date   ______________' );
$pdf->Ln ( 14 );

// NOTARIZATION
if ( $patient_us_state_abbrev == 'NC' || $patient_us_state_abbrev == 'WV' || $patient_us_state_abbrev == 'VA' ) {
	$pdf->SetFont ( 'CrimsonText-Semibold', '', '14' );
	$pdf->SetTextColor (86,22,118);
	$pdf->Write ( 5, 'Notarization' );
	$pdf->SetFont ( 'CrimsonText-Roman', '', '12' );
	$pdf->SetTextColor (0,0,0);
	$pdf->Ln ( 8 );
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
}
// _____________________________________ END SIGNATURES

$pdf->SetY(270);
$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor ( 150, 150, 150 );
$pdf->Cell( 0, 5, 'generated using patientproxy.com', 0, 1, 'C' );

// FINISH UP
if ( $output_s == true ) {
	$finaloutput = $pdf->Output('', 'S');
} else {
	$pdf->Output();
}

?>