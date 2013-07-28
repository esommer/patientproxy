<?php
$generalstate = array (
	'patientInfo',
	'healthProxy',
	'alternateHP',
	'authHealthRecs',
	'livingWillApply',
	'lifeSustainTrmt',
	'artNutrHydr',
	'painSuffer',
	'ownWords',
	'organDonation'
	);

// ########################### PATIENT INFO PAGE

// ############## PATIENT DATA FIELDSET
$fullNameReq = new TextElement ( array (
	'idName' => 'fullNameReq', 
	'labelText' => 'Full Name', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => 'yes',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$birthDate = new TextElement ( array (
	'idName' => 'birthDate', 
	'labelText' => 'Birthday', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => 'yes',
	'validationType' => 'date',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$usStateReq = new TextElement ( array (
	'idName' => 'usStateReq', 
	'labelText' => 'State', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => 'yes',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '2',
	'cols' => '',
	'rows' => '')
	);
$reqText = new TextElement ( array (
	'idName' => 'reqText', 
	'labelText' => '* Denotes required field.', 
	'childElements' => array (), 
	'inputType' => 'justtext',
	'required' => '',
	'validationType' => 'none')
	);
$patientData = new QuestionFieldSet ( array (
	'idName' => 'patientData', 
	'labelText' => '', 
	'childElements' => array ( $fullNameReq, $birthDate, $usStateReq, $reqText ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ______________ END PATIENT DATA FIELDSET

$patientInfo = new QuestionPage ( array (
	'idName' => 'patientInfo', 
	'labelText' => 'Your Personal Information', 
	'childElements' => array ( $patientData ), 
	'pageTitleText' => 'Your Info', 
	'helpText' => '')
	);
// ____________________________ END PATIENT INFO PAGE

// ########################### HEALTH PROXY PAGE

// ############# PERSON DATA FIELDSET
$fullName = new TextElement ( array (
	'idName' => 'fullName', 
	'labelText' => 'Full Name', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$streetAddress = new TextElement ( array (
	'idName' => 'streetAddress', 
	'labelText' => 'Street Address', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$city = new TextElement ( array (
	'idName' => 'city', 
	'labelText' => 'City', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
$zip = new TextElement ( array (
	'idName' => 'zip', 
	'labelText' => 'Zip', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '5',
	'cols' => '',
	'rows' => '')
	);
$usState = new TextElement ( array (
	'idName' => 'usState', 
	'labelText' => 'State', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '2',
	'cols' => '',
	'rows' => '')
	);
$phone = new TextElement ( array (
	'idName' => 'phone', 
	'labelText' => 'Phone', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$cellPhone = new TextElement ( array (
	'idName' => 'cellPhone', 
	'labelText' => 'Cell Phone', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$email = new TextElement ( array (
	'idName' => 'email', 
	'labelText' => 'Email', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$personData = new QuestionFieldSet ( array (
	'idName' => 'personData', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $phone, $cellPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ____________ END PERSON DATA FIELDSET

$healthProxy = new QuestionPage ( array (
	'idName' => 'healthProxy', 
	'labelText' => 'Designate a Health Proxy', 
	'childElements' => array ( $personData ), 
	'pageTitleText' => 'Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END HEALTH PROXY PAGE


// ########################### ALTERNATE HP PAGE
$alternateHP = new QuestionPage ( array (
	'idName' => 'alternateHP', 
	'labelText' => 'Designate an Alternate Health Proxy', 
	'childElements' => array ( $personData ), 
	'pageTitleText' => 'Alternate Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END ALTERNATE HP PAGE

// ########################### AUTH HEALTH RECS PAGE

// ############# AUTH HEALTH RECS FIELDSET
$contradict = new SelectionElement ( array (
	'idName' => 'contradict', 
	'labelText' => 'and may contradict those instructions upon their own judgement.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'contradict',
	'defaultState' => '',
	'outputText' => '')
	);	

$noContradict = new SelectionElement ( array (
	'idName' => 'noContradict', 
	'labelText' => 'and may not contradict those instructions.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'noContradict',
	'defaultState' => '',
	'outputText' => '')
	);
	
$contradictionSet = new QuestionFieldSet ( array (
	'idName' => 'contradictionSet', 
	'labelText' => 'My health proxy should follow what health care instructions I specify in this directive,', 
	'childElements' => array ( $contradict, $noContradict ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$authRecs = new SelectionElement ( array (
	'idName' => 'authRecs', 
	'labelText' => 'once this directive becomes active.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'authRecs',
	'defaultState' => '',
	'outputText' => '')
	);	

$authRecsImmediate = new SelectionElement ( array (
	'idName' => 'authRecsImmediate', 
	'labelText' => 'immediately upon execution of this directive.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'authRecsImmediate',
	'defaultState' => '',
	'outputText' => '')
	);

$authRecsNo = new SelectionElement ( array (
	'idName' => 'authRecsNo', 
	'labelText' => 'I do not authorize my health proxy access to my health records.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'authRecsNo',
	'defaultState' => '',
	'outputText' => '')
	);
	
$authRecsSet = new QuestionFieldSet ( array (
	'idName' => 'authRecsSet', 
	'labelText' => 'I authorize my health proxy access to all my health records:', 
	'childElements' => array ( $authRecs, $authRecsImmediate, $authRecsNo ), 
	'childrenType' => 'radio',
	'required' => 'yes')
	);
// ____________ END AUTH HEALTH RECS FIELDSET

$authHealthRecs = new QuestionPage ( array (
	'idName' => 'authHealthRecs', 
	'labelText' => 'Health Proxy Powers', 
	'childElements' => array ( $authRecsSet, $contradictionSet ), 
	'pageTitleText' => 'Health Records', 
	'helpText' => '')
	);
// ____________________________ END AUTH HEALTH RECS PAGE



// ########################### LIVING WILL APPLY PAGE

// ############# FREE TEXT FIELDSET
$freeText = new TextElement ( array (
	'idName' => 'freeText', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$freeTextSet = new QuestionFieldSet ( array (
	'idName' => 'freeTextSet', 
	'labelText' => '', 
	'childElements' => array ( $freeText ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ____________ END FREE TEXT FIELDSET

// ############# LIVING WILL APPLY FIELDSET
$lwPostponeDeath = new SelectionElement ( array (
	'idName' => 'lwPostponeDeath', 
	'labelText' => 'If I my doctors reason I am close to death and life support would only postpone the moment of my death.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lwPostponeDeath',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$lwComaVeg = new SelectionElement ( array (
	'idName' => 'lwComaVeg', 
	'labelText' => 'If I am in a deep coma, persistent vegetative state, or have suffered other severe neurologic injury which my doctors reason is irreversible.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lwComaVeg',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$lwNoCommunicate = new SelectionElement ( array (
	'idName' => 'lwNoCommunicate', 
	'labelText' => 'If I am irreversibly demented to the point that I can no longer recognize my friends and family nor can I convey my wishes about medical care.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lwNoCommunicate',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$lwTerminal = new SelectionElement ( array (
	'idName' => 'lwTerminal', 
	'labelText' => 'If my doctors reason I have a serious and irreversible condition or illness that I am unlikely to recover from, and I am no longer able to communicate my wishes.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lwTerminal',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$lwOther = new SelectionElement ( array (
	'idName' => 'lwOther', 
	'labelText' => 'I would like to specify other conditions in addition to or instead of the above choices:', 
	'childElements' => array ( $freeTextSet ) , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lwOther',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$lwApplySet = new QuestionFieldSet ( array (
	'idName' => 'lwApplySet', 
	'labelText' => '', 
	'childElements' => array ( $lwPostponeDeath, $lwComaVeg, $lwNoCommunicate, $lwTerminal, $lwOther ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________ END LIVING WILL APPLY FIELDSET

$livingWillApply = new QuestionPage ( array (
	'idName' => 'livingWillApply', 
	'labelText' => 'Situations in which your Living Will applies', 
	'childElements' => array ( $lwApplySet ), 
	'pageTitleText' => 'Living Will Application', 
	'helpText' => '')
	);
// ____________________________ END LIVING WILL APPLY PAGE



// ########################### LIFE SUSTAIN TREATMENT PAGE

// ############# TRIAL INTUB FIELDSET
$trialIntub = new SelectionElement ( array (
	'idName' => 'trialIntub', 
	'labelText' => 'Allow a trial period of intubation (mechanical respiration), but if there is no improvement in my condition, I ask that it be removed.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'trialIntub',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$trialIntubSet = new QuestionFieldSet ( array (
	'idName' => 'trialIntubSet', 
	'labelText' => '', 
	'childElements' => array ( $trialIntub ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________ END TRIAL INTUB FIELDSET

// ############# LS WITHHOLD FIELDSET
$lsNoCPR = new SelectionElement ( array (
	'idName' => 'lsNoCPR', 
	'labelText' => 'No cardiopulmonary resuscitation (CPR)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoCPR',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoDialysis = new SelectionElement ( array (
	'idName' => 'lsNoDialysis', 
	'labelText' => 'No dialysis', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoDialysis',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoSurgery = new SelectionElement ( array (
	'idName' => 'lsNoSurgery', 
	'labelText' => 'No major curative surgery', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoSurgery',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoIntub = new SelectionElement ( array (
	'idName' => 'lsNoIntub', 
	'labelText' => 'No intubation (mechanical respiration)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoIntub',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoDrugs = new SelectionElement ( array (
	'idName' => 'lsNoDrugs', 
	'labelText' => 'No other drugs (besides for comfort)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoDrugs',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoElecFib = new SelectionElement ( array (
	'idName' => 'lsNoElecFib', 
	'labelText' => 'No electric fibrillation', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoElecFib',
	'defaultState' => '',
	'outputText' => '')
	);
$lsNoOther = new SelectionElement ( array (
	'idName' => 'lsNoOther', 
	'labelText' => 'Other', 
	'childElements' => array ( $freeTextSet ) , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoOther',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsWithholdSet = new QuestionFieldSet ( array (
	'idName' => 'lsWithholdSet', 
	'labelText' => '', 
	'childElements' => array ( $lsNoCPR, $lsNoDialysis, $lsNoSurgery, $lsNoIntub, $lsNoDrugs, $lsNoElecFib, $lsNoOther ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________ END LS WITHHOLD FIELDSET

// ############# LIFE SUSTAIN FIELDSET
$lsAll = new SelectionElement ( array (
	'idName' => 'lsAll', 
	'labelText' => 'I would like all available treatment, including life-support treatment, administered in accordance with the highest standards of medical care.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsAll',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsOnlyImprove = new SelectionElement ( array (
	'idName' => 'lsOnlyImprove', 
	'labelText' => 'I would like all available treatment, including life-support treatment, however if the treatment is not improving my condition I request that it be stopped.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsOnlyImprove',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsWithhold = new SelectionElement ( array (
	'idName' => 'lsWithhold', 
	'labelText' => 'I ask to withhold only certain specific life-support therapies:<br /><span class="smaller">(Check all that <span class="strong">you do not want administered</span>.)</span>', 
	'childElements' => array ( $lsWithholdSet, $trialIntubSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsWithhold',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsComfort = new SelectionElement ( array (
	'idName' => 'lsComfort', 
	'labelText' => 'I ask to withhold (or if already started, to stop) all forms of therapy, including life-support treatment, that are not intended solely for my comfort.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsComfort',
	'defaultState' => '',
	'outputText' => '')
	);	
$lifeSusSet = new QuestionFieldSet ( array (
	'idName' => 'lifeSusSet', 
	'labelText' => '', 
	'childElements' => array ( $lsAll, $lsOnlyImprove, $lsWithhold, $lsComfort ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________ END LIFE SUSTAIN FIELDSET

$lifeSustainTrmt = new QuestionPage ( array (
	'idName' => 'lifeSustainTrmt', 
	'labelText' => 'Life Sustaining Treatment', 
	'childElements' => array ( $lifeSusSet), 
	'pageTitleText' => 'Life Sustaining Treatment', 
	'helpText' => '')
	);
// ____________________________ END LIFE SUSTAIN TREATMENT PAGE



// ####################### ARTIFICIAL NUTRITION HYDRATION PAGE

// ############# ANH AVOID FIELDSET
$anhNoNoseMouth = new SelectionElement ( array (
	'idName' => 'anhNoNoseMouth', 
	'labelText' => 'I do not want placement of a feeding tube through the nose or mouth to the stomach, even if this is deemed to be the best choice for me by my doctors.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhNoNoseMouth',
	'defaultState' => '',
	'outputText' => '')
	);	
$anhNoSurgInsert = new SelectionElement ( array (
	'idName' => 'anhNoSurgInsert', 
	'labelText' => 'I do not want surgical insertion of a feeding tube directly into the stomach, even if this is deemed to be the best choice for me by my doctors.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhNoSurgInsert',
	'defaultState' => '',
	'outputText' => '')
	);
$anhNoIV = new SelectionElement ( array (
	'idName' => 'anhNoIV', 
	'labelText' => 'I do not want intravenous administration of nutrition and hydration, even if there are no other options.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhNoIV',
	'defaultState' => '',
	'outputText' => '')
	);	
$anhAvoidSet = new QuestionFieldSet ( array (
	'idName' => 'anhAvoidSet', 
	'labelText' => 'Check all that <span class="strong">you do not want administered</span>:', 
	'childElements' => array ( $anhNoNoseMouth, $anhNoSurgInsert, $anhNoIV ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________ END ANH AVOID FIELDSET

// ############# ANH FIELDSET
$anhMostEffect = new SelectionElement ( array (
	'idName' => 'anhMostEffect', 
	'labelText' => 'I want to receive nutrition and hydration by the most effective means.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhMostEffect',
	'defaultState' => '',
	'outputText' => '')
	);	
$anhAvoid = new SelectionElement ( array (
	'idName' => 'anhAvoid', 
	'labelText' => 'I feel strongly that I do not want certain means of artificial nutrition used.', 
	'childElements' => array ( $anhAvoidSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhAvoid',
	'defaultState' => '',
	'outputText' => '')
	);	
$anhNone = new SelectionElement ( array (
	'idName' => 'anhNone', 
	'labelText' => 'I do not want to be fed or hydrated by any artificial means.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhNone',
	'defaultState' => '',
	'outputText' => '')
	);	
$anhSpecify = new SelectionElement ( array (
	'idName' => 'anhSpecify', 
	'labelText' => 'I would like to specify in my own words my wishes about artificial nutrition and hydration:', 
	'childElements' => array ( $freeTextSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anhSpecify',
	'defaultState' => '',
	'outputText' => '')
	);	
$artNutHydSet = new QuestionFieldSet ( array (
	'idName' => 'artNutHydSet', 
	'labelText' => '', 
	'childElements' => array ( $anhMostEffect, $anhAvoid, $anhNone, $anhSpecify ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________ END ANH FIELDSET

$artNutrHydr = new QuestionPage ( array (
	'idName' => 'artNutrHydr', 
	'labelText' => 'Artificial Nutrition and Hydration Options', 
	'childElements' => array ( $artNutHydSet), 
	'pageTitleText' => 'Artificial Nutrition and Hydration', 
	'helpText' => '')
	);
// ____________________ END ARITIFICIAL NUTRITION HYDRATION PAGE



// ########################### PAIN & SUFFERING PAGE

// ############# PAIN SUFFER FIELDSET
$psMaxConscious = new SelectionElement ( array (
	'idName' => 'psMaxConscious', 
	'labelText' => 'I ask that every attempt be made to maximize consciousness.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'psMaxConscious',
	'defaultState' => '',
	'outputText' => '')
	);	
$psContact = new SelectionElement ( array (
	'idName' => 'psContact', 
	'labelText' => 'I ask that you manage my pain in a way to maximize contact with my family and friends even if it means for me greater physical suffering.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'psContact',
	'defaultState' => '',
	'outputText' => '')
	);	
$psMinSuffer = new SelectionElement ( array (
	'idName' => 'psMinSuffer', 
	'labelText' => 'I would like every attempt to be made to minimize my suffering, even if it may hasten my death.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'psMinSuffer',
	'defaultState' => '',
	'outputText' => '')
	);	
$psOwnWords = new SelectionElement ( array (
	'idName' => 'psOwnWords', 
	'labelText' => 'I would like to specify in my own words my wishes about pain relief:', 
	'childElements' => array ( $freeTextSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'psOwnWords',
	'defaultState' => '',
	'outputText' => '')
	);	
$painSufferSet = new QuestionFieldSet ( array (
	'idName' => 'painSufferSet', 
	'labelText' => '', 
	'childElements' => array ( $psMaxConscious, $psContact, $psMinSuffer, $psOwnWords ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________ END PAIN SUFFER FIELDSET

$painSuffer = new QuestionPage ( array (
	'idName' => 'painSuffer', 
	'labelText' => 'Relief of Pain and Suffering Options', 
	'childElements' => array ( $painSufferSet ), 
	'pageTitleText' => 'Relief of Pain and Suffering', 
	'helpText' => '')
	);
// ____________________________ END PAIN & SUFFERING PAGE

// ########################### ADDITIONAL REQUESTS PAGE	
$ownWords = new QuestionPage ( array (
	'idName' => 'ownWords', 
	'labelText' => 'I would like to add my own words about any other wishes I may have that I would like to convey to my family and care providers:', 
	'childElements' => array ( $freeTextSet ), 
	'pageTitleText' => 'Additional Requests', 
	'helpText' => '')
	);
// ____________________________ END ADDITIONAL REQUESTS PAGE


// ########################### ORGAN DONATION PAGE

// ############# ORG DON FIELDSET
$orgDonAny = new SelectionElement ( array (
	'idName' => 'orgDonAny', 
	'labelText' => 'I give any needed organs, tissues, or parts.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'orgDonAny',
	'defaultState' => 'checked',
	'outputText' => '')
	);
$orgDonSpecify = new SelectionElement ( array (
	'idName' => 'orgDonSpecify', 
	'labelText' => 'I give the following organs, tissues, or parts only:', 
	'childElements' => array ( $freeTextSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'orgDonSpecify',
	'defaultState' => '',
	'outputText' => '')
	);
$orgDonNone = new SelectionElement ( array (
	'idName' => 'orgDonNone', 
	'labelText' => 'I do not give any of my organs, tissues, or parts and do not want my agent, guardian, or family to make a donation on my behalf.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'orgDonNone',
	'defaultState' => '',
	'outputText' => '')
	);	
$orgDonSet = new QuestionFieldSet ( array (
	'idName' => 'orgDonSet', 
	'labelText' => 'Upon my death:', 
	'childElements' => array ( $orgDonAny, $orgDonSpecify, $orgDonNone ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________ END ORG DON FIELDSET

// ############# OD PURPOSE FIELDSET
$odTransplant = new SelectionElement ( array (
	'idName' => 'odTransplant', 
	'labelText' => 'Transplant', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'odTransplant',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$odTherapy = new SelectionElement ( array (
	'idName' => 'odTherapy', 
	'labelText' => 'Therapy', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'odTherapy',
	'defaultState' => 'checked',
	'outputText' => '')
	);
$odResearch = new SelectionElement ( array (
	'idName' => 'odResearch', 
	'labelText' => 'Research', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'odResearch',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$odEducation = new SelectionElement ( array (
	'idName' => 'odEducation', 
	'labelText' => 'Education', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'odEducation',
	'defaultState' => 'checked',
	'outputText' => '')
	);	
$odPurposeSet = new QuestionFieldSet ( array (
	'idName' => 'odPurposeSet', 
	'labelText' => 'My gift, if I have made one, is for the following purposes:', 
	'childElements' => array ( $odTransplant, $odTherapy, $odResearch, $odEducation ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________ END OD PURPOSE FIELDSET

$organDonation = new QuestionPage ( array (
	'idName' => 'organDonation', 
	'labelText' => 'Organ Donation', 
	'childElements' => array ( $orgDonSet, $odPurposeSet ), 
	'pageTitleText' => 'Organ Donation', 
	'helpText' => '')
	);
// ____________________________ END ORGAN DONATION PAGE



?>