<?php

$newhampshire = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'alternateHP',
	'lsTreatment', //AJBdone
	'nutritionHydration', //AJBdone
	'additionalInstructions', //AJBdone
	'otherInstructions', //AJBdone
	'organDonation' //AJBdone
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
	'pageTitleText' => 'Your Information', 
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
	'pageTitleText' => 'Health Proxy', 
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

// ############################ LIVING WILL

$lsYes = new SelectionElement ( array (
	'idName' => 'lsYes', 
	'labelText' => 'Life-sustaining treatment not be started, or if started, be discontinued.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'lsYes',
	'defaultState' => '',
	'outputText' => '')
	);
	
$lsNo= new SelectionElement ( array (
	'idName' => 'lsNo', 
	'labelText' => 'Life-sustaining treatment continue to be given to me.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'lsNo',
	'defaultState' => '',
	'outputText' => '')
	);

$nearDeathSet = new QuestionFieldSet ( array (
	'idName' => 'nearDeathSet', 
	'labelText' => 'If I am near death and lack the capacity to make health care decisions, I authorize my agent to direct that:', 
	'childElements' => array ( $lsYes, $lsNo ), 
	'childrenType' => 'radio',
	'required' => '')
	);

$permanentlyUnconsciousSet = new QuestionFieldSet ( array (
	'idName' => 'permanentlyUnconsciousSet', 
	'labelText' => 'Whether near death or not, if I become permanently unconscious I authorize my agent to direct that:', 
	'childElements' => array ( $lsYes, $lsNo ), 
	'childrenType' => 'radio',
	'required' => '')
	);
	
$lsTreatment = new QuestionPage ( array (
	'idName' => 'lsTreatment', 
	'labelText' => 'Life-Sustaining Treatment Options', 
	'childElements' => array ( $nearDeathSet, $permanentlyUnconsciousSet ), 
	'pageTitleText' => 'Life-Sustaining Treatment', 
	'helpText' => '')
	);

// ______________________________ LIFE SUSTAINING TREATMENT PAGAE

// ############################## MEDICALLY ADMINISTERED NUTRITION AND HYDRATION PAGE
	
$nutritionYes = new SelectionElement ( array (
	'idName' => 'nutritionYes', 
	'labelText' => 'Medically administered nutrition and hydration not be started or, if started, be discontinued.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'nutritionYes',
	'defaultState' => '',
	'outputText' => '')
	);
	
$nutritionNo= new SelectionElement ( array (
	'idName' => 'nutritionNo', 
	'labelText' => 'Even if all other forms of life-sustaining treatment have been withdrawn, medically administered nutrition and hydration continue to be given to me.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'nutritionNo',
	'defaultState' => '',
	'outputText' => '')
	);

$nutritionSet = new QuestionFieldSet ( array (
	'idName' => 'nutritionSet', 
	'labelText' => 'I realize that situations could arise in which the only way to allow me to die would be to not start or to discontinue medically administered nutrition and hydration. In carrying out any instructions I have given in this document, I authorize my agent to direct that:', 
	'childElements' => array ( $nutritionYes, $nutritionNo ), 
	'childrenType' => 'radio',
	'required' => '')
	);
	
$nutritionHydration = new QuestionPage ( array (
	'idName' => 'nutritionHydration', 
	'labelText' => 'Nutrition and Hydration Options', 
	'childElements' => array ( $nutritionSet ), 
	'pageTitleText' => 'Nutrition and Hydration', 
	'helpText' => '')
	);
	
// _____________________________ MEDICALLY ADMINISTERED NUTRITION AND HYDRATION PAGE
	
// ############################# ADDITIONAL INSTRUCTIONS

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

$limitText = new TextObject ( array (
	'idName' => 'limitText',
	'textBody' => 'Here you may include any specific desires or limitations you deem appropriate, such as when or what life-sustaining treatment you would want used or withheld, or instructions about refusing any specific types of treatment that are inconsistent with your religious beliefs or are unacceptable to you for any other reason. You may leave this question blank if you desire.')
	);	

$additionalInstructions = new QuestionPage ( array (
	'idName' => 'additionalInstructions', 
	'labelText' => 'Desires and Limitations', 
	'childElements' => array ( $limitText, $freeTextElementSet ), 
	'pageTitleText' => 'Additional Instructions', 
	'helpText' => '')
	);

// ________________________________ ADDITIONAL INSTRUCTIONS


// ############################### OTHER INSTRUCTIONS

$ftYes = new SelectionElement ( array (
	'idName' => 'ftYes', 
	'labelText' => 'even if other forms of life-sustaining treatment have been withdrawn, medically administered nutrition and hydration continue to be given to me.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'ftYes',
	'defaultState' => '',
	'outputText' => '')
	);
	
$ftNo= new SelectionElement ( array (
	'idName' => 'ftNo', 
	'labelText' => 'medically administered nutrition and hydration not be started or, if started, be discontinued,', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'ftNo',
	'defaultState' => '',
	'outputText' => '')
	);
	
$ftSet = new QuestionFieldSet ( array (
	'idName' => 'ftSet', 
	'labelText' => 'In carrying out any instruction I have given under this section, I authorize that:', 
	'childElements' => array ( $ftYes, $ftNo ), 
	'childrenType' => 'radio',
	'required' => '')
	);
	
$otherInstructionsSet = new QuestionFieldSet ( array (
	'idName' => 'otherInstructionsSet', 
	'labelText' => 'Other directions:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'radio',
	'required' => '')
	);
	
$otherInstructions = new QuestionPage ( array (
	'idName' => 'otherInstructions', 
	'labelText' => 'Other Instructions', 
	'childElements' => array ( $ftSet, $otherInstructionsSet ), 
	'pageTitleText' => 'Other Instructions', 
	'helpText' => '')
	);

// ___________________________________ OTHER INSTRUCTIONS

// ################################### ORGAN DONATION PAGE

// ################ ORGAN TYPE FIELDSET
$anyNeeded = new SelectionElement ( array (
	'idName' => 'anyNeeded', 
	'labelText' => 'Any needed organs or tissues', 
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
	'labelText' => 'For (select one):', 
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
	'labelText' => 'Pursuant to New Hampshire law, I hereby give, effective on my death:', 
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
	'labelText' => 'Choose from below the statement that best reflects your wishes.', 
	'childElements' => array ( $refuseToDonate, $writtenSigned, $wishToDonate ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
// ____________________ DONATION CONSENT FIELDSET
	
$organDonation = new QuestionPage ( array ( 
	'idName' => 'organDonation', 
	'labelText' => 'Organ and Tissue Donation', 
	'childElements' => array ( $wishRefuseToDonateSet ), 
	'pageTitleText' => 'Organ and Tissue Donation', 
	'helpText' => 'You do not have to select any of the statements. If you do not select any of the statements, your attorney for health care, proxy, or other agent, or your family, may have the authority to make a gift of all or part of your body under New Hampshire law.')
	); 

// _________________________________ORGAN DONATION PAGE


?>

