<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\PostModel;
use App\Services\PostService;

class AdminUpdatePostController extends Controller
{
    public function updatePost() : void
    {
        (new PostService(new PostModel()))->updatePost($_POST);
        $this->session->addMessage("Updated post with the title '{$_POST['title']}'.", MessageType::Success);

        header("Location: /admin/posts");
        exit();
    }

}
