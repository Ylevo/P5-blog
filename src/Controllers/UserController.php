<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    private UserModel $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function loginForm(): void
    {
        $this->render('layouts/login.html.twig');
    }

    public function signupForm(): void
    {
        $this->render('layouts/signup.html.twig');
    }

    public function loginSubmit()
    {
        $result = $this->userModel->loginUser($_POST['email'], $_POST['password']);
    }
    public function signupSubmit()
    {
        $result = $this->userModel->signupUser($_POST['firstName'], $_POST['lastName'],$_POST['email'], $_POST['password']);
        if (!$result)
        {
            $this->session->addErrorMessage("Email already used.");
            $this->signupForm();
        }
        else{
            header('Location: /');
        }
    }
}