<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\Session;
use App\Models\UserModel;

class AuthService
{
    private UserModel $userModel;
    private Session $session;

    public function __construct(UserModel $userModel, Session $session)
    {
        $this->userModel = $userModel;
        $this->session = $session;
    }

    public function signupUser(string $firstName, string $lastName, string $email, string $password) : bool
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $user = $this->userModel->createUser($firstName, $lastName, $email, $passwordHash);

        if ($user) {
            $this->session->set(('userId'), $user);
            $this->session->set(('userRole'), 'Member');
        } else {
            $this->session->addErrorMessage('Email already used.');
        }

        return (bool) $user;
    }

    public function loginUser(string $email, string $password) : bool
    {
        $user = $this->userModel->getUser($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            $this->session->set(('userId'), $user['user_id']);
            $this->session->set(('userRole'), $user['user_role']);
        } else {
            $this->session->addErrorMessage('Invalid credentials.');
            $user = false;
        }

        return (bool) $user;
    }

    public function logoutUser()
    {
        $this->session->destroySession();
    }
}
