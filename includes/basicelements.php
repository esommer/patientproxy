<?php

/* CLASS CONSTRUCTION:
######################################################				

--attribute-- = calculated automatically, don't assign value

BASIC ELEMENT [ base element - don't use by itself ] 
		(idName, 
		labelText, 
		childElements, 
		--numChildren--)
 ->	QUESTION PAGE 
			(idName, 
			labelText, 
			childElements, 
			--numChildren--, 
			pageTitleText, 
			helpText)
 ->	QUESTION FIELD SET [ defines chunk of similar inputs ]
			(idName,
			labelText,
			childElements,
			--numChildren--,
			childrenType,
			required,
			helpText)
...	 ->	BASIC QUESTION [ must be contained by FIELD SET ]
				(idName, 
				labelText, 
				childElements, 
				--numChildren--, 
				inputType,
				required,
				validationType)
...	...	 ->	TEXT ELEMENT [ text-input or textarea ]
					(idName, 
					labelText, 
					childElements, 
					--numChildren--, 
					inputType,
					required,
					validationType,
					width,
					sizeLimit,
					cols,
					rows)
...	...	 ->	SELECTION ELEMENT [ radio or checkbox ]
					(idName, 
					labelText, 
					childElements, 
					--numChildren--, 
					inputType,
					required,
					validationType,
					choiceValue,
					defaultState,
					outputText)

######################################################				

DEFAULT CONSTRUCTIONS:

$testQuestionSet = array ( 'questionPageOne' );

$textObject = new TextObject ( array (
	'idName' => 'textObject',
	'textBody' => 'Here is a bunch of text that you want to stand alone in an explanatory paragraph somewhere on the page. You can keep typing.')
	);

$textElement = new TextElement ( array (
	'idName' => 'textElement', 
	'labelText' => 'First Field', 
	'childElements' => array(), 
	'inputType' => 'text',
	'required' => 'yes',
	'validationType' => 'none',
	'width' => 'full',
	'sizeLimit' => '',
	'cols' => '',
	'rows' => '')
	);

$selectionElement = new SelectionElement ( array (
	'idName' => 'selectionElection', 
	'labelText' => 'Pick Me.', 
	'childElements' => array () , 
	'inputType' => 'radio',
	'required' => '',
	'validationType' => 'none',
	'choiceValue' => 'optionOne',
	'defaultState' => '',
	'outputText' => '')
	);

$fieldSet = new QuestionFieldSet ( array (
	'idName' => 'fieldSet', 
	'labelText' => 'Please select from these options.', 
	'childElements' => array ( $textElement, $selectionElement ), 
	'childrenType' => 'radio',
	'required' => '',
	'helpText' => 'Here is some additional information.')
	);

$questionPage = new QuestionPage ( array (
	'idName' => 'questionPage', 
	'labelText' => 'State the next general question here.', 
	'childElements' => array ( $fieldSet ), 
	'pageTitleText' => 'Question Title', 
	'helpText' => 'More info. Displayed on an as-needed basis.')
	);
	
######################################################				
*/
class TextObject {
	
	public $idName = null;
	public $textBody = null;
	
	public function __construct ( $data = array () ) {
		if ( !empty ( $data['idName'] ) ) {
			$this->idName = $data['idName'];
			}
		if ( !empty ( $data['textBody'] ) ) {
			$this->textBody = $data['textBody'];
			}
		}
	
	public function __set ( $property, $value ) {
		if ( array_key_exists ( $property, get_object_vars ( $this ) ) ) {
			$this->{$property} = $value;
		} 
	}
	
	public function __get ( $property ) {
		if ( array_key_exists ( $property, get_object_vars ( $this ) ) ) {
			return $this->{$property};
		} 
	}	
}

class BasicElement {
	
	public $idName = null;
	public $labelText = null;
	public $childElements = array();
	public $numChildren = null;
	
	public function __construct ( $data = array() ) {
		if ( !empty ( $data['idName'] ) ) {
			$this->idName = $data['idName'];
		}
		if ( !empty ( $data['labelText'] ) ) {
			$this->labelText = $data['labelText'];
		}
		if ( !empty ( $data['childElements'] ) ) {
			$this->childElements = $data['childElements'];
			$this->numChildren = count ( $this->childElements );
		}	
	}
	
