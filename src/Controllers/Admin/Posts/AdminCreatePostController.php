<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\PostModel;
use App\Services\PostService;

class AdminCreatePostController extends Controller
{
    public function createPost() : void
    {
        (new PostService(new PostModel()))->createPost($_POST);
        $this->session->addMessage("New post with the title '{$_POST['title']}' created.", MessageType::Success);

        header("Location: /admin/posts");
        exit();
    }
}
