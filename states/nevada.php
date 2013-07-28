<?php
$nevada = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'alternateHP', //AJBdone
	'limitations', // AJBdone
	'statementOfDesires', //AJBdone
	'otherDesires', //AJBdone
	'lifeSustaining', //AJBdone
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
$personData2 = new QuestionFieldSet ( array (
	'idName' => 'personData2', 
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
	'helpText' =>  'Alternate Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END HEALTH PROXY PAGE

// ########################### ALTERNATE HP PAGE
$alternateHP = new QuestionPage ( array (
	'idName' => 'alternateHP', 
	'labelText' => 'Designate an Alternate and Second Alternate Health Proxy (Optional)', 
	'childElements' => array ( $personData, $personData2 ), 
	'pageTitleText' => 'Alternate Health Proxy Info', 
	'helpText' => 'Alternate Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END ALTERNATE HP PAGE

// ######################### LIMITATION PAGE
	
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

// ############# EXPIRATION DATE FIELDSET
$limitText = new TextObject ( array (
	'idName' => 'limitText',
	'textBody' => 'In exercising the authority under this durable power of attorney for health care, the authority of my agent is subject to the following special provisions and limitations:')
	);
$expDate = new TextElement ( array (
	'idName' => 'expDate', 
	'labelText' => 'Expiration Date', 
	'childElements' => array(), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
$expDateSet = new QuestionFieldSet ( array (
	'idName' => 'expDateSet', 
	'labelText' => 'I understand that this power of attorney will exist indefinitely from the date I execute this document unless I establish a shorter time. If I am unable to make health care decisions for myself when this power of attorney expires, the authority I have granted my attorney-in-fact [Health Proxy] will continue to exist until the time when I become able to make health care decisions for myself.
	I wish to have this power of attorney end on the following date:', 
	'childElements' => array ( $expDate ), 
	'childrenType' => 'form',
	'required' => '')
	);
// ____________ END EXPIRATION DATE FIELDSET

$limitations = new QuestionPage ( array (
	'idName' => 'limitations', 
	'labelText' => 'Limitation and Duration', 
	'childElements' => array ( $limitText, $freeTextElementSet, $expDateSet ), 
	'pageTitleText' => 'Limitation and Duration', 
	'helpText' => '')
	);

// ____________________________ LIMITATIONS PAGE

// ############################ STATEMENT OF DESIRES

$lifeProlonged = new SelectionElement ( array (
	'idName' => 'lifeProlonged', 
	'labelText' => 'I desire that my life be prolonged to the greatest extent possible, without regard to my condition, the chances I have for recovery or long-term survival, or the cost of the procedures.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lifeProlonged',
	'defaultState' => '',
	'outputText' => '')
	);

$coma = new SelectionElement ( array (
	'idName' => 'coma', 
	'labelText' => 'If I am in a coma which my doctors have reasonably concluded is irreversible, I desire that life-sustaining or prolonging treatments not be
	used.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'coma',
	'defaultState' => '',
	'outputText' => '')
	);

$incurable = new SelectionElement ( array (
	'idName' => 'incurable', 
	'labelText' => 'If I have an incurable or terminal condition or illness and no reasonable hope of long-term recovery or survival, I desire that life-sustaining or prolonging treatments NOT be used.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'incurable',
	'defaultState' => '',
	'outputText' => '')
	);
	
$artificialNutrition = new SelectionElement ( array (
	'idName' => 'artificialNutrition', 
	'labelText' => 'Withholding or withdrawal of artificial nutrition and hydration may result in death by starvation or dehydration. I want to receive or continue receiving artificial nutrition and hydration by way of the gastro-intestinal tract after all other treatment is withheld.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'artificialNutrition',
	'defaultState' => '',
	'outputText' => '')
	);

$benefits = new SelectionElement ( array (
	'idName' => 'benefits', 
	'labelText' => 'I do not desire treatment to be provided and/or continued if the burdens of the treatment outweigh the expected benefits. My attorney-in-fact is to consider the relief of suffering, the preservation or restoration of functioning, and the quality as well as the extent of the possible extension of my life.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'benefits',
	'defaultState' => '',
	'outputText' => '')
	);
	
$desiresSet = new QuestionFieldSet ( array (
	'idName' => 'desiresSet', 
	'labelText' => 'If the statement reflects your desires, check the box next to the statement:', 
	'childElements' => array ( $lifeProlonged, $coma, $incurable, $artificialNutrition, $benefits ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);
	
$statementOfDesires = new QuestionPage ( array (
	'idName' => 'statementOfDesires', 
	'labelText' => 'Statement of Desires', 
	'childElements' => array ( $desiresSet ), 
	'pageTitleText' => 'Statement of Desires', 
	'helpText' => '(With respect to decisions to withhold or withdraw life-sustaining treatment, your agent must make health care decisions that are consistent with your known desires. You can, but are not required to, indicate your desires below. If your desires are unknown, your agent has the duty to act in your best interests; and, under some circumstances, a judicial proceeding may be necessary so that a court can determine the health care decision that is in your best interests. If you wish to indicate your desires, you may SELECT the statement or statements that reflect your desires and/or write your own statements in the space below.)')
	);
	
// ______________________________ STATEMENT OF DESIRES PAGE

// ############################## OTHER DESIRES

$otherDesires = new QuestionPage ( array (
	'idName' => 'otherDesires', 
	'labelText' => 'Other or Additional Statements of Desires:', 
	'childElements' => array ( $freeTextElementSet ), 
	'pageTitleText' => 'Other Desires', 
	'helpText' => '')
	);
	
// ______________________________ OTHER DESIRES


// ############################## LIVING WILL

$lsNo = new SelectionElement ( array (
	'idName' => 'lsNo', 
	'labelText' => 'Keep me comfortable and allow natural death to occur. I do not want any life-sustaining treatment or other medical interventions used to try to extend my life. I do not want to receive nutrition and fluids by tube or other medical means.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNo',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsNoFT = new SelectionElement ( array (
	'idName' => 'lsNoFT', 
	'labelText' => 'Keep me comfortable and allow natural death to occur. I do not want any life-sustaining treatment or other medical interventions used to try to extend my life. If I am unable to take enough nourishment by mouth, however, I want to receive nutrition and fluids by tube or other medical means.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsNoFT',
	'defaultState' => '',
	'outputText' => '')
	);	
$lsYes= new SelectionElement ( array (
	'idName' => 'lsYes', 
	'labelText' => 'Try to extend my life for as long as possible, using all available life-sustaining treatment or other medical interventions that in reasonable medical judgment would prevent or delay my death. If I am unable to take enough nourishment by mouth, I want to receive nutrition and fluids by tube or other medical means.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsYes',
	'defaultState' => '',
	'outputText' => '')
	);

$furtherDirectSet = new QuestionFieldSet ( array (
	'idName' => 'furtherDirectSet', 
	'labelText' => 'I further direct that:', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => '')
	);	
	
$lifeSustainingSet = new QuestionFieldSet ( array (
	'idName' => 'lifeSustainingSet', 
	'labelText' => 'If I should lapse into an incurable and irreversible condition that, without the administration of life-sustaining treatment, will, in the opinion of my attending physician, cause my death within a relatively short time (a terminal condition) and I am no longer able to make decisions regarding my medical treatment, I direct my attending physician, pursuant to the Nevada Uniform Act on the Rights of the Terminally Ill, to:', 
	'childElements' => array ( $lsNo, $lsNoFT, $lsYes), 
	'childrenType' => 'radio',
	'required' => 'no')
	);
	
$lifeSustaining = new QuestionPage ( array (
	'idName' => 'lifeSustaining', 
	'labelText' => 'Life-Sustaining Treatment', 
	'childElements' => array ( $lifeSustainingSet, $furtherDirectSet  ), 
	'pageTitleText' => 'Life-Sustaining Treatment', 
	'helpText' => '')
	);

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
	'labelText' => 'Pursuant to Nevada law, I hereby give, effective on my death:', 
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
	'helpText' => 'You do not have to select any of the statements. If you do not select any of the statements, your attorney for health care, proxy, or other agent, or your family, may have the authority to make a gift of all or part of your body under Nevada law.')
	); 

// _________________________________ORGAN DONATION PAGE


?>