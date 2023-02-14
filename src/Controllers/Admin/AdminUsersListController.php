<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\UserModel;
use App\Services\UserService;

class AdminUsersListController extends Controller
{
    public function usersList(?int $page = 1, int $usersPerPage = 20)
    {
        $usersData = (new UserService(new UserModel()))->getPaginatedUsers($page ?? 1, $usersPerPage);
        $this->render('layouts/admin/admin_users_list.html.twig', [
            'users' => $usersData['users'],
            'roles' => $usersData['roles'],
            'currentPage' => $usersData['currentPage'],
            'lastPage' => $usersData['lastPage']
        ]);
    }

}
