<?php
namespace Ttree\ISO\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for ISO Language
 *
 * @Flow\Scope("singleton")
 */
class LanguageRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	 * @param string $standard
	 * @param string $id
	 * @return \Ttree\ISO\Domain\Model\Country
	 */
	public function findByStandardAndId($standard, $id) {
		$query = $this->createQuery();

		$query->matching(
			$query->logicalAnd(
				$query->equals('standard', $standard),
				$query->equals('id', $id)
			)
		);

		$query->setLimit(1);

		return $query->execute()->getFirst();
	}

}

?>