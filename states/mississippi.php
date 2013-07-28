<?php
$mississippi = array (
	'patientInfo', //AJBdone
	'healthProxy', //AJBdone
	'alternateHP', //AJBdone
	'limitations', // AJBdone
	'prolongLife', //AJBdone
	'nutrition', //AJBdone
	'relief', //AJBdone
	'otherWishes', //AJBdone
	'primaryCarePhysician',
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
	'helpText' => ' => 'Alternate Health Proxy Info', 
	'helpText' => 'Consider appointing a trusted family member or friend as your healthcare proxy. Do not choose your health care provider or an employee of the health care facility where you are receiving care to be your proxy.')
	);
// ____________________________ END HEALTH PROXY PAGE

// ########################### ALTERNATE HP PAGE
$alternateHP = new QuestionPage ( array (
	'idName' => 'alternateHP', 
	'labelText' => 'Designate an Alternate and Second Alternate Health Proxy', 
	'childElements' => array ( $personData, $personData2 ), 
	'pageTitleText' => 'Alternate Health Proxy Info', 
	'helpText' => ' => 'Alternate Health Proxy Info', 
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
$agentText = new TextObject ( array (
	'idName' => 'agentText',
	'textBody' => 'My agent is authorized to make all health-care decisions for me, including decisions to provide, withhold, or withdraw artificial nutrition and hydration, and all other forms of health care to keep me alive, except as I state here:')
	);
$immediate = new SelectionElement ( array (
	'idName' => 'immediate', 
	'labelText' => 'If I mark this box, my agent’s authority to make health-care decisions for me takes effect immediately.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'immediate',
	'defaultState' => '',
	'outputText' => '')
	);

$immediateSet = new QuestionFieldSet ( array (
	'idName' => 'immediateSet', 
	'labelText' => 'My agent’s authority becomes effective when my primary physician determines that I am unable to make my own health-care decisions unless I mark the following box.', 
	'childElements' => array ( $immediate ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);
	
$limitations = new QuestionPage ( array (
	'idName' => 'limitations', 
	'labelText' => 'Agent\'s Authority', 
	'childElements' => array ( $agentText, $freeTextElementSet, $immediateSet ), 
	'pageTitleText' => 'Agent\'s Authority', 
	'helpText' => '')
	);

// ____________________________ LIMITATIONS PAGE

// ############################ INSTRUCTIONS FOR HEALTH CARE 

$prolongLifeNo = new SelectionElement ( array (
	'idName' => 'prolongLifeNo', 
	'labelText' => 'I do not want my life to be prolonged if: <br />(i) I have an incurable and irreversible condition that will result in my death within a relatively short time, <br />(ii) I become unconscious and, to a reasonable degree of medical certainty, I will not regain consciousness, or <br />(iii) the likely risks and burdens of treatment would outweigh the expected benefits.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'prolongLifeNo',
	'defaultState' => '',
	'outputText' => '')
	);	
$prolongLifeYes = new SelectionElement ( array (
	'idName' => 'prolongLifeYes', 
	'labelText' => 'I want my life to be prolonged as long as possible within the limits of generally accepted health-care standards.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'prolongLifeYes',
	'defaultState' => '',
	'outputText' => '')
	);
	
$prolongLifeSet = new QuestionFieldSet ( array (
	'idName' => 'prolongLifeSet', 
	'labelText' => 'I direct that my health-care providers and others involved in my care provide, withhold or withdraw treatment in accordance with the choice I have marked below:', 
	'childElements' => array ( $prolongLifeNo, $prolongLifeYes ), 
	'childrenType' => 'form',
	'required' => '')
	);

$prolongLife = new QuestionPage ( array (
	'idName' => 'prolongLife', 
	'labelText' => 'End-of-Life Decisions', 
	'childElements' => array ( $prolongLifeSet ), 
	'pageTitleText' => 'End-of-Life Decisions', 
	'helpText' => 'If you are satisfied to allow your agent to determine what is best for you in making end-of-life decisions, you need not fill out this part of the form. If you do fill out this part of the form, you may strike any wording you do not want.')
	);

// _________________________ PROLONG LIFE PAGE

// ######################### NUTRITION PAGE

$artificialNutrition = new SelectionElement ( array (
	'idName' => 'artificialNutrition', 
	'labelText' => 'If I mark this box, artificial nutrition and hydration must be provided regardless of my condition and regardless of the choice in the End-of-Life Decisions section.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'artificialNutrition',
	'defaultState' => '',
	'outputText' => '')
	);

$nutritionSet = new QuestionFieldSet ( array (
	'idName' => 'nutritionSet', 
	'labelText' => 'Artificial nutrition and hydration must be provided, withheld or withdrawn in accordance with the choice I have made in the End-of-Life Decisions section unless I mark the following box.', 
	'childElements' => array ( $artificialNutrition ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);

$nutrition = new QuestionPage ( array (
	'idName' => 'nutrition', 
	'labelText' => 'Nutrition and Hydration Decisions', 
	'childElements' => array ( $nutritionSet ), 
	'pageTitleText' => 'Nutrition and Hydration', 
	'helpText' => 'If you are satisfied to allow your agent to determine what is best for you in making end-of-life decisions, you need not fill out this part of the form. If you do fill out this part of the form, after you print this form, you may strike any wording you do not want.')
	);

// __________________________ NUTRITION PAGE

// ########################## RELIEF FROM PAIN PAGE

$reliefText = new TextObject ( array (
	'idName' => 'reliefText',
	'textBody' => 'Except as I state in the following space, I direct that treatment for alleviation of pain or discomfort be provided at all times, even if it hastens my death:')
	);
$relief = new QuestionPage ( array (
	'idName' => 'relief', 
	'labelText' => 'Relief from Pain', 
	'childElements' => array ( $reliefText, $freeTextElementSet ), 
	'pageTitleText' => 'Relief From Pain', 
	'helpText' => '')
	);
	
// ___________________________ RELEIF FROM PAIN PAGE
	
$otherText = new TextObject ( array (
	'idName' => 'otherText',
	'textBody' => 'I direct that:')
	);
$otherWishes = new QuestionPage ( array (
	'idName' => 'otherWishes', 
	'labelText' => 'Additional Wishes', 
	'childElements' => array ( $otherText, $freeTextElementSet ), 
	'pageTitleText' => 'Other Wishes', 
	'helpText' => 'If you do not agree with any of the optional choices above and wish to write your own, or if you wish to add to the instructions you have given above, you may do so here.')
	);
	
// ############################# PRIMARY CARE PHYSICIANS

$doctorData = new QuestionFieldSet ( array (
	'idName' => 'doctorData', 
	'labelText' => 'I designate the following physician as my primary physician:', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $phone ), 
	'childrenType' => 'form',
	'required' => '')
	);

$otherDoctorData = new QuestionFieldSet ( array (
	'idName' => 'otherDoctorData', 
	'labelText' => 'If the physician I have designated above is not willing, able, or reasonably available to act as my primary physician, I designate the following physician as my primary physician:', 
	'childElements' => array ( $fullName, $streetAddress, $city, $usState, $zip, $phone ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
// ____________ END PERSON DATA FIELDSET

$primaryCarePhysician = new QuestionPage ( array (
	'idName' => 'primaryCarePhysician', 
	'labelText' => 'Preferred Physicians', 
	'childElements' => array ( $doctorData, $otherDoctorData ), 
	'pageTitleText' => 'Primary Physician (Optional)', 
	'helpText' => '')
	);

// ______________________________ PRIMARY CARE PHYSICIANS


// ############################### ORGAN DONATION PAGE

$transplantation = new SelectionElement ( array (
	'idName' => 'transplantation', 
	'labelText' => 'Transplantation', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'transplantation',
	'defaultState' => '',
	'outputText' => '')
	);

$therapy= new SelectionElement ( array (
	'idName' => 'therapy', 
	'labelText' => 'Therapy', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'therapy',
	'defaultState' => '',
	'outputText' => '')
	);

$research= new SelectionElement ( array (
	'idName' => 'research', 
	'labelText' => 'Research', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'research',
	'defaultState' => '',
	'outputText' => '')
	);

$medicalScience= new SelectionElement ( array (
	'idName' => 'medicalScience', 
	'labelText' => 'Medical Education', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'medicalScience',
	'defaultState' => '',
	'outputText' => '')
	);
	
$anyPurpose= new SelectionElement ( array (
	'idName' => 'anyPurpose', 
	'labelText' => 'Any purpose authorized by law.', 
	'childElements' => array () , 
	'inputType' => 'checkbox',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anyPurpose',
	'defaultState' => '',
	'outputText' => '')
	);
	
$organPurpose = new QuestionFieldSet ( array (
	'idName' => 'organPurpose', 
	'labelText' => 'I direct that at the time of my death my entire body or designated body organs or body parts be donated for purposes of:', 
	'childElements' => array ( $transplantation, $therapy, $research, $medicalScience, $anyPurpose ), 
	'childrenType' => 'checkbox',
	'required' => '')
	);

$entireBody= new SelectionElement ( array (
	'idName' => 'entireBody', 
	'labelText' => 'My body for anatomical study if needed.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'entireBody',
	'defaultState' => '',
	'outputText' => '')
	);

$anyNeeded= new SelectionElement ( array (
	'idName' => 'anyNeeded', 
	'labelText' => 'Any needed organs, tissues, or eyes.', 
	'childElements' => array ( ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'anyNeeded',
	'defaultState' => '',
	'outputText' => '')
	);

$followingOrgans= new SelectionElement ( array (
	'idName' => 'followingOrgans', 
	'labelText' => 'The following organs, tissues, or eyes:', 
	'childElements' => array ( $freeTextElementSet ) , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'nameVal',
	'choiceValue' => 'followingOrgans',
	'defaultState' => '',
	'outputText' => '')
	);

$donate = new QuestionFieldSet ( array (
	'idName' => 'donate', 
	'labelText' => 'Death means either irreversible cessation of circulatory and respiratory functions or irreversible cessation of all functions of the entire brain, including the brain stem. I specifically donate:', 
	'childElements' => array ( $entireBody, $anyNeeded, $followingOrgans ), 
	'childrenType' => 'radio',
	'required' => '')
	);

$authoritySet = new QuestionFieldSet ( array (
	'idName' => 'authoritySet', 
	'labelText' => 'This authority granted to my patient advocate to make an anatomical gift is limited as follows (here list limitations or special wishes, if any):', 
	'childElements' => array ( $freeTextElement ), 
	'childrenType' => 'form',
	'required' => '')
	);
	
$organDonation = new QuestionPage ( array (
	'idName' => 'organDonation', 
	'labelText' => 'Organ Donation', 
	'childElements' => array ( $donate, $authoritySet, $organPurpose ), 
	'pageTitleText' => 'Anatomical Gifts (Organ Donation)', 
	'helpText' => '')
	);

	
?>