<?php
namespace Ttree\ISO\Domain\Service;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class LanguageService {

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
		$propertyMappingConfiguration = $this->propertyMappingConfigurationBuilder->build();
		$propertyMappingConfiguration->setTypeConverter(new \TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter());
		$propertyMappingConfiguration->setMapping('reference_name', 'referenceName');
		$propertyMappingConfiguration->setMapping('part1_code', 'part1');
		$propertyMappingConfiguration->setMapping('part2_code', 'part2');
		$propertyMappingConfiguration->setMapping('inverted_name', 'invertedName');
		$propertyMappingConfiguration->setMapping('reference_name', 'referenceName');
		$propertyMappingConfiguration->setMapping('common_name', 'commonName');

		foreach ($data as $language) {
			$language = $this->propertyMapper->convert($language, 'Ttree\ISO\Domain\Model\Language', $propertyMappingConfiguration);
			if ($this->persistenceManager->isNewObject($language)) {
				$this->languageRepository->add($language);
			} else {
				$this->languageRepository->update($language);
			}
		}
	}
}
?>