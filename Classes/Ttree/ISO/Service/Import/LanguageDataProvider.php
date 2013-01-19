<?php
namespace Ttree\ISO\Service\Import;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class LanguageDataProvider extends AbstractDataProvider implements DataProviderInterface {

	public function parseResource($resource) {
		parent::parseResource($resource);

		foreach ($this->data['iso_639_3_entry'] as $key=>$data) {
			$this->data['iso_639_3_entry'][$key] = $data['@attributes'];
			$this->data['iso_639_3_entry'][$key]['standard'] = \Ttree\ISO\Domain\Model\Language::STANDARD_ISO_639_3;
		}
	}

	/**
	 * @return int
	 */
	public function getRecordCount() {
		return count($this->getData());
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data['iso_639_3_entry'];
	}

}
?>