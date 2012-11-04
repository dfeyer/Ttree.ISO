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
abstract class AbstractDataProvider {

	/**
	 * @var string
	 */
	protected $resource;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @param string $resource
	 * @return void
	 */
	public function parseResource($resource) {
		$this->resource = $resource;
		$xml            = file_get_contents($resource);
		$this->data     = $this->convertXmlToArray(simplexml_load_string($xml));
	}

	/**
	 * @param \SimpleXMLElement|array $xml
	 * @return array
	 */
	protected function convertXmlToArray($xml) {
		if (is_object($xml) && get_class($xml) === 'SimpleXMLElement') {
			$attributes = $xml->attributes();
			foreach ($attributes as $k => $v) {
				if ($v) $a[$k] = (string)$v;
			}
			$x   = $xml;
			$xml = get_object_vars($xml);
		}
		if (is_array($xml)) {
			if (count($xml) == 0) return (string)$x; // for CDATA
			foreach ($xml as $key => $value) {
				$r[$key] = $this->convertXmlToArray($value);
			}
			if (isset($a)) $r['@attributes'] = $a; // Attributes
			return $r;
		}
		return (string)$xml;
	}
}

?>