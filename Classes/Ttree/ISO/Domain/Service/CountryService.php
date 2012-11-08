<?php
namespace Ttree\ISO\Domain\Service;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow,
	Ttree\ISO\Domain\Model\Country;

/**
 * @Flow\Scope("singleton")
 */
class CountryService {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\I18n\Translator
	 */
	protected $translator;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\I18n\Service
	 */
	protected $localizationService;

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
	 * @var \Ttree\ISO\Domain\Repository\CountryRepository
	 */
	protected $countryRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\Doctrine\PersistenceManager
	 */
	protected $persistenceManager;

	/**
	 * Prepare a localized options list as array
	 *
	 * @return array  an associative array of options, key will be the value of the option tag
	 */
	public function prepareLocalizedOptionsList() {
		$options = array();

		$countries = $this->countryRepository->findAll();
		foreach ($countries as $country) {
			$label = $this->getLocalizedName($country);
			$label = $this->translator->translateByOriginalLabel($label, array(),NULL, NULL, 'Countries', 'Ttree.ISO');
			$identifier = $this->persistenceManager->getIdentifierByObject($country);
			$options[$identifier] = $label;
		}

		asort($options);

		return $options;
	}

	/**
	 * @param \Ttree\ISO\Domain\Model\Country $country
	 * @return string
	 */
	public function getLocalizedName(Country $country) {
		$label = $country->getName();
		try {
			$localizedLabel = $this->translator->translateByOriginalLabel($label, array(),NULL, NULL, 'Countries', 'Ttree.ISO');
		} catch (\TYPO3\Flow\I18n\Exception $e) {
			$localizedLabel = $label;
		}

		return $localizedLabel;
	}

	/**
	 * @param array $data
	 */
	public function importExternalData(array $data) {
		$propertyMappingConfiguration = $this->getPropertyMappingConfiguration();

		foreach ($data as $country) {
			$existingCountry = $this->countryRepository->findByStandardAndAlpha3($country['standard'], $country['alpha_3_code']);
			if ($existingCountry === NULL) {
				$country = $this->propertyMapper->convert($country, 'Ttree\ISO\Domain\Model\Country', $propertyMappingConfiguration);
				$this->countryRepository->add($country);
			} else {
				$country['__identity'] = $this->persistenceManager->getIdentifierByObject($existingCountry);
				$country = $this->propertyMapper->convert($country, 'Ttree\ISO\Domain\Model\Country', $propertyMappingConfiguration);
				$this->countryRepository->update($country);
			}
			$this->persistenceManager->persistAll();
		}
	}

	/**
	 * @return \TYPO3\Flow\Property\PropertyMappingConfiguration
	 */
	protected function getPropertyMappingConfiguration() {
		$propertyMappingConfiguration = $this->propertyMappingConfigurationBuilder->build();
		$propertyMappingConfiguration->setTypeConverter(new \TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter());

		$propertyMappingConfiguration->setTypeConverterOption(
			'TYPO3\Flow\Property\TypeConverter\DateTimeConverter',
			\TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
			'Y-m-d'
		);
		$propertyMappingConfiguration->forProperty('date_withdrawn')->setTypeConverter(new \TYPO3\Flow\Property\TypeConverter\DateTimeConverter());

		$propertyMappingConfiguration->setMapping('alpha_2_code', 'alpha2');
		$propertyMappingConfiguration->setMapping('alpha_3_code', 'alpha3');
		$propertyMappingConfiguration->setMapping('alpha_4_code', 'alpha4');
		$propertyMappingConfiguration->setMapping('numeric_code', 'numericCode');
		$propertyMappingConfiguration->setMapping('common_name', 'commonName');
		$propertyMappingConfiguration->setMapping('official_name', 'officialName');
		$propertyMappingConfiguration->setMapping('date_withdrawn', 'dateOfWithdrawn');

		return $propertyMappingConfiguration;
	}

}
?>