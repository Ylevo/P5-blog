<?php
declare(strict_types=1);

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\AuthService;

class LogoutController extends Controller
{
    public function logout() : void
    {
        (new AuthService(new UserModel(), $this->session))->logoutUser();

        $this->redirectTo("/");
    }
}
