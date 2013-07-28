<?php

$ohio = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'alternateHP', //AJBdone
	'secondAlternateHP', //AJBdone
	'guidance', //AJBdone
	'authority', //AJBdone
	'specialInstructionsPage', //AJBdone
	'limitations', //AJBdone
	'livingWill', //AJBdone
	'specialInstructionsMDPage', //AJBdone
	'organDonor' //AJBdone
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
$agentText = new TextObject ( array (
	'idName' => 'agentText',
	'textBody' => 'The person named below is my attorney in fact [Health Proxy] who will make health care decisions for me as authorized in this document.')
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
	'labelText' => 'Appoint a Health Proxy', 
	'childElements' => array ( $agentText, $personData ), 
	'pageTitleText' => 'Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END HEALTH PROXY PAGE

// ########################### ALTERNATE HP PAGE
$altAgentText = new TextObject ( array (
	'idName' => 'altAgentText',
	'textBody' => 'Should my attorney in fact [Health Proxy] named above not be immediately available or be unwilling or unable to make decisions for me, then I name, in the following order of priority, the following persons as my alternate attorney in facts:<br />
	<span class="strong">First Alternate Health Proxy:</span>')
	);	
$alternateHP = new QuestionPage ( array (
	'idName' => 'alternateHP', 
	'labelText' => 'Appoint an Alternate Health Proxy', 
	'childElements' => array ( $altAgentText, $personData ), 
	'pageTitleText' => 'Alternate Health Proxy Info', 
	'helpText' => 'You do not need to name alternate attorney in facts. You also may name just one alternate attorney in fact. Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
$secondAltAgentText = new TextObject ( array (
	'idName' => 'secondAltAgentText',
	'textBody' => 'Should my attorney in fact [Health Proxy] named above not be immediately available or be unwilling or unable to make decisions for me, then I name, in the following order of priority, the following persons as my alternate attorney in facts:<br />
	<span class="strong">Second Alternate Health Proxy:</span>')
	);		
$secondAlternateHP = new QuestionPage ( array (
	'idName' => 'secondAlternateHP', 
	'labelText' => 'Appoint a Second Alternate Health Proxy', 
	'childElements' => array ( $secondAltAgentText, $personData ), 
	'pageTitleText' => 'Alternate Health Proxy Info', 
	'helpText' => 'You do not need to name alternate attorney in facts. You also may name just one alternate attorney in fact. Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END ALTERNATE HP PAGE

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
	
// ################################## GUIDANCE PAGE
$guidanceText = new TextObject ( array (
	'idName' => 'guidanceText',
	'textBody' => 'My attorney in fact [Health Proxy] will make health care decisions for me based on the instructions that I give in this or another document and on my wishes otherwise known to my attorney in fact. If my attorney in fact believes that my wishes as made known to my attorney in fact conflict with what is in this document, this document will control. If my wishes are unclear or unknown, my attorney in fact will make health care decisions in my best interests. My attorney in fact will determine my best interests after considering the benefits, the burdens, and the risks that might result from a given decision. If no attorney in fact is available, this document will guide decisions about my health care.<br />
	<span class="strong">I direct that:</span>')
	);		
$guidance = new QuestionPage ( array (
	'idName' => 'guidance', 
	'labelText' => 'Guidance to Attorney in Fact [Health Proxy]', 
	'childElements' => array ( $guidanceText, $freeTextElementSet ), 
	'pageTitleText' => 'Guidance to Attorney in Fact [Health Proxy]', 
	'helpText' => '')
	);
	
// ____________________________________ GUIDANCE PAGE

$painRelief = new SelectionElement ( array (
	'idName' => 'painRelief', 
	'labelText' => 'To consent to the administration of pain-relieving drugs or treatment or procedures (including surgery) that my attorney in fact [Health Proxy], upon medical advice, believes may provide comfort to me, even though such drugs, treatment or procedures may hasten my death. My comfort and freedom from pain are important to me and should be protected by my attorney in fact and physician.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'painRelief',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$lsTreatment = new SelectionElement ( array (
	'idName' => 'lsTreatment', 
	'labelText' => 'If I am in a terminal condition, to give, to withdraw or to refuse to give informed consent to life-sustaining treatment, including artificially or technologically supplied nutrition or hydration.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'lsTreatment',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$giveRefuse = new SelectionElement ( array (
	'idName' => 'giveRefuse', 
	'labelText' => 'To give, withdraw or refuse to give informed consent to any health care procedure, treatment, intervention or other measure.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'giveRefuse',
	'defaultState' => 'checked',
	'outputText' => '')
	);
	
$information = new SelectionElement ( array (
	'idName' => 'information', 
	'labelText' => 'To request, review, and receive any information, verbal or written, regarding my physical or mental health, including, but not limited to, all my medical and health care records.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'information',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$furtherDisclosure = new SelectionElement ( array (
	'idName' => 'furtherDisclosure', 
	'labelText' => 'To consent to further disclosure of information, and to disclose medical and related information concerning my condition and treatment to other persons.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'furtherDisclosure',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$release = new SelectionElement ( array (
	'idName' => 'release', 
	'labelText' => 'To execute for me any releases or other documents that may be required in order to obtain medical and related information.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'release',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$indemnity = new SelectionElement ( array (
	'idName' => 'indemnity', 
	'labelText' => 'To execute consents, waivers, and releases of liability for me and for my estate to all persons who comply with my attorney in fact\'s [Health Proxy\'s] instructions and decisions. To indemnify and hold harmless, at my expense, any third party who acts under this Health Care Power of Attorney. I will be bound by such indemnity entered into by my attorney in fact.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'indemnity',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$discharge = new SelectionElement ( array (
	'idName' => 'discharge', 
	'labelText' => 'To select, employ, and discharge health care personnel and services providing home health care and the like.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'discharge',
	'defaultState' => 'checked',
	'outputText' => '')
	);
	
$facility = new SelectionElement ( array (
	'idName' => 'facility', 
	'labelText' => 'To select, contract for my admission to, transfer me to, or authorize my discharge from any medical or health care facility, including, but not limited to, hospitals, nursing homes, assisted living facilities, hospices, adult homes and the like.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'facility',
	'defaultState' => 'checked',
	'outputText' => '')
	);
	
$transport = new SelectionElement ( array (
	'idName' => 'transport', 
	'labelText' => 'To transport me or arrange for my transportation to a place where this Health Care Power of Attorney is honored, should I become unable to make health care decisions for myself in a place where this document is not enforced.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'transport',
	'defaultState' => 'checked',
	'outputText' => '')
	);

$theFollowing = new SelectionElement ( array (
	'idName' => 'theFollowing', 
	'labelText' => 'To complete and sign for me the following:<br />
	<p class="indent">(a) Consents to health care treatment, or the issuance of Do Not Resuscitate (DNR) Orders or other similar orders; and</p>
	<p class="indent">(b) Requests for my transfer to another facility, to be discharged against health care advice, or other similar requests; and</p>
	<p class="indent">(c) Any other document desirable to implement health care decisions that my attorney in fact is authorized to make pursuant to this document.</p>', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'theFollowing',
	'defaultState' => 'checked',
	'outputText' => '')
	);
	
$authoritySet = new QuestionFieldSet ( array (
	'idName' => 'authoritySet', 
	'labelText' => 'My attorney in fact [Health Proxy] has full and complete authority to make all health care decisions for me whenever I cannot make such decisions, unless I have otherwise indicated below. This authority includes, but is not limited to, the following: (Uncheck any authority that you do not want your attorney in fact [Health Proxy] to have.)', 
	'childElements' => array ( $painRelief, $lsTreatment, $giveRefuse, $information, $furtherDisclosure, $release, $indemnity, $discharge, $facility, $transport, $theFollowing ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);
	
$authority = new QuestionPage ( array (
	'idName' => 'authority', 
	'labelText' => 'Authority of Attorney in Fact [Health Proxy]', 
	'childElements' => array ( $authoritySet), 
	'pageTitleText' => 'Authority of Attorney in Fact [Health Proxy]', 
	'helpText' => '')
	);
// _________________________ GUIDANCE PAGE

$specialInstructions = new SelectionElement ( array (
	'idName' => 'specialInstructions', 
	'labelText' => 'I want to specifically authorize MY ATTORNEY to withhold or to withdraw artificially or technologically supplied nutrition or hydration if:<br />
	<p class="indent">1. I am in a permanently unconscious state; and</p>
	<p class="indent">2. My physician and at least one other physician who has examined me have determined, to a reasonable degree of medical certainty, that artificially or technologically supplied nutrition and hydration will not provide comfort to me or relieve my pain.</p>', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'specialInstructions',
	'defaultState' => '',
	'outputText' => '')
	);

$specialInstructionsSet = new QuestionFieldSet ( array (
	'idName' => 'specialInstructionsSet', 
	'labelText' => '', 
	'childElements' => array ( $specialInstructions ),
	'childrenType' => 'checkbox',
	'required' => '')
	);

$specialInstructionsPage = new QuestionPage ( array (
	'idName' => 'specialInstructionsPage', 
	'labelText' => '', 
	'childElements' => array ( $specialInstructionsSet ), 
	'pageTitleText' => 'Artificially Nutrition or Hydration', 
	'helpText' => '')
	);

// ####################### LIMITATIONS PAGE
$limitationText = new TextObject ( array (
	'idName' => 'limitationText',
	'textBody' => 'Under Ohio law, there are five limitations to the authority of my attorney in fact:<br />
	<p class="indent">1. My attorney in fact cannot order the withdrawal of life-sustaining treatment unless I am in a terminal condition or a permanently unconscious state, and two physicians have confirmed the diagnosis and have determined that I have no reasonable possibility of regaining the ability to make decisions; and</p>
	<p class="indent">2. My attorney in fact cannot order the withdrawal of any treatment given to provide comfort care or to relieve pain; and</p>
	<p class="indent">3. If I am pregnant, my attorney in fact cannot refuse or withdraw informed consent to health care if the refusal or withdrawal would end my pregnancy, unless the pregnancy or health care would create a substantial risk to my life or two physicians determine that the fetus would not be born alive; and</p>
	<p class="indent">4. My attorney in fact cannot order the withdrawal of artificially or technologically supplied nutrition or hydration unless I am terminally ill or permanently unconscious and two physicians agree that nutrition or hydration will no longer provide comfort or relieve pain and, in the event that I am permanently unconscious, I have given a specific direction to withdraw nutrition or hydration elsewhere in this document; and</p>
	<p class="indent">5. If I previously consented to any health care, my attorney in fact cannot withdraw that treatment unless my condition has significantly changed so that the health care is significantly less beneficial to me, or unless the health care is no longer significantly effective to achieve the purpose for which I chose the health care.</p>
	<p><span class="strong">My attorney in fact\'s [Health Proxy\'s] authority is subject to the following additional limitations:</span></p>')
	);		
$limitations = new QuestionPage ( array (
	'idName' => 'limitations', 
	'labelText' => 'Additional Limitations on Authority', 
	'childElements' => array ( $limitationText, $freeTextElementSet ), 
	'pageTitleText' => 'Additional Limitations', 
	'helpText' => '')
	);

// ___________________________ LIMITATIONS PAGE

// ########################### LIVING WILL PAGE

$terminalCondition = new SelectionElement ( array (
	'idName' => 'terminalCondition', 
	'labelText' => 'if I am in a TERMINAL CONDITION and unable to make my own health care decisions.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'terminalCondition',
	'defaultState' => '',
	'outputText' => '')
	);
	
$permanentlyUnconscious = new SelectionElement ( array (
	'idName' => 'permanentlyUnconscious', 
	'labelText' => 'if I am in a PERMANENTLY UNCONSCIOUS STATE.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'permanentlyUnconscious',
	'defaultState' => '',
	'outputText' => '')
	);
$livingWillSet = new QuestionFieldSet ( array (
	'idName' => 'livingWillSet', 
	'labelText' => 'I direct that my physician shall:
	<p class="indent">1. Administer no life-sustaining treatment, including CPR and artificially or technologically supplied nutrition or hydration; and</p>
	<p class="indent">2. Withdraw such treatment, including CPR, if such treatment has started; and</p>
	<p class="indent">3. Issue a DNR Order; and</p>
	<p class="indent">4. Permit me to die naturally and take no action to postpone my death, providing me with only that care necessary to make me comfortable and to relieve my pain.</p>', 
	'childElements' => array ( $terminalCondition, $permanentlyUnconscious ),
	'childrenType' => 'checkbox',
	'required' => '')
	);
$livingWillNoText = new TextObject ( array (
	'idName' => 'livingWillNoText',
	'textBody' => '<span class="strong">If you do not agree with the above statements, be sure to leave these checkboxes unchecked.</span>')
	);		
$livingWill = new QuestionPage ( array (
	'idName' => 'livingWill', 
	'labelText' => 'Living Will', 
	'childElements' => array ( $livingWillSet, $livingWillNoText ), 
	'pageTitleText' => 'Living Will', 
	'helpText' => '<p><span class="strong">Life-sustaining treatment</span> means any health care, including artificially or technologically supplied nutrition and hydration that will serve mainly to prolong the process of dying.</p>
	<p><span class="strong">Permanently unconscious state</span> means an irreversible condition in which I am permanently unaware of myself and my surroundings. My physician and one other physician must examine me and agree that the total loss of higher brain function has left me unable to feel pain or suffering.</p>
	<p><span class="strong">Terminal condition or terminal illness</span> means an irreversible, incurable and untreatable condition caused by disease, illness or injury. My physician and one other physician will have examined me and believe that I cannot recover and that death is likely to occur within a relatively short time if I do not receive life-sustaining treatment.</p>')
	);

// ___________________________ LIVING WILL PAGE

// ########################### PHYSICIAN SPECIAL INSTRUCTIONS PAGE

$specialInstructionsMD = new SelectionElement ( array (
	'idName' => 'specialInstructionsMD', 
	'labelText' => 'I want to specifically authorize MY PHYSICIAN to withhold or to withdraw artificially or technologically supplied nutrition or hydration if:<br />
	<p class="indent">1. I am in a permanently unconscious state; and</p>
	<p class="indent">2. My physician and at least one other physician who has examined me have determined, to a reasonable degree of medical certainty, that artificially or technologically supplied nutrition and hydration will not provide comfort to me or relieve my pain.</p>', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'specialInstructionsMD',
	'defaultState' => '',
	'outputText' => '')
	);

$specialInstructionsMDSet = new QuestionFieldSet ( array (
	'idName' => 'specialInstructionsMDSet', 
	'labelText' => '', 
	'childElements' => array ( $specialInstructionsMD ),
	'childrenType' => 'checkbox',
	'required' => '')
	);

$specialInstructionsMDPage = new QuestionPage ( array (
	'idName' => 'specialInstructionsMDPage', 
	'labelText' => 'Authorization for Physician', 
	'childElements' => array ( $specialInstructionsMDSet ), 
	'pageTitleText' => 'Special Instruction for Physician', 
	'helpText' => '')
	);

// ___________________________ PHYICIAN SPECIAL INSTRUCTIONS PAGE

// ########################### ORGAN DONATION PAGE

$donate = new SelectionElement ( array (
	'idName' => 'donate', 
	'labelText' => 'I wish to make an anatomical gift.', 
	'childElements' => array (),
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'donate',
	'defaultState' => '',
	'outputText' => '')
	);

$followingParts = new SelectionElement ( array (
	'idName' => 'followingParts', 
	'labelText' => 'In the hope that I may help others upon my death, I hereby give the following body parts for any purpose authorized by law, including transplantation, therapy, research, or education.', 
	'childElements' => array ( $freeTextElementSet ),
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'followingParts',
	'defaultState' => '',
	'outputText' => '')
	);
	
$doNotDonate = new SelectionElement ( array (
	'idName' => 'doNotDonate', 
	'labelText' => 'I do not wish to make an anatomical gift.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'doNotDonate',
	'defaultState' => '',
	'outputText' => '')
	);

$donationSet = new QuestionFieldSet ( array (
	'idName' => 'donationSet', 
	'labelText' => '', 
	'childElements' => array ( $donate, $followingParts, $doNotDonate ),
	'childrenType' => 'radio',
	'required' => '')
	);

$organDonor = new QuestionPage ( array (
	'idName' => 'organDonor', 
	'labelText' => 'Anatomical Gifts (Optional)', 
	'childElements' => array ( $donationSet ), 
	'pageTitleText' => 'Anatomical Gifts (Optional)', 
	'helpText' => 'INSTRUCTIONS: If you elect to make an anatomical gift, please complete and file the "Donor Registry Enrollment Form" with the Ohio Bureau of Motor Vehicles to ensure that your wishes will be honored.
	
	If I do not indicate a desire to donate all or part of my body by filling in the lines above, no presumption is created about my desire to make or refuse to make an anatomical gift.')
	);


?>
