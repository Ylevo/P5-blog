<?php
declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Models\UserModel;

class UserService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getPaginatedUsers(int $page = 1, int $usersPerPage = 5) : array
    {
        $data['lastPage'] = (int) ceil($this->userModel->getUsersCount() / $usersPerPage);
        $data['roles'] = $this->userModel->getUserRoles();
        $data['currentPage'] = $page > $data['lastPage'] ? $data['lastPage'] : $page;
        $offset = $data['currentPage'] > 1 ? ($data['currentPage'] - 1) * $usersPerPage : 0;
        $usersArray = $this->userModel->getUsers($offset, $usersPerPage);
        $data['users'] = array_map(function($user){
            return new User($user);
        }, $usersArray);

        return $data;
    }

    public function deleteUser(int $userId) : void
    {
        $this->userModel->deleteUser($userId);
    }

    public function updateUserRole(int $userId, string $userRole) : void
    {
        $this->userModel->updateUserRole($userId, $userRole);
    }
}
