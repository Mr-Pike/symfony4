<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171219143137 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE company_id company_id INT DEFAULT NULL, CHANGE email mail VARCHAR(120) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495126AC48 ON user (mail)');
        $this->addSql('ALTER TABLE company CHANGE address2 address2 VARCHAR(120) DEFAULT NULL, CHANGE phone phone VARCHAR(20) DEFAULT NULL, CHANGE mail mail VARCHAR(100) DEFAULT NULL, CHANGE turnover turnover NUMERIC(10, 2) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE address2 address2 VARCHAR(120) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE phone phone VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE mail mail VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE turnover turnover NUMERIC(10, 2) DEFAULT \'NULL\'');
        $this->addSql('DROP INDEX UNIQ_8D93D6495126AC48 ON user');
        $this->addSql('ALTER TABLE user CHANGE company_id company_id INT DEFAULT NULL, CHANGE mail email VARCHAR(120) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }
}
