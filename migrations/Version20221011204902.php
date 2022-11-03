<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221011204902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, genre_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, annee_de_sortie INT NOT NULL, affiche LONGTEXT DEFAULT NULL, INDEX IDX_CEECCA514296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films_acteurs (films_id INT NOT NULL, acteurs_id INT NOT NULL, INDEX IDX_A526A0F939610EE (films_id), INDEX IDX_A526A0F71A27AFC (acteurs_id), PRIMARY KEY(films_id, acteurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films ADD CONSTRAINT FK_CEECCA514296D31F FOREIGN KEY (genre_id) REFERENCES genres (id)');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F71A27AFC FOREIGN KEY (acteurs_id) REFERENCES acteurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE films DROP FOREIGN KEY FK_CEECCA514296D31F');
        $this->addSql('ALTER TABLE films_acteurs DROP FOREIGN KEY FK_A526A0F939610EE');
        $this->addSql('ALTER TABLE films_acteurs DROP FOREIGN KEY FK_A526A0F71A27AFC');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE films_acteurs');
    }
}
