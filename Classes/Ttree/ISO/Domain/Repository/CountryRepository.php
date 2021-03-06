<?php
namespace Ttree\ISO\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use Ttree\ISO\Domain\Model\Country;
use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for ISO Country
 *
 * @Flow\Scope("singleton")
 */
class CountryRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @param string $standard
	 * @param string $alpha3
	 * @return Country
	 */
	public function findByStandardAndAlpha3($standard, $alpha3) {
		$query = $this->createQuery();

		$query->matching(
			$query->logicalAnd(
				$query->equals('standard', $standard),
				$query->equals('alpha3', $alpha3)
			)
		);

		$query->setLimit(1);

		return $query->execute()->getFirst();
	}

	/**
	 * @param string $code
	 * @param string $field
	 * @return Country
	 */
	public function findByNumericalCode($code, $field) {
		$query = $this->createQuery();

		$query->matching($query->equals($field, $code));

		$query->setLimit(1);

		return $query->execute()->getFirst();
	}

}

?>