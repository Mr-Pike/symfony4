<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171221141723 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D649A9D1C132 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649C808BA5A ON user');
        $this->addSql('ALTER TABLE user ADD manager_id INT DEFAULT NULL, ADD is_manager TINYINT(1) DEFAULT \'1\' NOT NULL, CHANGE company_id company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649783E3463 ON user (manager_id)');
        $this->addSql('ALTER TABLE company CHANGE address2 address2 VARCHAR(120) DEFAULT NULL, CHANGE phone phone VARCHAR(20) DEFAULT NULL, CHANGE mail mail VARCHAR(100) DEFAULT NULL, CHANGE turnover turnover NUMERIC(10, 2) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE address2 address2 VARCHAR(120) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE phone phone VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE mail mail VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8_unicode_ci, CHANGE turnover turnover NUMERIC(10, 2) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649783E3463');
        $this->addSql('DROP INDEX IDX_8D93D649783E3463 ON user');
        $this->addSql('ALTER TABLE user DROP manager_id, DROP is_manager, CHANGE company_id company_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A9D1C132 ON user (first_name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C808BA5A ON user (last_name)');
    }
}
