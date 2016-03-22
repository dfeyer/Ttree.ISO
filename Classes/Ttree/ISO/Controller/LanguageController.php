<?php
namespace Ttree\ISO\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\I18n\Exception;
use TYPO3\Flow\Mvc\Controller\ActionController;

/**
 * Abstract Service
 */
class LanguageController extends ActionController
{

    /**
     * @var string
     */
    protected $defaultViewObjectName = 'TYPO3\Flow\Mvc\View\JsonView';

    /**
     * @var array
     */
    protected $supportedMediaTypes = array('application/json');

    /**
     * @param string $query
     */
    public function searchAction($query) {

    }

}