	public function __set ( $property, $value ) {
		if ( array_key_exists ( $property, get_object_vars ( $this ) ) ) {
			$this->{$property} = $value;
		} 
	}
	
	public function __get ( $property ) {
		if ( array_key_exists ( $property, get_object_vars ( $this ) ) ) {
			return $this->{$property};
		} 
	}
	
}

class QuestionPage extends BasicElement {

	public $pageTitleText = null;
	public $helpText = null;
	
	public function __construct ( $data = array () ) {
		parent::__construct ( $data );
		if ( !empty ( $data['pageTitleText'] ) ) {
			$this->pageTitleText = $data['pageTitleText'];
		}
		if ( !empty ( $data['helpText'] ) ) {
			$this->helpText = $data['helpText'];
		}
	}
	
	public function __set ( $property, $value ) {
		parent::__set ( $property, $value );
	}
	
	public function __get ( $property ) {
		parent::__get ( $property );
	}

}
	
class QuestionFieldSet extends BasicElement {

	public $childrenType = null;
	public $required = null;
	public $helpText = null;

	
	public function __construct ( $data = array () ) {
		parent::__construct ( $data );
		if ( !empty ( $data['childrenType'] ) ) {
			$this->childrenType = $data['childrenType'];
		}
		if ( !empty ( $data['required'] ) ) {
			$this->required = $data['required'];
		}
		if ( !empty ( $data['helpText'] ) ) {
			$this->helpText = $data['helpText'];
		}
	}
	
	public function __set ( $property, $value ) {
		parent::__set ( $property, $value );
	}
	
	public function __get ( $property ) {
		parent::__get ( $property );
	}

}

class BasicQuestion extends BasicElement {
	
	public $inputType = null;
	public $required = null;
	public $validationType = 'none';
	
	public function __construct ( $data = array () ) {
		parent::__construct ( $data );
		if ( !empty ( $data['inputType'] ) ) {
			$this->inputType = $data['inputType'];
		}
		if ( !empty ( $data['required'] ) ) {
			$this->required = $data['required'];
		}
		if ( !empty ( $data['validationType'] ) ) {
			$this->validationType = $data['validationType'];
		}
	}
	
	public function __set ( $property, $value ) {
		parent::__set ( $property, $value );
	}
	
	public function __get ( $property ) {
		parent::__get ( $property );
	}
	
}

class TextElement extends BasicQuestion {
	
	public $width = null;
	public $sizeLimit = null;
	public $cols = null;
	public $rows = null;
	
	public function __construct ( $data = array () ) {
		parent::__construct ( $data );
		if ( !empty ( $data['width'] ) ) {
			$this->width = $data['width'];
		}
		if ( !empty ( $data['sizeLimit'] ) ) {
			$this->sizeLimit = $data['sizeLimit'];
		}
		if ( !empty ( $data['cols'] ) ) {
			$this->cols = $data['cols'];
		}
		if ( !empty ( $data['rows'] ) ) {
			$this->rows = $data['rows'];
		}
	}
	
	public function __set ( $property, $value ) {
		parent::__set ( $property, $value );
	}
	
	public function __get ( $property ) {
		parent::__get ( $property );
	}
	
}
	
class SelectionElement extends BasicQuestion {
	
	public $choiceValue = null;
	public $defaultState = null;
	public $outputText = null;

	public function __construct ( $data = array () ) {
		parent::__construct ( $data );
		if ( !empty ( $data['choiceValue'] ) ) {
			$this->choiceValue = $data['choiceValue'];
		}
		if ( !empty ( $data['defaultState'] ) ) {
			$this->defaultState = $data['defaultState'];
		}
		if ( !empty ( $data['outputText'] ) ) {
			$this->outputText = $data['outputText'];
		}
	}
	
	public function __set ( $property, $value ) {
		parent::__set ( $property, $value );
	}
	
	public function __get ( $property ) {
		parent::__get ( $property );
	}

}
	
?>