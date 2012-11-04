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
class CountryDataProvider extends AbstractDataProvider implements DataProviderInterface {

	public function parseResource($resource) {
		parent::parseResource($resource);

		foreach ($this->data['iso_3166_entry'] as $key=>$data) {
			$data = $data['@attributes'];
			$data['standard'] = \Ttree\Iso\Domain\Model\Country::STANDARD_ISO_3166;
			$this->data['iso_3166_entry'][$key] = $data;
		}

		foreach ($this->data['iso_3166_3_entry'] as $key=>$data) {
			$data = $data['@attributes'];
			$data['name'] = $data['names'];
			unset( $data['names']);
			$data['standard'] = \Ttree\Iso\Domain\Model\Country::STANDARD_ISO_3166_3;
			$this->data['iso_3166_entry'][$key] = $data;
		}

		$this->data = $this->data['iso_3166_entry'] + $this->data['iso_3166_3_entry'];
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
		return $this->data;
	}

}
?>