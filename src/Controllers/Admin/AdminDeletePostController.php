<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class AdminDeletePostController extends Controller
{
    public function deletePost()
    {
        (new PostService(new PostModel()))->deletePost((int)$_POST['postId']);
        $this->session->addErrorMessage("Post with the id {$_POST['postId']} successfully deleted.");
        exit(header("Location: /admin/posts"));
    }

}
