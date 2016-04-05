<?php
namespace Ttree\ISO\Domain\Service;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use Ttree\ISO\Domain\Model\Language;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\I18n\Exception;

/**
 * @Flow\Scope("singleton")
 */
class LanguageService {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\I18n\Translator
	 */
	protected $translator;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Property\PropertyMapper
	 */
	protected $propertyMapper;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Property\PropertyMappingConfigurationBuilder
	 */
	protected $propertyMappingConfigurationBuilder;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Domain\Repository\LanguageRepository
	 */
	protected $languageRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\Doctrine\PersistenceManager
	 */
	protected $persistenceManager;

	/**
	 * @param array $data
	 */
	public function importExternalData(array $data) {
		$propertyMappingConfiguration = $this->getPropertyMappingConfiguration();

		foreach ($data as $language) {
			$existingLanguage = $this->languageRepository->findByStandardAndId($language['standard'], $language['id']);
			if ($existingLanguage === NULL) {
				$language = $this->propertyMapper->convert($language, 'Ttree\ISO\Domain\Model\Language', $propertyMappingConfiguration);
				$this->languageRepository->add($language);
			} else {
				$language['__identity'] = $this->persistenceManager->getIdentifierByObject($existingLanguage);
				$language = $this->propertyMapper->convert($language, 'Ttree\ISO\Domain\Model\Language', $propertyMappingConfiguration);
				$this->languageRepository->update($language);
			}
			$this->persistenceManager->persistAll();
		}
	}

	/**
	 * Prepare a localized options list as array
	 *
	 * @return array  an associative array of options, key will be the value of the option tag
	 */
	public function prepareLocalizedOptionsList() {
		$options = array();

		$languages = $this->languageRepository->findAll();
		foreach ($languages as $language) {
			$label = $this->getLocalizedName($language);
			$label = $this->translator->translateByOriginalLabel($label, array(),NULL, NULL, 'Languages', 'Ttree.ISO');
			$identifier = $this->persistenceManager->getIdentifierByObject($language);
			$options[$identifier] = $label;
		}

		asort($options);

		return $options;
	}

	/**
	 * @param Language $language
	 * @return string
	 */
	public function getLocalizedName(Language $language) {
		$label = $language->getName();
		try {
			$localizedLabel = $this->translator->translateByOriginalLabel($label, array(),NULL, NULL, 'Languages', 'Ttree.ISO');
		} catch (Exception $e) {
			$localizedLabel = $label;
		}

		return $localizedLabel;
	}

	/**
	 * @return \TYPO3\Flow\Property\PropertyMappingConfiguration
	 */
	protected function getPropertyMappingConfiguration() {
		$propertyMappingConfiguration = $this->propertyMappingConfigurationBuilder->build();
		$propertyMappingConfiguration->setTypeConverter(new \TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter());
		$propertyMappingConfiguration->setMapping('reference_name', 'referenceName');
		$propertyMappingConfiguration->setMapping('part1_code', 'part1');
		$propertyMappingConfiguration->setMapping('part2_code', 'part2');
		$propertyMappingConfiguration->setMapping('inverted_name', 'invertedName');
		$propertyMappingConfiguration->setMapping('reference_name', 'referenceName');
		$propertyMappingConfiguration->setMapping('common_name', 'commonName');

		return $propertyMappingConfiguration;
	}
}
?>
