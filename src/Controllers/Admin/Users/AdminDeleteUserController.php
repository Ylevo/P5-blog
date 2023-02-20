<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Users;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\UserModel;
use App\Services\UserService;

class AdminDeleteUserController extends Controller
{
    public function deleteUser()
    {
        (new UserService(new UserModel()))->deleteUser((int)$_POST['userId']);
        $this->session->addMessage("User with the id {$_POST['userId']} successfully deleted.", MessageType::Success);
        exit(header("Location: /admin/users"));
    }

}
