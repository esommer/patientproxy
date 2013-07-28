<?php
$indiana = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'alternateHP', //AJBdone
	'instructions', // AJBdone
	'prolongLife',
	'nutrition', 
	'furtherDeclare',
	'organDonation',//AJBdone
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
	'labelText' => 'Your Personal Information.', 
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

// ############################ INSRUCTIONS PAGE
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

$guidance = new TextObject ( array (
	'idName' => 'guidance',
	'textBody' => 'When making health-care decisions for me, my health-care representative should think about what action would be consistent with past conversations we have had, my treatment preferences as expressed in this document, my religious and other beliefs and values, and how I have handled medical and other important issues in the past. If what I would decide is still unclear, then my health-care representative should make decisions for me that my health-care representative believes are in my best interest, considering the benefits, burdens, and risks of my current circumstances and treatment options.')
	);

$instructionsSet = new QuestionFieldSet ( array (
	'idName' => 'instructionsSet', 
	'labelText' => 'In addition, my health proxy should consider the following instructions in making health care decisions on my behalf:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => 'no')
	);

$instructions = new QuestionPage ( array (
	'idName' => 'instructions', 
	'labelText' => 'Guidance for my Health-Care Representative', 
	'childElements' => array ( $guidance, $instructionsSet ), 
	'pageTitleText' => 'Guidance', 
	'helpText' => '')
	);
// ____________________________ INSTRUCTIONS PAGE


// ############################# LIFE PROLONGING TREATMENT PAGE
$lpTreatment = new SelectionElement ( array (
	'idName' => 'lpTreatment', 
	'labelText' => '<span class="strong">Life-Prolonging Procedures Declaration</span> I want the use of life-prolonging procedures that would extend my life under all circumstances. This includes appropriate nutrition and hydration, the administration of medication, and the performance of all other medical procedures necessary to extend my life, to provide comfort care, or to alleviate pain.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'lpTreatment',
	'defaultState' => '',
	'outputText' => '')
	);

$lpTreatmentNo = new SelectionElement ( array (
	'idName' => 'lpTreatmentNo', 
	'labelText' => '<span class="strong">Living Will Declaration</span> I request that my dying shall not be artificially prolonged. If my death will occur within a short time and the use of life prolonging procedures would serve only to artificially prolong the dying process, I direct that such procedures be withheld or withdrawn, and that I be permitted to die naturally with only the performance or provision of any medical procedure or medication necessary to provide me with comfort care or to alleviate pain, and, if I have so indicated below, the provision of artificially supplied nutrition and hydration.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'lpTreatmentNo',
	'defaultState' => '',
	'outputText' => '')
	);

$prolongLifeSet = new QuestionFieldSet ( array (
	'idName' => 'prolongLifeSet', 
	'labelText' => 'I, being at least eighteen (18) years old and of sound mind, willfully and voluntarily exercise my right to determine the course of my health care and to provide clear and convincing proof of my treatment decisions. If at any time I have an incurable injury, disease, or illness determined to be a terminal condition and am unable to make decisions, I declare that:', 
	'childElements' => array ( $lpTreatment, $lpTreatmentNo ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ DONATION CONSENT FIELDSET
	
$prolongLife = new QuestionPage ( array ( 
	'idName' => 'prolongLife', 
	'labelText' => 'End of Life Wishes Declaration', 
	'childElements' => array ( $prolongLifeSet ), 
	'pageTitleText' => 'Life-Prolonging Treatment', 
	'helpText' => '')
	);
// _____________________________ LIFE PROLONGING TREATMENT PAGE


// ############################# ARTIFICIALLY-PROVIDED NUTRITION AND HYDRATION PAGE
$authorize = new SelectionElement ( array (
	'idName' => 'authorize', 
	'labelText' => 'I wish to receive artificially supplied nutrition and hydration, even if the effort to sustain life is futile or excessively burdensome to me.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'authorize',
	'defaultState' => '',
	'outputText' => '')
	);

$doNotAuthorize = new SelectionElement ( array (
	'idName' => 'doNotAuthorize', 
	'labelText' => 'I do not wish to receive artificially supplied nutrition and hydration, if the effort to sustain life is futile or excessively burdensome to me.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'doNotAuthorize',
	'defaultState' => '',
	'outputText' => '')
	);

$authSurrogate = new SelectionElement ( array (
	'idName' => 'authSurrogate', 
	'labelText' => 'I intentionally make no decision concerning artificially supplied nutrition and hydration, leaving the decision to my health-care representative appointed under Indiana Code 16-36-1-7 or my attorney-in-fact with health-care powers under Indiana Code 30-5-5.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'authSurrogate',
	'defaultState' => '',
	'outputText' => '')
	);

$nutritionSet = new QuestionFieldSet ( array (
	'idName' => 'nutritionSet', 
	'labelText' => '', 
	'childElements' => array ( $authorize, $doNotAuthorize, $authSurrogate ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ DONATION CONSENT FIELDSET
	
$nutrition = new QuestionPage ( array ( 
	'idName' => 'nutrition', 
	'labelText' => 'Artificial Nutrition and Hydration', 
	'childElements' => array ( $nutritionSet ), 
	'pageTitleText' => 'Nutrition and Hydration', 
	'helpText' => '')
	);
// _____________________________ ARTIFICIALLY-PROVIDED NUTRITION AND HYDRATION PAGE

$furtherDeclareSet = new QuestionFieldSet ( array (
	'idName' => 'furtherDeclareSet', 
	'labelText' => 'I further declare that:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => 'no')
	);

$furtherDeclare = new QuestionPage ( array (
	'idName' => 'furtherDeclare', 
	'labelText' => 'Additional Wishes and Declarations', 
	'childElements' => array ( $furtherDeclareSet ), 
	'pageTitleText' => 'Further Declare', 
	'helpText' => '')
	);

// ################################### ORGAN DONATION PAGE

// ################ ORGAN TYPE FIELDSET
$anyNeeded = new SelectionElement ( array (
	'idName' => 'anyNeeded', 
	'labelText' => 'Any needed organs or parts.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'anyNeeded',
	'defaultState' => '',
	'outputText' => '')
	);

$theFollowing= new SelectionElement ( array (
	'idName' => 'theFollowing', 
	'labelText' => 'The following part or organs listed below:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'theFollowing',
	'defaultState' => '',
	'outputText' => '')
	);	

$organsSet = new QuestionFieldSet ( array (
	'idName' => 'organsSet', 
	'labelText' => '', 
	'childElements' => array ( $anyNeeded, $theFollowing ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ ORGAN TYPE FIELDSET	

$anyPurpose = new SelectionElement ( array (
	'idName' => 'anyPurpose', 
	'labelText' => 'Any legally authorized purpose', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'anyPurpose',
	'defaultState' => '',
	'outputText' => '')
	);

$therapeutic = new SelectionElement ( array (
	'idName' => 'therapeutic', 
	'labelText' => 'Transplant or therapeutic purposes only.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'therapeutic',
	'defaultState' => '',
	'outputText' => '')
	);	

$purposeSet = new QuestionFieldSet ( array (
	'idName' => 'purpose', 
	'labelText' => 'For:', 
	'childElements' => array ( $anyPurpose, $therapeutic ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

// #################### DONATION CONSENT FIELDSET
$refuseToDonate = new SelectionElement ( array (
	'idName' => 'refuseToDonate', 
	'labelText' => 'I do not want to make an organ or tissue donation and I do not want my attorney for health care, proxy, or other agent or family to do so.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'refuseToDonate',
	'defaultState' => '',
	'outputText' => '')
	);

$writtenSigned = new SelectionElement ( array (
	'idName' => 'writtenSigned', 
	'labelText' => 'I have already signed a written agreement or donor card regarding organ and tissue donation with the following individual or institution:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'writtenSigned',
	'defaultState' => '',
	'outputText' => '')
	);	

$wishToDonate = new SelectionElement ( array (
	'idName' => 'wishToDonate', 
	'labelText' => 'Pursuant to Indiana law, I hereby give, effective on my death:', 
	'childElements' => array ( $organsSet, $purposeSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'wishToDonate',
	'defaultState' => '',
	'outputText' => '')
	);

$wishRefuseToDonateSet = new QuestionFieldSet ( array (
	'idName' => 'wishRefuseToDonateSet', 
	'labelText' => 'Select the statement below that best reflects your wishes:', 
	'childElements' => array ( $refuseToDonate, $writtenSigned, $wishToDonate ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ DONATION CONSENT FIELDSET


$organDonation = new QuestionPage ( array ( 
	'idName' => 'organDonation', 
	'labelText' => 'Organ Donation', 
	'childElements' => array ( $wishRefuseToDonateSet ), 
	'pageTitleText' => 'Organ and Tissue Donation', 
	'helpText' => 'You do not have to select any of the statements. If you do not select any of the statements, your attorney for health care, proxy, or other agent, or your family, may have the authority to make a gift of all or part of your body under Indiana law.')
	);



?>