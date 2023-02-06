<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\AuthService;

class SignupSubmitController extends Controller
{
    public function signupSubmit()
    {
        $auth_service = new AuthService(new UserModel(), $this->session);

        if ($auth_service->signupUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
            header('Location: /');
        }

        $this->render('layouts/signup.html.twig');
    }
}
