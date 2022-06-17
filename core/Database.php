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

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(Application::$ROOT_DIR . '/migrations');
        $toApply = array_diff($files, $appliedMigrations);
        $newMigrations = [];
        foreach ($toApply as $migration) {

            if ($migration === '.' || $migration === '..'){
                continue;
            }
            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            echo "App $migration" . PHP_EOL;
            $instance->up();
            $newMigrations[] = $migration;
            echo "End $migration" . PHP_EOL;
        }
        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            echo "All migrations applied";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        array_map(fn($m) => "('')");
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (:mig)");
        $statement->execute([
            'mig' => $migrations
        ]);
    }
}