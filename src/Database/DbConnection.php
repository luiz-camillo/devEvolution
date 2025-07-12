<?php
namespace App\Curso\Database;

use PDO;

abstract class DbConnection
{
    abstract public function getConnection(): PDO;
}
