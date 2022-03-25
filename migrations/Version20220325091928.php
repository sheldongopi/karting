<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220325091928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activiteiten (id INT AUTO_INCREMENT NOT NULL, soort_id INT DEFAULT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, INDEX IDX_1C50895F3DEE50DF (soort_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', voorletters VARCHAR(10) NOT NULL, tussenvoegsel VARCHAR(10) DEFAULT NULL, achternaam VARCHAR(25) NOT NULL, adres VARCHAR(25) NOT NULL, postcode VARCHAR(7) NOT NULL, woonplaats VARCHAR(20) NOT NULL, telefoon VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_C2502824F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deelnames (user_id INT NOT NULL, activiteit_id INT NOT NULL, INDEX IDX_ED2478E7A76ED395 (user_id), INDEX IDX_ED2478E75A8A0A1 (activiteit_id), PRIMARY KEY(user_id, activiteit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soortactiviteiten (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, min_leeftijd INT NOT NULL, tijdsduur INT NOT NULL, prijs NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activiteiten ADD CONSTRAINT FK_1C50895F3DEE50DF FOREIGN KEY (soort_id) REFERENCES soortactiviteiten (id)');
        $this->addSql('ALTER TABLE deelnames ADD CONSTRAINT FK_ED2478E7A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deelnames ADD CONSTRAINT FK_ED2478E75A8A0A1 FOREIGN KEY (activiteit_id) REFERENCES activiteiten (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deelnames DROP FOREIGN KEY FK_ED2478E75A8A0A1');
        $this->addSql('ALTER TABLE deelnames DROP FOREIGN KEY FK_ED2478E7A76ED395');
        $this->addSql('ALTER TABLE activiteiten DROP FOREIGN KEY FK_1C50895F3DEE50DF');
        $this->addSql('DROP TABLE activiteiten');
        $this->addSql('DROP TABLE app_users');
        $this->addSql('DROP TABLE deelnames');
        $this->addSql('DROP TABLE soortactiviteiten');
    }
}
