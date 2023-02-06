<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;

class LoginFormController extends Controller
{
    public function loginForm(): void
    {
        $this->render('layouts/login.html.twig');
    }
}
