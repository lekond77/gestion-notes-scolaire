<?php

declare(strict_types=1);

namespace App\Lib;

class DatabaseConnection
{
    private ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=releve_notes;charset=utf8', 'root', '');
        }
        return $this->database;
    }
}
