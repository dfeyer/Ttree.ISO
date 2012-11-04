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
class Country {

	const STANDARD_ISO_3166   = 'ISO3166';
	const STANDARD_ISO_3166_3 = 'ISO3166-3';

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
	 * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=2 })
	 * @ORM\Column(nullable=true)
	 * @ORM\Column(length=2)
	 */
	protected $alpha2;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=3 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=3)
	 * @ORM\Id
	 */
	protected $alpha3;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=2, "maximum"=4 })
	 * @ORM\Column(nullable=true)
	 * @ORM\Column(length=4)
	 */
	protected $alpha4;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @ORM\Column(nullable=true)
	 * @ORM\Column(length=3)
	 */
	protected $numericCode;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=100 })
	 * @Flow\Validate(type="NotEmpty")
	 * @ORM\Column(length=100)
	 */
	protected $name;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=100 })
	 * @ORM\Column(nullable=true)
	 * @ORM\Column(length=100)
	 */
	protected $commonName;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @ORM\Column(nullable=true)
	 * @ORM\Column(length=200)
	 */
	protected $comment;

	/**
	 * @var \DateTime
	 * @ORM\Column(nullable=true)
	 */
	protected $dateOfWithdrawn;

	/**
	 * @var string
	 * @Flow\Validate(type="Text")
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=200 })
	 * @ORM\Column(nullable=true)
	 */
	protected $officialName;

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
	 * @param string $comment
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * @param string $alpha2
	 */
	public function setAlpha2($alpha2) {
		$this->alpha2 = $alpha2;
	}

	/**
	 * @return string
	 */
	public function getAlpha2() {
		return $this->alpha2;
	}

	/**
	 * @param string $alpha3
	 */
	public function setAlpha3($alpha3) {
		$this->alpha3 = $alpha3;
	}

	/**
	 * @return string
	 */
	public function getAlpha3() {
		return $this->alpha3;
	}

	/**
	 * @param string $alpha4
	 */
	public function setAlpha4($alpha4) {
		$this->alpha4 = $alpha4;
	}

	/**
	 * @return string
	 */
	public function getAlpha4() {
		return $this->alpha4;
	}

	/**
	 * @param \DateTime $dateOfWithdrawn
	 */
	public function setDateOfWithdrawn($dateOfWithdrawn) {
		$this->dateOfWithdrawn = $dateOfWithdrawn;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateOfWithdrawn() {
		return $this->dateOfWithdrawn;
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
	 * @param string $officialName
	 */
	public function setOfficialName($officialName) {
		$this->officialName = $officialName;
	}

	/**
	 * @return string
	 */
	public function getOfficialName() {
		return $this->officialName;
	}

	/**
	 * @param string $numericCode
	 */
	public function setNumericCode($numericCode) {
		$this->numericCode = $numericCode;
	}

	/**
	 * @return string
	 */
	public function getNumericCode() {
		return $this->numericCode;
	}

}

?>