<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class UserModel extends Model
{
    public function createUser($firstName, $lastName, $email, $passwordHash) : string|bool
    {
        if ($this->checkIfEmailUsed($email)) {
            return false;
        }

        $this->database->run("INSERT INTO user (email, password_hash, first_name, last_name) 
                                   VALUES (?, ?, ?, ?)",
                                   [$email, $passwordHash, $firstName, $lastName]);

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

    public function getUsers(int $offset, int $usersPerPage) : array
    {
        return $this->database->run(
            'SELECT user_id, email, user_role, first_name, last_name
                 FROM user
                 LIMIT ?, ?
                 ', [$offset, $usersPerPage])->fetchAll();
    }

    public function getUserRoles() : array
    {
        return $this->database->run(
            'SELECT user_role_label as label
                 FROM user_role')->fetchAll();
    }

    public function getUsersCount() : int
    {
        return $this->database->run('SELECT COUNT(*) FROM user')->fetchColumn();
    }

    public function updateUserRole(int $userId, string $role) : void
    {
        $this->database->run('UPDATE user SET user_role = ? WHERE user_id = ?', [$role, $userId]);
    }

    public function deleteUser(int $userId) : void
    {
        $this->database->run('DELETE FROM user WHERE user_id = ?', [$userId]);
    }
}
