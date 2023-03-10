<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class AdminPostFormController extends Controller
{
    public function newPostForm() : void
    {
        $this->render('layouts/admin/admin_post_form.html.twig', [
            'postActionTitle' => "New Post",
            'postAction' => "/admin/posts/new"
        ]);
    }

    public function updatePostForm(int $postId) : void
    {
        $post = (new PostService(new PostModel()))->getSinglePost($postId);

        $this->render('layouts/admin/admin_post_form.html.twig', [
            'postActionTitle' => "Edit Post",
            'postAction' => "/admin/posts/edit",
            'post' => $post
        ]);
    }
}
