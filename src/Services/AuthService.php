<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\Session;
use App\Models\UserModel;

class AuthService
{
    private UserModel $user_model;
    private Session $session;

    public function __construct(UserModel $user_model, Session $session)
    {
        $this->user_model = $user_model;
        $this->session = $session;
    }

    public function signupUser(string $first_name, string $last_name, string $email, string $password) : bool
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user = $this->user_model->createUser($first_name, $last_name, $email, $password_hash);

        if ($user) {
            $this->session->set(('user_id'), $user);
            $this->session->set(('user_role'), 'Member');
        } else {
            $this->session->addErrorMessage('Email already used.');
        }

        return (bool) $user;
    }

    public function loginUser() : bool
    {
        $user = $this->user_model->getUser($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password_hash'])) {
            $this->session->set(('user_id'), $user['user_id']);
            $this->session->set(('user_role'), $user['user_role']);
        } else {
            $this->session->addErrorMessage('Invalid credentials.');
            $user = false;
        }

        return (bool) $user;
    }

    public function logoutUser()
    {
        $this->session->remove('user_id');
        $this->session->remove('user_role');
    }
}
