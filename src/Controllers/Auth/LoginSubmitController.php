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
        $auth_service = new AuthService(new UserModel(), $this->session);

        if ($auth_service->loginUser()) {
            header("Location: /");
        }

        $this->render('layouts/login.html.twig');
    }
}
