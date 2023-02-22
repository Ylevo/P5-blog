<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Users;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\UserModel;
use App\Services\UserService;

class AdminUpdateUserController extends Controller
{
    public function updateUserRole() : void
    {
        (new UserService(new UserModel()))->updateUserRole((int)$_POST['userId'], $_POST['userRole']);
        $this->session->addMessage("User with the id {$_POST['userId']} now has the {$_POST['userRole']} role", MessageType::Success);

        header("Location: /admin/users");
        exit();
    }
}
