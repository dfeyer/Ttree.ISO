<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
	Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20121103180006 extends AbstractMigration {

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function up(Schema $schema) {
			// this up() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("CREATE TABLE ttree_iso_domain_model_country (persistence_object_identifier VARCHAR(40) NOT NULL, type VARCHAR(10) NOT NULL, alpha2 VARCHAR(2) NOT NULL, alpha3 VARCHAR(3) NOT NULL, alpha4 VARCHAR(4) NOT NULL, numericCode VARCHAR(3) NOT NULL, name VARCHAR(100) NOT NULL, comment VARCHAR(255) DEFAULT NULL, dateofwithdrawn DATETIME DEFAULT NULL, officialname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
		$this->addSql("CREATE TABLE ttree_iso_domain_model_language (persistence_object_identifier VARCHAR(40) NOT NULL, id VARCHAR(2) NOT NULL, part1 VARCHAR(255) DEFAULT NULL, part2 VARCHAR(255) DEFAULT NULL, status VARCHAR(12) NOT NULL, scope VARCHAR(1) NOT NULL, type VARCHAR(1) NOT NULL, invertedname VARCHAR(255) DEFAULT NULL, referencename VARCHAR(200) NOT NULL, name VARCHAR(200) NOT NULL, commonname VARCHAR(255) DEFAULT NULL, PRIMARY KEY(persistence_object_identifier)) ENGINE = InnoDB");
	}

	/**
	 * @param Schema $schema
	 * @return void
	 */
	public function down(Schema $schema) {
			// this down() migration is autogenerated, please modify it to your needs
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		
		$this->addSql("DROP TABLE ttree_iso_domain_model_country");
		$this->addSql("DROP TABLE ttree_iso_domain_model_language");
	}
}

?>