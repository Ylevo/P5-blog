<?php
declare(strict_types=1);

namespace App\Core;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    public PDO $pdo;

    public function __construct(
        string $db,
        string $username = NULL,
        string $password = NULL,
        string $host = '127.0.0.1',
        int $port = 3306,
        array $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function run(string $sql, array $args = null) : PDOStatement
    {
        if (!$args) {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function runTransaction(string $sql, array $argsArray) : void
    {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare($sql);
            foreach ($argsArray as $args) {
                $stmt->execute(is_array($args) ? $args : [$args]);
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            throw $e;
        }
    }
}
