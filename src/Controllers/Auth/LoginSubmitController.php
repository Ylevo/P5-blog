<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\AuthService;

class LoginSubmitController extends Controller
{
    public function loginSubmit()
    {
        $authService = new AuthService(new UserModel(), $this->session);

        if (!isset($_POST['email'], $_POST['password'])) {
            $this->badRequest();
        }

        if ($authService->loginUser($_POST['email'], $_POST['password'])) {
            exit(header("Location: /"));
        }

        $this->render('layouts/login.html.twig');
    }
}
