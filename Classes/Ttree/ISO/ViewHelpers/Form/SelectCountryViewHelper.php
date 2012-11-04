<?php
namespace Ttree\ISO\ViewHelpers\Form;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * This view helper generates a <select> dropdown list for ISO Countries
 *
 * @api
 */
class SelectCountryViewHelper extends \TYPO3\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'select';

	/**
	 * @var mixed
	 */
	protected $selectedValue = NULL;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Domain\Repository\CountryRepository
	 */
	protected $countryRepository;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Domain\Service\CountryService
	 */
	protected $countryService;

	/**
	 * Initialize arguments.
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerUniversalTagAttributes();
		$this->registerTagAttribute('multiple', 'string', 'if set, multiple select field');
		$this->registerTagAttribute('size', 'string', 'Size of input field');
		$this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
		$this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'f3-form-error');
	}

	/**
	 * Render the tag.
	 *
	 * @return string rendered tag.
	 * @api
	 */
	public function render() {
		$name = $this->getName();
		if ($this->hasArgument('multiple')) {
			$name .= '[]';
		}

		$this->tag->addAttribute('name', $name);

		$options = $this->countryService->prepareLocalizedOptionsList();
		if (empty($options)) {
			$options = array('' => '');
		}
		$this->tag->setContent($this->renderOptionTags($options));

		$this->setErrorClassAttribute();

			// register field name for token generation.
			// in case it is a multi-select, we need to register the field name
			// as often as there are elements in the box
		if ($this->hasArgument('multiple') && $this->arguments['multiple'] !== '') {
			$this->renderHiddenFieldForEmptyValue();
			for ($i = 0; $i < count($options); $i++) {
				$this->registerFieldNameForFormTokenGeneration($name);
			}
		} else {
			$this->registerFieldNameForFormTokenGeneration($name);
		}

		return $this->tag->render();
	}

	/**
	 * Render the option tags.
	 *
	 * @param array $options the options for the form.
	 * @return string rendered tags.
	 */
	protected function renderOptionTags($options) {
		$output = '';

		foreach ($options as $value => $label) {
			$output .= $this->renderOptionTag($value, $label) . chr(10);
		}
		return $output;
	}

	/**
	 * Render the option tags.
	 *
	 * @param mixed $value Value to check for
	 * @return boolean TRUE if the value should be marked a s selected; FALSE otherwise
	 */
	protected function isSelected($value) {
		$selectedValue = $this->getSelectedValue();
		if ($value === $selectedValue || (string)$value === $selectedValue) {
			return TRUE;
		}
		if ($this->hasArgument('multiple')) {
			if ($selectedValue === NULL) {
				return TRUE;
			} elseif (is_array($selectedValue) && in_array($value, $selectedValue)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Retrieves the selected value(s)
	 *
	 * @return mixed value string or an array of strings
	 */
	protected function getSelectedValue() {
		$value = $this->getValue();
		if (!is_array($value) && !($value instanceof  \Traversable)) {
			return $this->getOptionValueScalar($value);
		}
		$selectedValues = array();
		foreach ($value as $selectedValueElement) {
			$selectedValues[] = $this->getOptionValueScalar($selectedValueElement);
		}
		return $selectedValues;
	}

	/**
	 * Get the option value for an object
	 *
	 * @param mixed $valueElement
	 * @return string
	 */
	protected function getOptionValueScalar($valueElement) {
		if (is_object($valueElement)) {
			if ($this->persistenceManager->getIdentifierByObject($valueElement) !== NULL) {
				return $this->persistenceManager->getIdentifierByObject($valueElement);
			} else {
				return (string)$valueElement;
			}
		} else {
			return $valueElement;
		}
	}

	/**
	 * Render one option tag
	 *
	 * @param string $value value attribute of the option tag (will be escaped)
	 * @param string $label content of the option tag (will be escaped)
	 * @return string the rendered option tag
	 */
	protected function renderOptionTag($value, $label) {
		$output = '<option value="' . htmlspecialchars($value) . '"';
		if ($this->isSelected($value)) {
			$output .= ' selected="selected"';
		}

		if ($this->hasArgument('translate')) {
			$label = $this->getTranslatedLabel($value, $label);
		}
		$output .= '>' . htmlspecialchars($label) . '</option>';

		return $output;
	}

	/**
	 * Returns a translated version of the given label
	 *
	 * @param string $value option tag value
	 * @param string $label option tag label
	 * @return string
	 * @throws \TYPO3\Fluid\Core\ViewHelper\Exception
	 */
	protected function getTranslatedLabel($value, $label) {
		return 'TODO';
	}
}

?>