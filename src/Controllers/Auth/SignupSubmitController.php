<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\AuthService;

class SignupSubmitController extends Controller
{
    public function signupSubmit() : void
    {
        $authService = new AuthService(new UserModel(), $this->session);

        if (!isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'])) {
            $this->badRequest();
        }

        if ($authService->signupUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'])) {
            $this->redirectTo("/");
        }

        $this->render('layouts/signup.html.twig');
    }
}
