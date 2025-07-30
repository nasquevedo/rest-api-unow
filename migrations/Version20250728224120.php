<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250728224120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert the admin user';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            INSERT INTO user (email, roles, password, name, last_name, position, birthdate) VALUES ('admin@admin.com', '["ROLE_ADMIN"]', '$2y$13$UnrKOzP8QzAuiqe5wV2.b.ukRPJtaopCE2pYagJ.NiRcwGO5HxFvS', 'admin', 'admin', 'admin', '1994-04-20')
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DELETE FROM user WHERE email = 'admin@admin.com'
        SQL);
    }
}
