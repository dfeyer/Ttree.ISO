<?php
namespace Ttree\ISO\Command;

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Cli\Response;

/**
 * @Flow\Scope("singleton")
 */
class IsoCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Service\Import\LanguageDataProvider
	 */
	protected $languageDataProvider;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Service\Import\CountryDataProvider
	 */
	protected $countryDataProvider;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Domain\Service\LanguageService
	 */
	protected $languageService;

	/**
	 * @Flow\Inject
	 * @var \Ttree\ISO\Domain\Service\CountryService
	 */
	protected $countryService;

	/**
	 * Import languages to the database
	 *
	 * This command parse XML file provided by the iso-codes
	 * Debian package to populate the database
	 *
	 * @return string
	 */
	public function importLanguagesCommand() {
		$this->response->setOutputFormat(Response::OUTPUTFORMAT_RAW);

		$this->languageDataProvider->parseResource('resource://Ttree.ISO/Private/ISO/iso_639_3.xml');
		$data = $this->languageDataProvider->getData();

		$this->languageService->importExternalData($data);

		$this->quit(0);
	}

	/**
	 * Import countries to the database
	 *
	 * This command parse XML file provided by the iso-codes
	 * Debian package to populate the database
	 *
	 * @return string
	 */
	public function importCountriesCommand() {
		$this->response->setOutputFormat(Response::OUTPUTFORMAT_RAW);

		$this->countryDataProvider->parseResource('resource://Ttree.ISO/Private/ISO/iso_3166.xml');
		$data = $this->countryDataProvider->getData();

		$this->countryService->importExternalData($data);

		$this->quit(0);
	}

}
?>