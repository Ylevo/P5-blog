<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\PostModel;
use App\Services\PostService;

class AdminDeletePostController extends Controller
{
    public function deletePost()
    {
        (new PostService(new PostModel()))->deletePost((int)$_POST['postId']);
        $this->session->addMessage("Post with the id {$_POST['postId']} successfully deleted.", MessageType::Success);
        exit(header("Location: /admin/posts"));
    }

}
