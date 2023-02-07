<?php
declare(strict_types=1);

namespace App\Controllers\Auth;


use App\Core\Controller;

class SignupFormController extends Controller
{
    public function signupForm(): void
    {
        $this->render('layouts/signup.html.twig');
    }
}
