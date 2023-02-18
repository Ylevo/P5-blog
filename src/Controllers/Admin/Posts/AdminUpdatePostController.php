<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class AdminUpdatePostController extends Controller
{
    public function updatePost()
    {
        (new PostService(new PostModel()))->updatePost($_POST);
        $this->session->addErrorMessage("Updated post with the title '{$_POST['title']}'.");
        exit(header("Location: /admin/posts"));
    }

}
