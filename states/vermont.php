<?php

$vermont = array (
	'patientInfo', //AJBdone
	'proxyCircum', //AJBdone
	'healthProxy', //AJBdone
	'instructions', //AJBdone
	'othersInvolved',  //AJBdone
	'giveWithholdInformation', //AJBdone
	'noCourtAction', //AJBdone
	'guardian', //AJBdone
	'valuesGoals', //AJBdone
	'endOfLifeWishes', //AJBdone
	'treatmentWishes', //AJBdone
	'pregnancylsTreatment', //AJBdone
	'hospitalization', //AJBdone
	'medicationPreference', //AJBdone
	'researchConsent', // AJBdone
	'organDonation',//AJBdone
	'burial',//AJBdone
	'bodyAfterDeath',//AJBdone
	'otherInstructions' //AJBdone
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
		
$dayPhone = new TextElement ( array (
	'idName' => 'dayPhone', 
	'labelText' => 'Daytime Phone', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '13',
	'cols' => '',
	'rows' => '')
	);

$eveningPhone = new TextElement ( array (
	'idName' => 'eveningPhone', 
	'labelText' => 'Evening Phone', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '13',
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
	'childElements' => array ( $fullNameReq, $birthDate, $streetAddress, $city, $usStateReq, $zip, $email, $dayPhone, $eveningPhone, $reqText ), 
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
	
// ############################ BEGIN PROXY CIRCUMSTANCES PAGE

// ################# FREE TEXT ELEMENT SET

$freeTextElement = new TextElement ( array (
	'idName' => 'freeTextElement', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '5')
	);

$freeTextElementSet = new QuestionFieldSet ( array (
	'idName' => 'freeTextElementSet', 
	'labelText' => '', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ______________ FREE TEXT ELEMENT SET

// ############### CIRCUMSTANCES FIELDSET
$noLonger = new SelectionElement ( array (
	'idName' => 'noLonger', 
	'labelText' => 'when I am no longer able to make health care decisions for myself.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'noLonger',
	'defaultState' => '',
	'outputText' => 'I want my agent to make decisions for me when I am no longer able to make health care decisions for myself.')
	);

$immediately = new SelectionElement ( array (
	'idName' => 'immediately', 
	'labelText' => 'immediately, allowing my agent to make decisions for me right now.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'immediately',
	'defaultState' => '',
	'outputText' => 'I want my agent to make decisions for me immediately, allowing my agent to make decisions for me right now.')
	);

$followingConditions = new SelectionElement ( array (
	'idName' => 'followingConditions', 
	'labelText' => 'when the following condition or event occurs (to be determined as follows):', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'followingConditions',
	'defaultState' => '',
	'outputText' => 'I want my agent to make decisions for me')
	);

$proxyCircumFieldSet = new QuestionFieldSet ( array (
	'idName' => 'fieldSetThree', 
	'labelText' => 'I want my agent to make decisions for me', 
	'childElements' => array ( $noLonger, $immediately, $followingConditions ), 
	'childrenType' => 'radio',
	'required' => '')
	);
// _______________ CIRCUMSTANCES FIELDSET

$proxyCircum = new QuestionPage ( array (
	'idName' => 'proxyCircum', 
	'labelText' => 'General Circumstances for Health Care Agent Authority', 
	'childElements' => array ( $proxyCircumFieldSet ), 
	'pageTitleText' => 'Question One Title', 
	'helpText' => '')
	);

// ________________________ PROXY CIRCUMSTANCES PAGE 


// ########################### HEALTH PROXY PAGE

// ############# PROXY DATA FIELDSET
$relationship = new TextElement ( array (
	'idName' => 'relationship', 
	'labelText' => 'Relationship to Self', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
	
$proxy = new QuestionFieldSet ( array (
	'idName' => 'proxy', 
	'labelText' => 'I appoint the following as my health care Agent to make any and all health care decisions for me, except to the extent that I state otherwise in this Advanced Directive.', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $relationship, $dayPhone, $eveningPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$alternate = new QuestionFieldSet ( array (
	'idName' => 'alternate', 
	'labelText' => 'If this health care agent is unavailable, unable or unwilling to do this for me, I appoint the following as my Alternate Agent.', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $relationship, $dayPhone, $eveningPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$secondAlternate = new QuestionFieldSet ( array (
	'idName' => 'secondAlternate', 
	'labelText' => 'And if my Alternate Agent is unavailable, unable or unwilling to do this, I appoint the following as my Next Alternate Agent.', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $relationship, $dayPhone, $eveningPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
// _______________ PROXY DATA FIELDSET	
	
$healthProxy = new QuestionPage ( array (
	'idName' => 'healthProxy', 
	'labelText' => 'Appointment of Health Care Agents', 
	'childElements' => array ( $proxy, $alternate, $secondAlternate ), 
	'pageTitleText' => 'Health Agent Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
	
// ____________________________ END HEALTH PROXY PAGE


// ###########################  INSTRUCTIONS PAGE
$agentText = new TextObject ( array (
	'idName' => 'agentText',
	'textBody' => 'I give the following further instructions, if any, for my agent\'s guidance:')
	);	
$instructions = new QuestionPage ( array (
	'idName' => 'instructions', 
	'labelText' => 'Further Instructions', 
	'childElements' => array ( $agentText, $freeTextElementSet ), 
	'pageTitleText' => 'Health Agent', 
	'helpText' => '')
	);

// ____________________________ INSTRUCTIONS PAGE

// ########################### OTHERS INVOLVED PAGE

// ############# OTHERS INVOLVED FIELDSET

$myDoctor = new QuestionFieldSet ( array (
	'idName' => 'myDoctor', 
	'labelText' => 'My Doctor or Health Care Clinician:', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $email, $dayPhone, $eveningPhone ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$myAlternateDoctor = new QuestionFieldSet ( array (
	'idName' => 'myAlternateDoctor', 
	'labelText' => 'OR', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $email, $dayPhone, $eveningPhone ), 
	'childrenType' => 'form',
	'required' => '')
	);

$mayConsult = new TextElement ( array (
	'idName' => 'mayConsult', 
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
	
$mayNotConsult = new TextElement ( array (
	'idName' => 'mayNotConsult', 
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
$mayNotConsultSet = new QuestionFieldSet ( array (
	'idName' => 'mayNotConsultSet', 
	'labelText' => 'Those who should NOT be consulted by my agent include:', 
	'childElements' => array ( $mayNotConsult ), 
	'childrenType' => 'form',
	'required' => '')
	);	
$mayConsultSet = new QuestionFieldSet ( array (
	'idName' => 'mayConsultSet', 
	'labelText' => 'Other people whom my agent may consult about medical decisions on my behalf:', 
	'childElements' => array ( $mayConsult ), 
	'childrenType' => 'form',
	'required' => '')
	);

// ______________ OTHERS INVOLVED FIELDSET

$othersInvolved = new QuestionPage ( array (
	'idName' => 'othersInvolved', 
	'labelText' => 'Others Involved in My Care', 
	'childElements' => array (  $myDoctor, $myAlternateDoctor, $mayConsultSet, $mayNotConsultSet ), 
	'pageTitleText' => 'Others Involved in My Care', 
	'helpText' => '')
	);

// _____________________________ OTHERS INVOLVED PAGE

// ############################# GIVE AND WITHHOLD INFORMATION PAGE
$infoText = new TextObject ( array (
	'idName' => 'infoText',
	'textBody' => 'My health agent or health care provider may give information about my condition to the following adults and minors:')
	);	
$giveWithholdInformation = new QuestionPage ( array (
	'idName' => 'giveWithholdInformation', 
	'labelText' => 'Permission to Disclose Health Information', 
	'childElements' => array ( $infoText, $freeTextElementSet ), 
	'pageTitleText' => 'Health Information', 
	'helpText' => '')
	);

// ________________________________ GIVE AND WITHHOLD INFORMATION PAGE

// ################################ NO COURT ACTION PAGE
$courtActionText = new TextObject ( array (
	'idName' => 'courtActionText',
	'textBody' => 'The person(s) named below shall NOT be entitled to bring a court action on my behalf concerning matters covered by this advance directive, nor serve as a healthcare decision maker for me:')
	);	
$noCourtAction = new QuestionPage ( array (
	'idName' => 'noCourtAction', 
	'labelText' => 'Prevention of Court Action', 
	'childElements' => array ( $courtActionText, $freeTextElementSet ), 
	'pageTitleText' => 'Court Action', 
	'helpText' => '')
	);

// ________________________________ NO COURT ACTION PAGE


// ################################ GUARDIAN PAGE
$personDataSet = new QuestionFieldSet ( array (
	'idName' => 'personDataSet',
	'labelText' => '',
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $email, $dayPhone, $eveningPhone ),
	'childrenType' => 'form',
	'required' => '')
	);
	
$agentGuardian = new SelectionElement ( array (
	'idName' => 'agentGuardian', 
	'labelText' => 'My Health Care Agent', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'agentGuardian',
	'defaultState' => '',
	'outputText' => '')
	);

$otherGuardian = new SelectionElement ( array (
	'idName' => 'otherGuardian', 
	'labelText' => 'Another person:', 
	'childElements' => array ( $personDataSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'otherGuardian',
	'defaultState' => '',
	'outputText' => '')
	);

$pickGuardianSet = new QuestionFieldSet ( array (
	'idName' => 'pickGuardianSet', 
	'labelText' => 'If I need a guardian in the future, I ask the court to consider the following person', 
	'childElements' => array ( $agentGuardian, $otherGuardian ), 
	'childrenType' => 'radio',
	'required' => '')
	);
	
$alternateGuardian = new TextElement ( array (
	'idName' => 'alternateGuardian', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '3')
	);

$notGuardian = new TextElement ( array (
	'idName' => 'notGuardian', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '3')
	);

$alternateGuardianSet = new QuestionFieldSet ( array (
	'idName' => 'alternateGuardianSet', 
	'labelText' => 'Alternate preferred Guardians:', 
	'childElements' => array ( $alternateGuardian ), 
	'childrenType' => 'form',
	'required' => '')
	);
$notAlternateGuardianSet = new QuestionFieldSet ( array (
	'idName' => 'notAlternateGuardianSet', 
	'labelText' => 'Persons I would NOT want to be my guardian:', 
	'childElements' => array ( $notGuardian ), 
	'childrenType' => 'form',
	'required' => '')
	);
$altGuardText = new TextObject ( array (
	'idName' => 'altGuardText',
	'textBody' => 'You may also list alternative preferred guardians, or persons that you would not want to have appointed as guardians.')
	);		
// _________________ GUARDIAN FIELDSET	
	
$guardian = new QuestionPage ( array (
	'idName' => 'guardian', 
	'labelText' => 'Designation of Guardians', 
	'childElements' => array ( $pickGuardianSet, $altGuardText, $alternateGuardianSet, $notAlternateGuardianSet ), 
	'pageTitleText' => 'Guardians', 
	'helpText' => '')
	);
	
// _________________________________ GUARDIAN PAGE


// ################################## STATEMENT OF VALUES AND GOALS PAGE

$mostImportantSet = new QuestionFieldSet ( array (
	'idName' => 'mostImportantSet',
	'labelText' => 'Use the space below to state in your own words what is most important to you.',
	'childElements' => array ( $freeTextElement ),
	'childrenType' => 'form',
	'required' => '')
	);
	
$generalAdviceSet = new QuestionFieldSet ( array (
	'idName' => 'generalAdviceSet',
	'labelText' => 'General advice about how to approach health care choices depending upon your current or future state of health or the chances of success of various treatments.',
	'childElements' => array ( $freeTextElement ),
	'childrenType' => 'form',
	'required' => '')
	);
	
$otherStatementSet = new QuestionFieldSet ( array (
	'idName' => 'otherStatementSet',
	'labelText' => 'Other statement of values and goals to help guide health care decisions made on your behalf.',
	'childElements' => array ( $freeTextElement ),
	'childrenType' => 'form',
	'required' => '')
	);

$valuesGoals = new QuestionPage ( array (
	'idName' => 'valuesGoals', 
	'labelText' => 'Statement of Values and Goals', 
	'childElements' => array ( $mostImportantSet, $generalAdviceSet, $otherStatementSet ), 
	'pageTitleText' => 'Statement of Values and Goals', 
	'helpText' => '')
	);

// _________________________________ STATEMENT OF VALUES AND GOALS PAGE


// ################################### END OF LIFE WISHES PAGE
	
// ############### LS WITHHOLD SET
$breathingMachines = new SelectionElement ( array (
	'idName' => 'breathingMachines', 
	'labelText' => 'breathing machines (ventilator or respirator)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'breathingMachines',
	'defaultState' => 'checked',
	'outputText' => 'breathing machines (ventilator or respirator)')
	);

$tubeFeeding = new SelectionElement ( array (
	'idName' => 'tubeFeeding', 
	'labelText' => 'tube feeding (feeding and hydration by medical means)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'tubeFeeding',
	'defaultState' => 'checked',
	'outputText' => 'tube feeding (feeding and hydration by medical means)')
	);

$antibiotics = new SelectionElement ( array (
	'idName' => 'antibiotics', 
	'labelText' => 'antibiotics (except for comfort)', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'antibiotics',
	'defaultState' => 'checked',
	'outputText' => 'antibiotics (except for comfort)')
	);
	
$otherMeds = new SelectionElement ( array (
	'idName' => 'otherMeds', 
	'labelText' => 'other medications whose purpose is to extend my life', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'otherMeds',
	'defaultState' => 'checked',
	'outputText' => 'other medications whose purpose is to extend my life')
	);

$otherMeans = new SelectionElement ( array (
	'idName' => 'otherMeans', 
	'labelText' => 'any other means', 
	'childElements' => array ( ) , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'otherMeans',
	'defaultState' => 'checked',
	'outputText' => 'any other means')
	);

$other = new SelectionElement ( array (
	'idName' => 'other', 
	'labelText' => 'Other (specify)',
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'other',
	'choiceValue' => 'other',
	'defaultState' => '',
	'outputText' => '')
	);
	
$lsWithholdSet = new QuestionFieldSet ( array (
	'idName' => 'lsWithholdSet', 
	'labelText' => '', 
	'childElements' => array ( $breathingMachines, $tubeFeeding, $antibiotics, $otherMeds, $otherMeans, $other), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ________________ LS WITHHOLD SET

// ################ EXTEND LIFE FIELDSET
$possibleTreatments = new SelectionElement ( array (
	'idName' => 'possibleTreatments', 
	'labelText' => 'I want all possible treatments to extend my life.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'possibleTreatments',
	'defaultState' => '',
	'outputText' => 'If the time comes when I am close to death or am unconscious and unlikely to
	become conscious again I do want all possible treatments to extend my life.')
	);

$limitations = new SelectionElement ( array (
	'idName' => 'limitations', 
	'labelText' => 'I do not want my life extended by any of the following means:', 
	'childElements' => array ( $lsWithholdSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'limitations',
	'defaultState' => '',
	'outputText' => 'If the time comes when I am close to death or am unconscious and unlikely to become conscious again I do not want my life extended by any of the following means:')
	);

$agentDecides = new SelectionElement ( array (
	'idName' => 'agentDecides', 
	'labelText' => 'I want my agent to decide what treatments I receive, including tube feeding.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'agentDecides',
	'defaultState' => '',
	'outputText' => 'If the time comes when I am close to death or am unconscious and unlikely to
	become conscious again I want my agent to decide what treatments I receive, including tube feeding.')
	);
		
$extendLife = new QuestionFieldSet ( array (
	'idName' => 'extendLife', 
	'labelText' => 'If the time comes when I am close to death or am unconscious and unlikely to become conscious again ', 
	'childElements' => array ( $possibleTreatments, $limitations, $agentDecides ), 
	'childrenType' => 'radio',
	'required' => '')
	);
// _________________ EXTEND LIFE FIELDSET

// ################# PAIN HOSPICE FIELDSET
$comfortRelief = new SelectionElement ( array (
	'idName' => 'comfortRelief', 
	'labelText' => 'I want care that preserves my dignity and that provides comfort and relief from symptoms that are bothering me.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'comfortRelief',
	'defaultState' => '',
	'outputText' => 'I want care that preserves my dignity and that provides comfort and relief from symptoms that are bothering me.')
	);
	
$painMedication = new SelectionElement ( array (
	'idName' => 'painMedication', 
	'labelText' => 'I want pain medication to be administered to me even though it may have the unintended effect of hastening my death.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'painMedication',
	'defaultState' => '',
	'outputText' => 'I want pain medication to be administered to me even though it may have the unintended effect of hastening my death.')
	);

$hospiceCare = new SelectionElement ( array (
	'idName' => 'hospiceCare', 
	'labelText' => 'I want hospice care when it is appropriate in any setting.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'hospiceCare',
	'defaultState' => '',
	'outputText' => 'I want hospice care when it is appropriate in any setting.')
	);

$dieAtHome = new SelectionElement ( array (
	'idName' => 'dieAtHome', 
	'labelText' => 'I would prefer to die at home if this is possible.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'dieAtHome',
	'defaultState' => '',
	'outputText' => 'I would prefer to die at home if this is possible.')
	);

$otherWishes = new SelectionElement ( array (
	'idName' => 'otherWishes', 
	'labelText' => 'Other wishes and instructions:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'otherWishes',
	'defaultState' => '',
	'outputText' => 'Other wishes and instructions:')
	);

$painHospice = new QuestionFieldSet ( array (
	'idName' => 'painHospice', 
	'labelText' => 'Preferences about pain relief, medication and hospice care:', 
	'childElements' => array ( $comfortRelief, $painMedication, $hospiceCare, $dieAtHome, $otherWishes ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);
// ________________ PAIN HOSPICE FEILDSET

$endOfLifeWishes = new QuestionPage ( array (
	'idName' => 'endOfLifeWishes', 
	'labelText' => 'End of Life Wishes', 
	'childElements' => array ( $extendLife, $painHospice ), 
	'pageTitleText' => 'End of Life Wishes', 
	'helpText' => '')
	);
// _________________________________ END OF LIFE WISHES PAGE


// ################################### OTHER TREATMENT WISHES PAGE

$DNR = new SelectionElement ( array (
	'idName' => 'DNR', 
	'labelText' => 'I wish to have a Do Not Resuscitate (DNR) order written for me.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'DNR',
	'defaultState' => '',
	'outputText' => '')
	);

$trialTreatment= new SelectionElement ( array (
	'idName' => 'trialTreatment', 
	'labelText' => 'If I am in a critical health crisis that may not be life-ending and more time is needed to determine if I can get better, I want treatment started. If, after a reasonable period of time, it becomes clear that I will not get better, I want all life extending treatment stopped. This includes the use of breathing machines or tube feeding.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'trialTreatment',
	'defaultState' => '',
	'outputText' => '')
	); 
$unableToThinkSet = new QuestionFieldSet ( array (
	'idName' => 'unableToThinkSet', 
	'labelText' => '', 
	'childElements' => array ( $breathingMachines, $tubeFeeding, $antibiotics, $otherMeds, $otherMeans, $other ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);	
$treatmentWithhold = new SelectionElement ( array (
	'idName' => 'treatmentWithhold', 
	'labelText' => 'If I am conscious but become unable to think or act for myself and will likely not improve, I do NOT want the following life-extending treatment:', 
	'childElements' => array ( $unableToThinkSet ), 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'treatmentWithhold',
	'defaultState' => '',
	'outputText' => '')
	);
$likelyCost= new SelectionElement ( array (
	'idName' => 'likelyCost', 
	'labelText' => 'If the likely cost, risks and burdens of treatment are more than I wish to endure, I do not want life-extending treatment. The costs, risks and burdens that concern me the most are:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'likelyCost',
	'defaultState' => '',
	'outputText' => '')
	);


$treatmentWishesSet = new QuestionFieldSet ( array (
	'idName' => 'treatmentWishesSet', 
	'labelText' => 'Select all that apply to you:', 
	'childElements' => array ( $DNR, $trialTreatment, $treatmentWithhold, $likelyCost ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);
	
$treatmentWishes  = new QuestionPage ( array (
	'idName' => 'treatmentWishes', 
	'labelText' => 'Other Treatment Wishes', 
	'childElements' => array ( $treatmentWishesSet ), 
	'pageTitleText' => 'Other Treatment Wishes', 
	'helpText' => '')
	); 
// ############################### PREGNANCY PAGE

// ################# PREGNANCY SET

$pregnantlsTreatments = new SelectionElement ( array (
	'idName' => 'pregnantLSTreatments', 
	'labelText' => 'all life sustaining treatment.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'possibleTreatments',
	'defaultState' => '',
	'outputText' => 'If it is determined that I am pregnant at the time of this Advanced Directive become effective, I want all life sustaining treatment.')
	);
	
$pregnantLimitations = new SelectionElement ( array (
	'idName' => 'pregnantLimitations', 
	'labelText' => 'only the following life sustaining treatments:', 
	'childElements' => array ( $lsWithholdSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'pregnantLimitations',
	'defaultState' => '',
	'outputText' => '')
	);
	
$nolsTreatments = new SelectionElement ( array (
	'idName' => 'nolsTreatments', 
	'labelText' => 'no life sustaining treatment', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'nolsTreatments',
	'defaultState' => '',
	'outputText' => '')
	);
	
$pregnantlsWithholdSet = new QuestionFieldSet ( array (
	'idName' => 'pregnantlsWithholdSet', 
	'labelText' => 'If it is determined that I am pregnant at the time that this Advanced Directive becomes effective, I want:', 
	'childElements' => array ( $pregnantlsTreatments, $pregnantLimitations,  $nolsTreatments ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// _________________ PREGNANCY SET
$pregnancylsTreatment  = new QuestionPage ( array (
	'idName' => 'pregnancylsTreatment', 
	'labelText' => 'In the case of Pregnancy', 
	'childElements' => array ( $pregnantlsWithholdSet ), 
	'pageTitleText' => 'If Pregnant', 
	'helpText' => 'This section is only for women. Please skip if you are male by clicking Continue below.')
	);
// ________________________ PREGNANCY PAGE

// ################################### HOSPITALIZATION PAGE
$hospital = new TextElement ( array (
	'idName' => 'hospital', 
	'labelText' => 'Hospital/Facility', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
	
$hospitalYesSet = new QuestionFieldSet ( array (
	'idName' => 'hosptialYesSet', 
	'labelText' => 'If I need care in a hospital or treatment facility, the following facilities are listed in order of preference', 
	'childElements' => array ( $hospital, $streetAddress, $city, $dayPhone ), 
	'childrenType' => 'form',
	'required' => 'no')
	);

$hospitalYesSet2 = new QuestionFieldSet ( array (
	'idName' => 'hosptialYesSet2', 
	'labelText' => '', 
	'childElements' => array ( $hospital, $streetAddress, $city, $dayPhone ), 
	'childrenType' => 'form',
	'required' => 'no')
	);
	
$hospitalNoSet = new QuestionFieldSet ( array (
	'idName' => 'hosptialNoSet', 
	'labelText' => 'I would like to avoid being treated in the following facilities:', 
	'childElements' => array ( $hospital ), 
	'childrenType' => 'form',
	'required' => 'no')
	);

$hospitalNoSet2 = new QuestionFieldSet ( array (
	'idName' => 'hosptialNoSet2', 
	'labelText' => '', 
	'childElements' => array ( $hospital ), 
	'childrenType' => 'form',
	'required' => 'no')
	);
	
$hospitalization  = new QuestionPage ( array (
	'idName' => 'hospitalization', 
	'labelText' => 'Hospitalization Preferences', 
	'childElements' => array ( $hospitalYesSet, $hospitalYesSet2, $hospitalNoSet, $hospitalNoSet2 ), 
	'pageTitleText' => 'Hospitalization', 
	'helpText' => '')
	);
// _________________________________ HOSPITALIZATION PAGE



// ################################### MEDICATION WISHES PAGE
$medicationPreferenceSet = new QuestionFieldSet ( array (
	'idName' => 'medicationPreferenceSet', 
	'labelText' => 'I prefer the following medications or treatments:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => 'no')
	);
	
$medicationAvoidSet = new QuestionFieldSet ( array (
	'idName' => 'medicationAvoidSet', 
	'labelText' => 'Avoid use of the following medications or treatments:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => 'no')
	);
	
$medicationPreference = new QuestionPage ( array (
	'idName' => 'medicationPreference', 
	'labelText' => 'Medication Preferences', 
	'childElements' => array ( $medicationPreferenceSet, $medicationAvoidSet ), 
	'pageTitleText' => 'Medication Preference', 
	'helpText' => '')
	);
// _________________________________ MEDICATION WISHES PAGE 


// ################################### RESEARCH CONSENT PAGE
$researchText = new TextObject ( array (
	'idName' => 'researchText',
	'textBody' => 'Consent for Student Education, Treatment Studies, or Drug Trials')
	);		
	
// ################ AUTHORIZE AGENT TO CONSENT TO STUDIES FIELDSET
$authorizeAgent = new SelectionElement ( array (
	'idName' => 'authorizeAgent', 
	'labelText' => 'I authorize my agent to consent to my participation in student medical education, treatment studies, or drug trials.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => 'no',
	'validationType' => 'none',
	'choiceValue' => 'optionTwo',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$authorizeAgentSet = new QuestionFieldSet ( array (
	'idName' => 'authorizeAgentSet', 
	'labelText' => '', 
	'childElements' => array ( $authorizeAgent ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// _________________________ AUTHORIZE AGENT TO CONSENT TO STUDIES FIELDSET

// ######################### CONSENT TO RESEARCH AND MEDICAL EDUCATION FIELDSET
$radioIDo = new SelectionElement ( array (
	'idName' => 'radioIDo', 
	'labelText' => 'I do', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'radioIDo',
	'defaultState' => '',
	'outputText' => '')
	);
	
$radioIDoNot = new SelectionElement ( array (
	'idName' => 'radioIDoNot', 
	'labelText' => 'I do not', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'radioIDoNot',
	'defaultState' => '',
	'outputText' => '')
	);
	
$medicalEducationConsentSet = new QuestionFieldSet ( array (
	'idName' => 'medicalEducationConsentSet', 
	'labelText' => 'Whether I wish to participate in student medical education.', 
	'childElements' => array ( $radioIDo, $radioIDoNot ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
	
$treatmentStudiesConsentSet = new QuestionFieldSet ( array (
	'idName' => 'treatmentStudiesConsentSet', 
	'labelText' => 'Whether I wish to participate in treatment studies or drug trials', 
	'childElements' => array ( $radioIDo, $radioIDoNot ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// _______________________ CONSENT TO RESEARCH AND MEDICAL EDUCATION FIELDSET

$researchConsent = new QuestionPage ( array ( 
	'idName' => 'researchConsent', 
	'labelText' => 'Research Consent', 
	'childElements' => array ( $researchText, $authorizeAgentSet, $medicalEducationConsentSet, $treatmentStudiesConsentSet ), 
	'pageTitleText' => 'Research Consent', 
	'helpText' => '')
	);

// _________________________________RESEARCH CONSENT PAGE


// ################################### ORGAN DONATION PAGE

// ################ ORGAN TYPE FIELDSET

$anyNeeded = new SelectionElement ( array (
	'idName' => 'anyNeeded', 
	'labelText' => 'any needed organs or tissues', 
	'childElements' => array ( ) , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'anyNeeded',
	'defaultState' => '',
	'outputText' => '')
	);

$majorOrgans = new SelectionElement ( array (
	'idName' => 'majorOrgans', 
	'labelText' => 'major organs (heart, lungs, kidneys, etc)', 
	'childElements' => array ( ) , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'majorOrgans',
	'defaultState' => '',
	'outputText' => '')
	);
	
$skinBones = new SelectionElement ( array (
	'idName' => 'skinBones',
	'labelText' => 'tissues such as skin and bones',
	'childElements' => array (),
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'skinBones',
	'defaultState' => '',
	'outputText' => '')
	);
	
$eyeTissue = new SelectionElement ( array (
	'idName' => 'eyeTissue', 
	'labelText' => 'eye tissue such as corneas', 
	'childElements' => array ( ) , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'eyeTissue',
	'defaultState' => '',
	'outputText' => '')
	);
	
$organsSet = new QuestionFieldSet ( array (
	'idName' => 'organsSet', 
	'labelText' => '', 
	'childElements' => array ( $anyNeeded, $majorOrgans, $skinBones, $eyeTissue ), 
	'childrenType' => 'checkbox',
	'required' => 'no')
	);
// ____________________ ORGAN TYPE FIELDSET	

// #################### DONATION CONSENT FIELDSET
$refuseToDonate = new SelectionElement ( array (
	'idName' => 'refuseToDonate', 
	'labelText' => 'I do NOT wish to be an organ donor', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'refuseToDonate',
	'defaultState' => '',
	'outputText' => '')
	);
	
$wishToDonate = new SelectionElement ( array (
	'idName' => 'wishToDonate', 
	'labelText' => 'I wish to donate the following organs and tissues.', 
	'childElements' => array ( $organsSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'wishToDonate',
	'defaultState' => '',
	'outputText' => '')
	);

$wishRefuseToDonateSet = new QuestionFieldSet ( array (
	'idName' => 'wishRefuseToDonateSet', 
	'labelText' => 'I want my agent (if I have appointed one) and all who care about me to follow my wishes about organ donation if that is an option at the time of my death.', 
	'childElements' => array ( $refuseToDonate, $wishToDonate ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ DONATION CONSENT FIELDSET
	
// #################### AGENT DECIDES FIELDSET

$agentDecision = new SelectionElement ( array (
	'idName' => 'agentDecision', 
	'labelText' => 'I wish my agent to make any decisions for anatomical gifts.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'agentDecision',
	'defaultState' => '',
	'outputText' => '')
	);
	
$followingDecision = new SelectionElement ( array (
	'idName' => 'followingDecision', 
	'labelText' => 'I wish the following person(s) to make any decisions for anatomical gifts.', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'followingDecision',
	'defaultState' => '',
	'outputText' => '')
	);

$agentDecisionSet = new QuestionFieldSet ( array (
	'idName' => 'agentDecisionSet', 
	'labelText' => 'Agent for organ donation', 
	'childElements' => array ( $agentDecision, $followingDecision ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);	
	
// #################### ANATOMICAL STUDY FIELDSET
$anatomicalStudy = new SelectionElement ( array (
	'idName' => 'anatomicalStudy', 
	'labelText' => 'I desire to donate my body to research or educational programs. Note: you will have to make your own arrangements through a Medical School or other program', 
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
// ______________________ ANATOMICAL STUDY FIELDSET	
	
$organDonation = new QuestionPage ( array ( 
	'idName' => 'organDonation', 
	'labelText' => 'Organ and Tissue Donation', 
	'childElements' => array ( $wishRefuseToDonateSet, $agentDecisionSet, $anatomicalStudySet ), 
	'pageTitleText' => 'Organ and Tissue Donation', 
	'helpText' => '')
	); 

// _________________________________ORGAN DONATION PAGE

// ################################### BURIAL OR CREMATION PAGE

// ################## DIRECTIONS FOR BURIAL FIELDSET
$funeralParlor = new QuestionFieldSet ( array (
	'idName' => 'funeralParlor', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $dayPhone ), 
	'childrenType' => 'form',
	'required' => '')
	);

$alreadyMadeArrangements = new SelectionElement ( array (
	'idName' => 'alreadyMadeArrangements', 
	'labelText' => 'I have already made funeral or cremation arrangements with:', 
	'childElements' => array ( $funeralParlor ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'alreadyMadeArrangements',
	'defaultState' => '',
	'outputText' => '')
	);
	
$casket = new SelectionElement ( array (
	'idName' => 'casket', 
	'labelText' => 'I want a funeral followed by burial in a casket at the following location, if possible (please tell us where the burial plot is located and whether it has been pre-purchased):', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'casket',
	'defaultState' => '',
	'outputText' => '')
	);
	
$cremate = new SelectionElement ( array (
	'idName' => 'cremate', 
	'labelText' => 'I want to be cremated and want my ashes buried or distributed as follows:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'cremate',
	'defaultState' => '',
	'outputText' => '')
	);

$familyArrangements = new SelectionElement ( array (
	'idName' => 'familyArrangements', 
	'labelText' => 'I want to have arrangements made at the direction of my agent or family.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'familyArrangements',
	'defaultState' => '',
	'outputText' => '')
	);

$burialArrangements = new QuestionFieldSet ( array (
	'idName' => 'burialArrangements', 
	'labelText' => '', 
	'childElements' => array ( $alreadyMadeArrangements, $casket, $cremate, $familyArrangements ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ___________________ DIRECTIONS FOR BURIAL FIELDSET

// ################### OTHER INSTRUCTIONS FIELDSET
$otherInstructions = new TextElement ( array (
	'idName' => 'otherInstructions', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '3')
	);

$otherInstructionsSet = new QuestionFieldSet ( array (
	'idName' => 'otherInstructionsSet', 
	'labelText' => 'Other Instructions:', 
	'childElements' => array ( $otherInstructions ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ___________________ OTHER INSTRUCTIONS

$burial = new QuestionPage ( array ( 
	'idName' => 'burial', 
	'labelText' => 'Burial or Cremation Preferences', 
	'childElements' => array ( $burialArrangements, $otherInstructionsSet ), 
	'pageTitleText' => 'Burial or Cremation', 
	'helpText' => '')
	);

// _____________________________________ BURIAL OR CREMATION PAGE

// ##################################### DISPOSITION OF THE BODY AFTER DEATH PAGE

// ################### AGENT FOR DISPOSITION OF MY BODY
$myAgent = new SelectionElement ( array (
	'idName' => 'myAgent', 
	'labelText' => 'I want my health care agent to decide arrangements after my death. If he or she is not available, I want my alternate agent to decide.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'myAgent',
	'defaultState' => '',
	'outputText' => '')
	);

$notMyAgent = new SelectionElement ( array (
	'idName' => 'notMyAgent', 
	'labelText' => 'I appoint the following person to decide about and arrange for the disposition of my body after my death:', 
	'childElements' => array ( $personDataSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'notMyAgent',
	'defaultState' => '',
	'outputText' => '')
	);

$familyToDecide = new SelectionElement ( array (
	'idName' => 'familyToDecide', 
	'labelText' => 'I want my family to decide.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'familyToDecide',
	'defaultState' => '',
	'outputText' => '')
	);

$dispositionAgentSet = new QuestionFieldSet ( array (
	'idName' => 'dispositionAgentSet', 
	'labelText' => '', 
	'childElements' => array ( $myAgent, $notMyAgent, $familyToDecide ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// _____________________ DISPOSITION OF AGENT FIELDSET

// ##################### AUTOPSY FIELDSET

$supportAutopsy = new SelectionElement ( array (
	'idName' => 'supportAutopsy', 
	'labelText' => 'I support having an autopsy performed.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'supportAutopsy',
	'defaultState' => '',
	'outputText' => '')
	);

$familyDecidesAutopsy = new SelectionElement ( array (
	'idName' => 'familyDecidesAutopsy', 
	'labelText' => 'I would like my agent or family to decide whether to have it done.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'familyDecidesAutopsy',
	'defaultState' => '',
	'outputText' => '')
	);

$autopsySet = new QuestionFieldSet ( array (
	'idName' => 'autopsySet', 
	'labelText' => 'If an autopsy is suggested following my death:', 
	'childElements' => array ( $supportAutopsy, $familyDecidesAutopsy ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ______________________ AUTOPSY FIELDSET	

$bodyAfterDeath = new QuestionPage ( array ( 
	'idName' => 'bodyAfterDeath', 
	'labelText' => 'Disposition of My Body', 
	'childElements' => array ( $dispositionAgentSet, $autopsySet ), 
	'pageTitleText' => 'Disposition of My Body', 
	'helpText' => '')
	);	
	
	
// ___________________________________ DISOPSITION OF BODY AFTER DEATH PAGE

// ################################### OTHER INSTRUCTIONS PAGE
$otherInstText = new TextObject ( array (
	'idName' => 'otherInstText',
	'textBody' => 'I give the following additional instructions about my end of life care and disposition of my remains:')
	);	
$otherInstructions = new QuestionPage ( array (
	'idName' => 'otherInstructions', 
	'labelText' => 'Additional Instructions and Preferences', 
	'childElements' => array ( $otherInstText, $freeTextElementSet ), 
	'pageTitleText' => 'Other Instructions', 
	'helpText' => '')
	);

// _________________________________OTHER INSTRUCTIONS PAGE


// END


?>
