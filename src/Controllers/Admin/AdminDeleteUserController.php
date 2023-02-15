<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\UserService;

class AdminDeleteUserController extends Controller
{
    public function deleteUser()
    {
        (new UserService(new UserModel()))->deleteUser((int)$_POST['userId']);
        $this->session->addErrorMessage("User with the id {$_POST['userId']} successfully deleted.");
        exit(header("Location: /admin/users"));
    }

}
