<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createUser($first_name, $last_name, $email, $password_hash) : string|bool
    {
        if ($this->checkIfEmailUsed($email)) {
            return false;
        }
        $this->database->run("INSERT INTO user (email, password_hash, first_name, last_name) VALUES (?, ?, ?, ?)", [$email, $password_hash, $first_name, $last_name]);
        return $this->database->pdo->lastInsertId();
    }

    public function getUser($email) : mixed
    {
        $stmt = $this->database->run("SELECT * FROM user WHERE email = ?", [$email]);
        return $stmt->fetch();
    }

    public function checkIfEmailUsed($email) : bool
    {
        $stmt = $this->database->run("SELECT 1 FROM user WHERE email = ?",[$email]);
        return (bool) $stmt->fetchColumn();
    }
}
