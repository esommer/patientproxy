<?php

$wisconsin = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'nursingHome', //AJBdone
	'feedingTube', //AJBdone
	'pregnantWomen', //AJBdone
	'statementDesires', //AJBdone
	'physicalMental', //AJBdone
	'terminalCondition', //AJBdone
	'pvsLifeTube', //AJBdone
	//'copyLocation', //AJBdone
	'organDonation' //AJBdone
	);
	
// ########################### PATIENT INFO PAGE

// ############ PATIENT DATA FIELDSET
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
	'childElements' => array ( $fullNameReq, $birthDate, $streetAddress, $city, $usStateReq, $zip, $reqText ), 
	'childrenType' => 'form',
	'required' => '')
	);
// _____________ END PATIENT DATA FIELDSET

$patientInfo = new QuestionPage ( array (
	'idName' => 'patientInfo', 
	'labelText' => 'Your Personal Information', 
	'childElements' => array ( $patientData ), 
	'pageTitleText' => 'Your Information', 
	'helpText' => '')
	);

// ____________________________ END PATIENT INFO PAGE
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
// ########################### HEALTH PROXY PAGE

// ############# PERSON DATA FIELDSET
$personData = new QuestionFieldSet ( array (
	'idName' => 'personData', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$alternatePersonData = new QuestionFieldSet ( array (
	'idName' => 'alternatePersonData', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ____________ END PERSON DATA FIELDSET

$healthProxy = new QuestionPage ( array (
	'idName' => 'healthProxy', 
	'labelText' => 'Designate a Health Proxy and an Alternate Health Proxy', 
	'childElements' => array ( $personData, $alternatePersonData ), 
	'pageTitleText' => 'Health Proxy and Alternate', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);

// ____________________________ END HEALTH PROXY PAGE

// ###########################  NURSING HOMES PAGE

// ############ BEGIN NURSING HOME & COMMUNITY RESIDENCE FIELDSETS 


$radioYes = new SelectionElement ( array (
	'idName' => 'radioYes', 
	'labelText' => 'Yes', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'radioYes',
	'defaultState' => '',
	'outputText' => '')
	);
	
$radioNo = new SelectionElement ( array (
	'idName' => 'radioNo', 
	'labelText' => 'No', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'radioNo',
	'defaultState' => '',
	'outputText' => '')
	);

$nursingHomeSet = new QuestionFieldSet ( array (
	'idName' => 'nursingHomeSet', 
	'labelText' => 'A nursing home', 
	'childElements' => array ( $radioYes, $radioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$communityResidence = new QuestionFieldSet ( array (
	'idName' => 'communityResidence', 
	'labelText' => 'A community-based residential facility:', 
	'childElements' => array ( $radioYes, $radioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

// ______________ END NURSING HOME & COMMUNITY RESIDENCE FIELDSETS
$nursingText = new TextObject ( array (
	'idName' => 'nursingText',
	'textBody' => 'My health care agent may admit me to a nursing home or community- based residential facility for short-term stays for recuperative care or respite care. If I have selected "Yes" in the following, my health care agent may admit me for a purpose other than recuperative care or respite care, but if I have selected "No" in the following, my health care agent may not so admit me: (If I have not selected either "Yes" or "No" immediately above, my health care agent may only admit me for short-term stays for recuperative care or respite care.)')
	);	
$nursingHome = new QuestionPage ( array (
	'idName' => 'nursingHome', 
	'labelText' => 'Nursing Home and Community Residence Preferences', 
	'childElements' => array ( $nursingText, $nursingHomeSet, $communityResidence ), 
	'pageTitleText' => 'Nursing Home & Community Residence', 
	'helpText' => '')
	);

// ______________________________ END NURSING HOME PAGE


// ############################# BEGIN FEEDING TUBE PAGE
$feedingText = new TextObject ( array (
	'idName' => 'feedingText',
	'textBody' => 'If I have selected "Yes" in the following, my health care agent may have a feeding tube withheld or withdrawn from me, unless my physician has advised that, in his or her professional judgment, this will cause me pain or will reduce my comfort. If I have selected "No" in the following, my health care agent may not have a feeding tube withheld or withdrawn from me. My health care agent may not have orally ingested nutrition or hydration withheld or withdrawn from me unless provision of the nutrition or hydration is medically contraindicated. (If I have not selected either "Yes" or "No" immediately below, my health care agent may not have a feeding tube withdrawn from me.)')
	);	
$feedingTubeRadio = new QuestionFieldSet ( array (
	'idName' => 'feedingTubeRadio', 
	'labelText' => 'Withhold or withdraw a feeding tube:', 
	'childElements' => array ( $radioYes, $radioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$feedingTube = new QuestionPage ( array (
	'idName' => 'feedingTube', 
	'labelText' => 'Provision of a Feeding Tube', 
	'childElements' => array ( $feedingText, $feedingTubeRadio ), 
	'pageTitleText' => 'Provision of a Feeding Tube', 
	'helpText' => '')
	);


// _______________________________ END FEEDING TUBE PAGE


// ############################## BEGIN PREGNANT WOMAN PAGE

$pregnantText = new TextObject ( array (
	'idName' => 'pregnantText',
	'textBody' => 'If I have selected "Yes" in the following, my health care agent may make health care decisions for me even if my agent knows I am pregnant. If I have selected "No" in the following, my health care agent may not make health care decisions for me if my health care agent knows I am pregnant. If I have not selected either "Yes" or "No" immediately below, my health care agent may not make health care decisions for me if my health care agent knows I am pregnant.')
	);	
$pregnantWomenRadio = new QuestionFieldSet ( array (
	'idName' => 'pregnantWomenRadio', 
	'labelText' => 'Health care decision if I am pregnant:', 
	'childElements' => array ( $radioYes, $radioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$pregnantWomen = new QuestionPage ( array (
	'idName' => 'pregnantWomen', 
	'labelText' => 'In the case of Pregnancy', 
	'childElements' => array ( $pregnantText, $pregnantWomenRadio ), 
	'pageTitleText' => 'For Pregnant Women', 
	'helpText' => '')
	);

// ________________________________ END PREGNANT WOMAN PAGE


// ################################ BEGIN STATEMENT OF DESIRES PAGE

$desiresLimitations = new TextElement ( array (
	'idName' => 'desiresLimitations', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '6')
	);
$desiresLimitsFieldset = new QuestionFieldSet ( array (
	'idName' => 'desiresLimitsFieldset', 
	'labelText' => 'In exercising authority under this document, my health care agent shall act consistently with my following stated desires, if any, and is subject to any special provisions or limitations that I specify. The following are specific desires, provisions or limitations that I wish to state:', 
	'childElements' => array ( $desiresLimitations ), 
	'childrenType' => 'textarea',
	'required' => 'no')
	);	
$statementDesires = new QuestionPage ( array (
	'idName' => 'statementDesires', 
	'labelText' => 'Statement of Desires', 
	'childElements' => array ( $desiresLimitsFieldset ), 
	'pageTitleText' => 'Statement of Desires', 
	'helpText' => '')
	);

// _______________________________ END STATEMENT OF DESIRES PAGE


// ############################### BEGIN PHYSICAL AND MENTAL HEALTH PAGE

$requestReview = new SelectionElement ( array (
	'idName' => 'requestReview', 
	'labelText' => 'Request, review and receive any information, oral or written, regarding my physical or mental health, including medical and hospital records.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'requestReview',
	'defaultState' => '',
	'outputText' => 'My health care agent has	the authority to request, review and receive any information, oral or written, regarding my physical or mental health, including medical and hospital records.')
	);

$executeDocs = new SelectionElement ( array (
	'idName' => 'executeDocs', 
	'labelText' => 'Execute on my behalf any documents that may be required in order to obtain this information', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'executeDocs',
	'defaultState' => '',
	'outputText' => 'My health care agent has the authority to execute on my behalf any documents that may be required in order to obtain information, oral or written, regarding my physical or mental health, including medical and hospital records.')
	);

$consentDisclosure = new SelectionElement ( array (
	'idName' => 'consentDisclosure', 
	'labelText' => 'Consent to the disclosure of this information.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'consentDisclosure',
	'defaultState' => 'checked',
	'outputText' => 'My health care agent has the authority to consent to the disclosure of information, oral or written, regarding my physical or mental health, including medical and hospital records.')
	);
		

$physicalMentalRadioSet = new QuestionFieldSet ( array (
	'idName' => 'physicalMentalRadioSet', 
	'labelText' => 'Subject to any limitations in this document, my health care agent has the authority to do all of the following:', 
	'childElements' => array ( $requestReview, $executeDocs, $consentDisclosure ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// _________________
	
$physicalMental = new QuestionPage ( array (
	'idName' => 'physicalMentalDisclosure', 
	'labelText' => 'Disclosure of Medical Information', 
	'childElements' => array ( $physicalMentalRadioSet ), 
	'pageTitleText' => 'Disclosure of Medical Information', 
	'helpText' => '')
	);

// _______________________________ END PHYSICAL AND MENTAL HEALTH PAGE

// ############################### BEGIN TERMINAL CONDITION PAGE

$terminalRadioYes = new SelectionElement ( array (
	'idName' => 'terminalRadioYes', 
	'labelText' => 'Yes, I want feeding tubes used if I have a terminal condition.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'terminalRadioYes',
	'defaultState' => '',
	'outputText' => 'Yes, I want feeding tubes used if I have a terminal condition.', 
	'childElements')
	);
	
$terminalRadioNo = new SelectionElement ( array (
	'idName' => 'terminalRadioNo', 
	'labelText' => 'No, I do not want feeding tubes used if I have a terminal condition.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'terminalRadioNo',
	'defaultState' => '',
	'outputText' => 'No, I do not want feeding tubes used if I have a terminal condition.')
	);


$terminalConditionRadioSet = new QuestionFieldSet ( array (
	'idName' => 'terminalConditionRadioSet', 
	'labelText' => 'If I have a TERMINAL CONDITION, as determined by two physicians who have personally examined me, I do not want my dying to be artificially prolonged and I do not want life-sustaining procedures to be used. In addition, the following are my directions regarding the use of feeding tubes: (If you have not selected either box, feeding tubes will be used.)', 
	'childElements' => array ( $terminalRadioYes, $terminalRadioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

// _________________

$terminalCondition = new QuestionPage ( array (
	'idName' => 'terminalCondition', 
	'labelText' => 'Terminal Condition Preferences', 
	'childElements' => array ( $terminalConditionRadioSet ), 
	'pageTitleText' => 'Terminal Condition', 
	'helpText' => '<span class="strong">"Terminal condition"</span> means an incurable condition caused by injury or illness that reasonable medical judgment finds would cause death imminently, so that the application of life-sustaining procedures serves only to postpone the moment of death.<br />
	<span class="strong">"Feeding tube"</span> means a medical tube through which nutrition or hydration is administered into the vein, stomach, nose, mouth or other body opening of a qualified patient.')
	);
// _______________________________ End TERMINAL CONDITION PAGE

// ############################### BEGIN PVS LIFE TUBE PAGE


// ############### BEGIN LIFE-SUSTAINING PROCEDURES FIELDSET

$pvsLifeRadioYes = new SelectionElement ( array (
	'idName' => 'pvsLifeRadioYes', 
	'labelText' => 'Yes, I want life-sustaining procedures used if I am in a persistent vegetative state.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'pvsLifeRadioYes',
	'defaultState' => '',
	'outputText' => 'Yes, I want life-sustaining procedures used if I am in a persistent vegetative state.')
	);
	
$pvsLifeRadioNo = new SelectionElement ( array (
	'idName' => 'pvsLifeRadioNo', 
	'labelText' => 'No, I do not want life-sustaining procedures used if I am in a persistent vegetative state.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'pvsLifeRadioNo',
	'defaultState' => '',
	'outputText' => 'No, I do not want life-sustaining procedures used if I am in a persistent vegetative state.')
	);

$pvsLifeRadio = new QuestionFieldSet ( array (
	'idName' => 'pvsLifeRadio', 
	'labelText' => 'If I am in a PERSISTENT VEGETATIVE STATE, as determined by two physicians who have personally examined me, the following are my directions regarding the use of <span class="strong">life-sustaining procedures</span>:', 
	'childElements' => array ( $pvsLifeRadioYes, $pvsLifeRadioNo ), 
	'helpText' => '',
	'childrenType' => 'radio',
	'required' => 'no')
	);

// _______________ END LIFE-SUSTAINING PROCEDURES FIELDSET

// ############### BEGIN FEEDING TUBE FIELDSET 

$pvsTubeRadioYes = new SelectionElement ( array (
	'idName' => 'pvsTubeRadioYes', 
	'labelText' => 'Yes, I want feeding tubes used if I am in a persistent vegetative state.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'pvsTubeRadioYes',
	'defaultState' => '',
	'outputText' => '')
	);

$pvsTubeRadioNo = new SelectionElement ( array (
	'idName' => 'pvsTubeRadioNo', 
	'labelText' => 'No, I do not want feeding tubes if I am in a persistent vegetative state.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'pvsTubeRadioNo',
	'defaultState' => '',
	'outputText' => '')
	);

$pvsTubeRadio = new QuestionFieldSet ( array (
	'idName' => 'pvsTubeRadio', 
	'labelText' => 'If I am in a PERSISTENT VEGETATIVE STATE, as determined by two physicians who have personally examined me, the following are my directions regarding the use of <span class="strong">feeding tubes</span>:', 
	'helpText' => '',
	'childElements' => array ( $pvsTubeRadioYes, $pvsTubeRadioNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);


// ############### END FEEDING TUBE FIELDSET

$pvsLifeTube = new QuestionPage ( array (
	'idName' => 'pvsLifeTube', 
	'labelText' => 'Persistent Vegetative State Preferences', 
	'childElements' => array ( $pvsLifeRadio, $pvsTubeRadio ), 
	'pageTitleText' => 'Persistent Vegetative State', 
	'helpText' => '<span class="strong">"Persistent vegetative state"</span> means a condition that reasonable medical judgment finds constitutes complete and irreversible loss of all of the functions of the cerebral cortex and results in a complete, chronic and irreversible cessation of all cognitive functioning and consciousness and a complete lack of behavioral responses that indicate cognitive functioning, although autonomic functions continue.<br />
	<span class="strong">"Life−sustaining procedure"</span> means any medical procedure or intervention that, in the judgment of the attending physician, would serve only to prolong the dying process but not avert death when applied to a qualified patient.  "Life−sustaining procedure" includes assistance in respiration, artificial maintenance of blood pressure and heart rate, blood transfusion, kidney dialysis and other similar procedures, but does not include:<br />
	(a)  The alleviation of pain by administering medication or by
	performing any medical procedure.<br />
	(b)  The provision of nutrition or hydration.<br />
	<span class="strong">"Persistent vegetative state"</span> means a condition that reasonable medical judgment finds constitutes complete and irreversible loss of all of the functions of the cerebral cortex and results in a complete, chronic and irreversible cessation of all cognitive functioning and consciousness and a complete lack of behavioral responses that indicate cognitive functioning, although autonomic functions continue.<br />
	<span class="strong">"Feeding tube"</span> means a medical tube through which nutrition or hydration is administered into the vein, stomach, nose, mouth or other body opening of a qualified patient.')
	);

// _______________________________ END PVS LIFE TUBE PAGE


// ############################### BEGIN ORGAN DONATION PAGE

// ################ BEGIN ORGAN DONATION FIELDSETS
$specifyOrgans = new TextElement ( array (
	'idName' => 'specifyOrgans', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
$specifyOrganSet = new QuestionFieldSet ( array (
	'idName' => 'specifyOrganSet', 
	'labelText' => '', 
	'childElements' => array ( $specifyOrgans ), 
	'childrenType' => 'form',
	'required' => 'no')
	);	
$wishToDonate = new SelectionElement ( array (
	'idName' => 'wishToDonate', 
	'labelText' => 'I wish to donate only the following organs or parts:', 
	'childElements' => array ( $specifyOrganSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'wishToDonate',
	'defaultState' => '',
	'outputText' => '')
	);	
	
$anyOrgan = new SelectionElement ( array (
	'idName' => 'anyOrgan', 
	'labelText' => 'I wish to donate any needed organ or part.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'anyOrgan',
	'defaultState' => '',
	'outputText' => '')
	);
	
$refuseToDonate = new SelectionElement ( array (
	'idName' => 'refuseToDonate', 
	'labelText' => 'I refuse to make any anatomical gift. (If this revokes a prior commitment that I have made to make an anatomical gift to a designated donee, I will attempt to notify the donee to which or to whom I agreed to donate.)', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'refuseToDonate',
	'defaultState' => '',
	'outputText' => '')
	);	
$organDonationSet = new QuestionFieldSet ( array (
	'idName' => 'organDonationSet', 
	'labelText' => '', 
	'childElements' => array ( $wishToDonate, $anyOrgan, $refuseToDonate ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// _________________ ORGAN DONATION FIELDSET 

// ################## ANATOMICAL STUDY FIELDSET
$anatomicalStudy = new SelectionElement ( array (
	'idName' => 'anatomicalStudy', 
	'labelText' => 'I wish to donate my body for anatomical study if needed.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anatomicalStudy',
	'defaultState' => '',
	'outputText' => '')
	);

$anatomicalStudySet = new QuestionFieldSet ( array (
	'idName' => 'anatomicalStudySet', 
	'labelText' => '', 
	'childElements' => array ( $anatomicalStudy ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// _________________ ANATOMICAL STUDY FIELDSET


$organDonation = new QuestionPage ( array (
	'idName' => 'organDonation', 
	'labelText' => 'Anatomical Gifts (optional)', 
	'childElements' => array ( $organDonationSet, $anatomicalStudySet), 
	'pageTitleText' => 'Anatomical Gift', 
	'helpText' => '')
	);


// _______________________________ END ORGAN DONATION PAGE


// END


?>
