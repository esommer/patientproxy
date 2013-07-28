<?php
/** HTMLGENERATOR.PHP
 *
 * Contains functions for outputting HTML
 *
 * @author     Emily Sommer <emily.sommer@gmail.com>
 * @copyright  2011-2012 Patient Proxy
 *
 */

// ################################## QUESTIONPAGE BUILDER
function questionpage_builder ( $qpObject ) {
	// first display label text and any help text
	echo <<<EOT
	
		<span class="questiontext">$qpObject->labelText</span>
		
EOT;
	if ( !empty ( $qpObject->helpText ) ) {
	echo <<<EOT
		
		<div class="helpbox">
		<span class="help">?</span><br />
		<span class="helptext">$qpObject->helpText</span>
		</div>
EOT;
	}
	
	// for each group of questions, call fieldset_builder
	foreach ( $qpObject->childElements as $fsObject ) {
		fieldset_builder ( $fsObject, $qpObject->idName );
		
	}
}// ================================== END QUESTIONPAGE BUILDER



// ################################## FIELDSET BUILDER
function fieldset_builder ( $fsObject, $idPrefix ) {
	if ( get_class ( $fsObject ) == 'QuestionFieldSet' ) {
		// set the id of the fieldset = questionId_fieldsetId
		$fieldSetId = $idPrefix . '_' . $fsObject->idName;
		// begin fieldset, class = questionType_set
		echo "\n\t\t" . '<fieldset class="' . $fsObject->childrenType . '_set" id="' . $fieldSetId . '">' . "\n";
		
		// if there is label text for fieldset, display it as legend
		if ( $fsObject->labelText != '' ) {
			echo "\n<legend>$fsObject->labelText</legend>\n";
		}
		if ( !empty ( $fsObject->helpText ) ) {
	echo <<<EOT
		
		<div class="helpbox">
		<span class="help">?</span><br />
		<span class="helptext">$fsObject->helpText</span>
		</div>
EOT;
	}
		
		// start unordered list with class = questiontype_ul
		echo "\n\t\t" . '<ul class="' . $fsObject->childrenType . '_ul">';
		
		// for each child question, call element_display to build it
		foreach ( $fsObject->childElements as $bqObject ) {
			element_display ( $bqObject, $fieldSetId );
			
		}
		
		// close ul and fieldset
		echo "\n\t\t" . '</ul></fieldset><!-- close of ul, fieldset -->' . "\n";	
		}
	else { //object is textObject
		$textObjectId = $idPrefix . '_' . $fsObject->idName;
		echo "\n\t\t" . '<p class="text_object" id="' . $textObjectId . '">' . $fsObject->textBody . '</p>';
		}
}// ================================== END FIELDSET BUILDER



// ################################## ELEMENT DISPLAY
function element_display ( $bqObject, $elemIdPrefix ) {
	
	global $savedData;
	global $addToSessionList;
	
	// fetch type, set question's id, set fieldset data if selection element
	$type = $bqObject->inputType;
	$value = '';
	$elemId = $elemIdPrefix . '_' . $bqObject->idName . '_fieldID';
	/*if ( $bqObject->required == 'yes' ) {
		$elemId .= '_req';
		}*/
	if ( $type == 'radio' || $type == 'checkbox' ) {
		$elemSetId = $elemIdPrefix . '_fieldID_SET';
		$toAddNext = array ( $elemSetId => 'none', $elemId => $bqObject->validationType );
		}
	else {
		$toAddNext = array ( $elemId => $bqObject->validationType );
		}
	$addToSessionList = array_merge ( $addToSessionList, $toAddNext );
	if ( $type == 'radio' || $type == 'checkbox') {
		if ( isset ( $savedData[$elemSetId] ) ) {
			if ( in_array ( $bqObject->choiceValue, $savedData[$elemSetId] ) ) {
				$value = $bqObject->choiceValue;
				}
			}
		}
	else {
		if ( isset ( $savedData[$elemId] ) ) {
				$value = $savedData[$elemId];
			}
		}
	
	// begin list item
	echo "\n\t\t" . '<li class="' . $type . '_li">';
	

	// test type, display accordingly
	switch ( $type ) {
		
// ################ TEXT
		case 'text':
			echo '<span class="form_label';
			if ( $bqObject->required == 'yes' ) { echo ' required_field'; }
			echo '"><label for="' . $elemId . '">' . $bqObject->labelText; 
			if ( $bqObject->required == 'yes' ) { echo ' *'; }
			echo '</label></span><span class="form_field';
			if ( $bqObject->required == 'yes' ) { echo ' required_field'; }
			echo '"><input type="text" ';
			if ( $bqObject->required == 'yes' ) { echo 'class="required" '; }
			echo 'id="' . $elemId . '" name="' . $elemId . '" value="';
			if ( !empty ( $value ) ) { echo $value; }
			echo '" /></span><br />';
			break;
		
// ################ TEXTAREA
		case 'textarea':
			echo <<<EOT
		
			<span class="form_label"><label for="$elemId">$bqObject->labelText</label></span>
			<span class="form_field"><textarea id="$elemId" name="$elemId">
EOT;
			if ( !empty ( $value ) ) { echo $value; }
			echo '</textarea></span><br />';
			break;//==============================
		
// ################ CHECKBOX
		case 'checkbox':
			echo <<<EOT
			
			<input type="hidden" name="SET_$elemId" value="submitted" />
			<span class="checkbox_field"><input type="checkbox" class="styled" id="$elemId" name="
EOT;
			echo $elemSetId . '[]" value="' . $bqObject->choiceValue . '"';
			if ( !empty ( $value ) ) { 
				echo ' checked="checked"'; 
				}
			echo <<<EOT
 /></span>
			<span class="checkbox_label"><label for="$elemId">$bqObject->labelText</label></span><br />
EOT;
			break;//==============================
		
// ################ RADIO
		case 'radio':
			echo <<<EOT
			
			<input type="hidden" name="SET_$elemId" value="submitted" />
			<span class="radio_field"><input type="radio" class="styled" id="$elemId" name="
EOT;
			echo $elemSetId . '[]" value="' . $bqObject->choiceValue . '"';
			if ( !empty ( $value ) ) { 
				echo ' checked="checked"'; 
				}
			echo <<<EOT
 /></span>
			<span class="radio_label"><label for="$elemId">$bqObject->labelText</label></span><br />
EOT;
			break;//==============================
			
// ################ JUSTTEXT
		case 'justtext':
			echo '<span class="justtext">' . $bqObject->labelText . '</span>';
			break;//==============================
	}//===================================================
	
	// if there are sub-fieldsets under this question, build them
	if ( $bqObject->numChildren > 0 ) {
		foreach ( $bqObject->childElements as $bqfsObject ) {
		fieldset_builder ( $bqfsObject, $elemId );
		}
	}
	
	// close list item
	echo "\n\t\t</li>";	
}// ================================== END ELEMENT DISPLAY



?>