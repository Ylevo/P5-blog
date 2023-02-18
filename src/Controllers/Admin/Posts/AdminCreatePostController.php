<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class AdminCreatePostController extends Controller
{
    public function createPost()
    {
        (new PostService(new PostModel()))->createPost($_POST);
        $this->session->addErrorMessage("New post with the title '{$_POST['title']}' created.");
        exit(header("Location: /admin/posts"));
    }

}
