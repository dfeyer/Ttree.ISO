<?php
namespace Ttree\ISO\Service\Import;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

interface DataProviderInterface {
	/**
	 * @param $resource
	 * @return void
	 */
	public function parseResource($resource);

	/**
	 * @return int
	 */
	public function getRecordCount();

	/**
	 * @return array
	 */
	public function getData();
}
?>