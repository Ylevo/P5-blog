<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function loginUser($email, $password) : bool
    {

    }

    public function signupUser($firstName, $lastName, $email, $password) : bool
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        if (!$this->checkIfEmailUsed($email)) {
            $this->database->run("INSERT INTO user (email, password_hash, first_name, last_name) VALUES (?, ?, ?, ?)", [$email, $password_hash, $firstName, $lastName]);
            return true;
        }
        else {
            return false;
        }
    }

    public function checkIfEmailUsed($email) : bool
    {
        $stmt = $this->database->run("SELECT 1 FROM user WHERE email = ?",[$email]);
        return (bool) $stmt->fetchColumn();
    }
}