<?php

$texas = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'limitations', //AJBdone
	'alternate',  //AJBdone
	'locationDuration', //AJBdone
	'terminalCondition', //AJBdone
	'irreversibleCondition', //AJBdone
	'organDonation', 
	'additionalRequests' //AJBdone
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
	'labelText' => 'Work Telephone Number', 
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
	'labelText' => 'Home Telephone Number', 
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
	'childElements' => array ( $fullNameReq, $birthDate, $usStateReq, $reqText ), 
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

// ############# PROXY DATA FIELDSET
$personDataSet = new QuestionFieldSet ( array (
	'idName' => 'personDataSet', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $dayPhone, $eveningPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$personDataSet2 = new QuestionFieldSet ( array (
	'idName' => 'personDataSet2', 
	'labelText' => '', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $dayPhone, $eveningPhone, $email ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
// _______________ PROXY DATA FIELDSET	
$agentText = new TextObject ( array (
	'idName' => 'agentText',
	'textBody' => 'I appoint the following as my health care Agent to make any and all health care decisions for me, except to the extent that I state otherwise in this document. This medical power of attorney takes effect if I become unable to make my own health care decisions and this fact is certified in writing by my physicians.')
	);		
$healthProxy = new QuestionPage ( array (
	'idName' => 'healthProxy', 
	'labelText' => 'Appoint a Health Proxy', 
	'childElements' => array ( $agentText, $personDataSet ), 
	'pageTitleText' => 'Health Agent Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
	
// ____________________________ END HEALTH PROXY PAGE

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
$limitText = new TextObject ( array (
	'idName' => 'limitText',
	'textBody' => 'The limitations on the decision-making authority of my health care agent are as follows:')
	);	
$limitations = new QuestionPage ( array (
	'idName' => 'limitations', 
	'labelText' => 'Limitations on Authority', 
	'childElements' => array ( $limitText, $freeTextElementSet ), 
	'pageTitleText' => 'Limitations of Authority', 
	'helpText' => '')
	);
	
// ____________________________ LIMITATIONS PAGE

// ########################## ALTERNATE PAGE
$altText = new TextObject ( array (
	'idName' => 'altText',
	'textBody' => '(You are not required to designate an alternate agent but you may do so. An alternate agent may make the same health care decisions as the
	designated agent if the designated agent is unable or unwilling to act as
	your agent. If the agent designated is your spouse, the designation is
	automatically revoked by law if your marriage is dissolved.)<br />
	If the person designated as my agent is unable or unwilling to make health care decisions for me, I designate the following persons to serve as my agent to make health care decisions for me as authorized by this
	document, who serve in the following order:')
	);	
$alternate = new QuestionPage ( array (
	'idName' => 'alternate', 
	'labelText' => 'Designation of Alternate Agents', 
	'childElements' => array ( $altText, $personDataSet, $personDataSet2 ), 
	'pageTitleText' => 'Designation of Alternate Agents', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
	
// __________________________ ALTERNATE PAGE	
	
// ###########################  ORIGINAL AND EXPIRATION PAGE

$location = new TextElement ( array (
	'idName' => 'location', 
	'labelText' => '', 
	'childElements' => array (), 
	'inputType' => 'textarea',
	'required' => 'no',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '20',
	'rows' => '2')
	);
	
$locationSet = new QuestionFieldSet ( array (
	'idName' => 'locationSet', 
	'labelText' => 'The original of this document is kept at:', 
	'childElements' => array ( $location ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$name = new TextElement ( array (
	'idName' => 'name', 
	'labelText' => 'Name', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
	
$address = new TextElement ( array (
	'idName' => 'address', 
	'labelText' => 'Address', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);

$name2 = new TextElement ( array (
	'idName' => 'name2', 
	'labelText' => 'Name', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);	
	
$address2 = new TextElement ( array (
	'idName' => 'address2', 
	'labelText' => 'Address', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'none',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
	
$institutions = new QuestionFieldSet ( array (
	'idName' => 'institutions', 
	'labelText' => 'The following individuals or institutions have signed copies:', 
	'childElements' => array ( $name, $address, $name2, $address2 ), 
	'childrenType' => 'form',
	'required' => '')
	);

$duration = new TextElement ( array (
	'idName' => 'duration', 
	'labelText' => '(IF APPLICABLE) This power of attorney ends on the following date:', 
	'childElements' => array (), 
	'inputType' => 'text',
	'required' => '',
	'validationType' => 'date',
	'width' => '',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);
	
$durationSet = new QuestionFieldSet ( array (
	'idName' => 'durationSet', 
	'labelText' => '', 
	'childElements' => array ( $duration ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$locationDuration = new QuestionPage ( array (
	'idName' => 'locationDuration', 
	'labelText' => 'Location and Duration', 
	'childElements' => array ( $locationSet, $institutions, $durationSet ), 
	'pageTitleText' => 'Location and Duration', 
	'helpText' => '')
	);

// ___________________________ ORIGINAL AND EXPIRATION PAGE


// ########################### TERMINAL ILLNESS PAGE

$discontinue = new SelectionElement ( array (
	'idName' => 'discontinue', 
	'labelText' => 'I request that all treatments other than those needed to keep me comfortable be discontinued or withheld and my physician allow me to die as gently as possible; OR', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'discontinue',
	'defaultState' => '',
	'outputText' => '')
	);
	
$keptAlive = new SelectionElement ( array (
	'idName' => 'keptAlive', 
	'labelText' => 'I request that I be kept alive in this terminal condition using available life-sustaining treatment. (THIS SELECTION DOES NOT APPLY TO HOSPICE CARE)', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'keptAlive',
	'defaultState' => '',
	'outputText' => '')
	);

$terminalConditionSet = new QuestionFieldSet ( array (
	'idName' => 'terminalConditionSet', 
	'labelText' => 'If, in the judgment of my physician, I am suffering with a terminal condition from which I am expected to die within six months, even with available life-sustaining treatment provided in accordance with prevailing standards of medical care:', 
	'childElements' => array ( $discontinue, $keptAlive ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$terminalCondition = new QuestionPage ( array (
	'idName' => 'terminalCondition', 
	'labelText' => 'Terminal Condition Preferences', 
	'childElements' => array ( $terminalConditionSet ), 
	'pageTitleText' => 'Terminal Condition', 
	'helpText' => '<span class="strong">"Terminal Condition"</span> means an incurable condition caused by injury, disease, or illness that according to reasonable medical judgment will produce death within six months, even with available life-sustaining treatment provided	in accordance with the prevailing standard of medical care.<br />
	EXPLANATION: Many serious illnesses may be considered irreversible early in	the course of the illness, but they may not be considered terminal until the	disease is fairly advanced. In thinking about terminal illness and its treatment,	you again may wish to consider the relative benefits and burdens of treatment and discuss your wishes with your physician, family, or other important persons in your life.')
	);

// __________________________ TERMINAL ILLNESS PAGE


// ########################### IRREVERSIBLE CONDITION PAGE

$irreversibleConditionSet = new QuestionFieldSet ( array (
	'idName' => 'irreversibleConditionSet', 
	'labelText' => 'If, in the judgment of my physician, I am suffering with an irreversible condition so that I cannot care for myself or make decisions for myself and am expected to die without life-sustaining treatment provided in accordance with prevailing standards of care:', 
	'childElements' => array ( $discontinue, $keptAlive ), 
	'childrenType' => 'radio',
	'required' => 'no')
	);

$irreversibleCondition = new QuestionPage ( array (
	'idName' => 'irreversibleCondition', 
	'labelText' => 'Irreversible Condition', 
	'childElements' => array ( $irreversibleConditionSet), 
	'pageTitleText' => 'Irreversible Condition', 
	'helpText' => '<span class="strong">"Irreversible Condition"</span> means a condition, injury, or illness:<br />
	1. that may be treated, but is never cured or eliminated;<br />
	2. that leaves a person unable to care for or make decisions for the
	person’s own self; and<br />
	3. that, without life-sustaining treatment provided in accordance with the
	prevailing standard of medical care, is fatal.<br />
	EXPLANATION: Many serious illnesses such as cancer, failure of major organs (kidney, heart, liver or lung), and serious brain disease such as Alzheimer’s	dementia may be considered irreversible early on. There is no cure, but the patient may be kept alive for prolonged periods of time if the patient receives life-sustaining treatments. Late in the course of the same illness, the disease may be considered terminal when, even with treatment, the patient is expected to die. You may wish to consider which burdens of treatment you would be willing to accept in an effort to achieve a particular outcome. This is a very personal decision that you may wish to discuss with your physician, family, or other important persons in your life.')
	);
	
// ____________________________ IRREVERSIBLE CONDITION PAGE


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
	'childElements' => array ( $fullName ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => '',
	'choiceValue' => 'writtenSigned',
	'defaultState' => '',
	'outputText' => '')
	);	
	
$wishToDonate = new SelectionElement ( array (
	'idName' => 'wishToDonate', 
	'labelText' => 'Pursuant to Texas law, I hereby give, effective on my death:', 
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
	'helpText' => 'You do not have to select any of the statements. If you do not select any of the statements, your attorney for health care, proxy, or other agent, or your family, may have the authority to make a gift of all or part of your body under Texas law.')
	); 

// _________________________________ORGAN DONATION PAGE

// ################################### OTHER INSTRUCTIONS PAGE

$additionalRequests = new QuestionPage ( array (
	'idName' => 'additionalRequests', 
	'labelText' => 'Additional requests:', 
	'childElements' => array ( $freeTextElementSet ), 
	'pageTitleText' => 'Other Instructions', 
	'helpText' => 'After discussion with your physician, you may wish to consider listing particular treatments in this space that you do or do	not want in specific circumstances, such as artificial nutrition and fluids,	intravenous antibiotics, etc. Be sure to state whether you do or do not	want the particular treatment. If you wish, you can also specify that you	would like to make an organ donation. Be sure to include any restrictions,	such as who may become a donee, what organs you authorize to be donated, etc.')
	);

// _________________________________OTHER INSTRUCTIONS PAGE


// END


?>
