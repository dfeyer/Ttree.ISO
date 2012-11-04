<?php
namespace Ttree\ISO\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Ttree.ISO".                  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow,
	Doctrine\ORM\Mapping as ORM;

/**
 * ISO Country
 *
 * @Flow\Entity
 */
class Language {

	const STATUS_RETIRED = 'Retired';
	const STATUS_ACTIVE  = 'Active';

	const STANDARD_ISO_639_3   = 'ISO639-3';

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=10 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=10)
	 * @ORM\Id
	 */
	protected $standard;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=3 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=3)
	 * @ORM\Id
	 */
	protected $id;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=20 })
	 * @ORM\Column(nullable=true)
	 */
	protected $part1;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=20 })
	 * @ORM\Column(nullable=true)
	 */
	protected $part2;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=12 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=12)
	 */
	protected $status;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=1 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=1)
	 */
	protected $scope;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=20 })
	 * @ORM\Column(nullable=true)
	 */
	protected $type;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @ORM\Column(nullable=true)
	 */
	protected $invertedName;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=200)
	 */
	protected $referenceName;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=200)
	 */
	protected $name;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @ORM\Column(nullable=true)
	 */
	protected $commonName;

	/**
	 * @param string $commonName
	 */
	public function setCommonName($commonName) {
		$this->commonName = $commonName;
	}

	/**
	 * @return string
	 */
	public function getCommonName() {
		return $this->commonName;
	}

	/**
	 * @param string $standard
	 */
	public function setStandard($standard) {
		$this->standard = $standard;
	}

	/**
	 * @return string
	 */
	public function getStandard() {
		return $this->standard;
	}

	/**
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $invertedName
	 */
	public function setInvertedName($invertedName) {
		$this->invertedName = $invertedName;
	}

	/**
	 * @return string
	 */
	public function getInvertedName() {
		return $this->invertedName;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $part1
	 */
	public function setPart1($part1) {
		$this->part1 = $part1;
	}

	/**
	 * @return string
	 */
	public function getPart1() {
		return $this->part1;
	}

	/**
	 * @param string $part2
	 */
	public function setPart2($part2) {
		$this->part2 = $part2;
	}

	/**
	 * @return string
	 */
	public function getPart2() {
		return $this->part2;
	}

	/**
	 * @param string $referenceName
	 */
	public function setReferenceName($referenceName) {
		$this->referenceName = $referenceName;
	}

	/**
	 * @return string
	 */
	public function getReferenceName() {
		return $this->referenceName;
	}

	/**
	 * @param string $scope
	 */
	public function setScope($scope) {
		$this->scope = $scope;
	}

	/**
	 * @return string
	 */
	public function getScope() {
		return $this->scope;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

}

?>