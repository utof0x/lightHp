<?php

namespace app\core;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigration = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigration = array_diff($files, $appliedMigration);

        foreach ($toApplyMigration as $migration) {
            if($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR."/migrations/$migration";
            $migrationName = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $migrationName();
            $this->log("Applying migration $migrationName");
            $instance->up();
            $this->log("Applied migration $migrationName");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log('All migrations applied');
        }
    }

    protected function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare('SELECT migration FROM migrations');
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $migrations): void
    {
        $migrationsStr = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrationsStr");
        $statement->execute();
    }

    protected function log(string $message): void
    {
        echo "[" . date('Y-m-d H:i:s') . "] - " . $message . PHP_EOL;
    }
}