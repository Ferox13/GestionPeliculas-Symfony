<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216155337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__pelicula AS SELECT id, titulo, director, genero, poster, valoracion, duracion, estreno FROM pelicula');
        $this->addSql('DROP TABLE pelicula');
        $this->addSql('CREATE TABLE pelicula (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, genero VARCHAR(255) NOT NULL, poster VARCHAR(350) DEFAULT NULL, valoracion DOUBLE PRECISION NOT NULL, duracion DOUBLE PRECISION NOT NULL, estreno DATETIME NOT NULL)');
        $this->addSql('INSERT INTO pelicula (id, titulo, director, genero, poster, valoracion, duracion, estreno) SELECT id, titulo, director, genero, poster, valoracion, duracion, estreno FROM __temp__pelicula');
        $this->addSql('DROP TABLE __temp__pelicula');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__pelicula AS SELECT id, titulo, director, genero, poster, valoracion, duracion, estreno FROM pelicula');
        $this->addSql('DROP TABLE pelicula');
        $this->addSql('CREATE TABLE pelicula (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, genero VARCHAR(255) NOT NULL, poster VARCHAR(350) DEFAULT NULL, valoracion VARCHAR(255) NOT NULL, duracion VARCHAR(255) NOT NULL, estreno VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO pelicula (id, titulo, director, genero, poster, valoracion, duracion, estreno) SELECT id, titulo, director, genero, poster, valoracion, duracion, estreno FROM __temp__pelicula');
        $this->addSql('DROP TABLE __temp__pelicula');
    }
}
