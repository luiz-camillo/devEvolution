<?php
namespace App\Curso\Database;

use PDO;

class SqliteConnection extends DbConnection
{
    private PDO $pdo;

    public function getConnection(): PDO
{
    if (!isset($this->pdo)) {
       
        $dbPath = __DIR__ . '/../../data/database.sqlite';

        $dbDir = dirname($dbPath);
        if (!is_dir($dbDir)) {
            mkdir($dbDir, 0777, true);
        }

        $this->pdo = new PDO('sqlite:' . $dbPath);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    return $this->pdo;
}
}