<?php
namespace Ttree\ISO\Domain\Service;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\I18n\Exception;
use TYPO3\Flow\I18n\Translator;
use TYPO3\Flow\Log\SystemLoggerInterface;
use TYPO3\Flow\Persistence\PersistenceManagerInterface;
use TYPO3\Flow\Property\PropertyMapper;
use TYPO3\Flow\Property\PropertyMappingConfigurationBuilder;

/**
 * Abstract Service
 */
class AbstractService
{

    /**
     * @Flow\Inject
     * @var Translator
     */
    protected $translator;

    /**
     * @Flow\Inject
     * @var PropertyMapper
     */
    protected $propertyMapper;

    /**
     * @Flow\Inject
     * @var PropertyMappingConfigurationBuilder
     */
    protected $propertyMappingConfigurationBuilder;

    /**
     * @Flow\Inject
     * @var SystemLoggerInterface
     */
    protected $systemLogger;

    /**
     * @Flow\Inject
     * @var PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * @param string $name
     * @param string $sourceName
     * @param string $packageKey
     * @return string
     */
    public function translate($name, $sourceName, $packageKey = 'Ttree.ISO') {
        try {
            $name = $this->translator->translateByOriginalLabel($name, array(),NULL, NULL, $sourceName, $packageKey);
        } catch (Exception $e) {

        }

        return $name;
    }

}
