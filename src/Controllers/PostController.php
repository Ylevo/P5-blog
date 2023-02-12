<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\CommentService;
use App\Services\PostService;

class PostController extends Controller
{
    public function getPost(int $postId)
    {
        $postData = (new PostService(new PostModel()))->getSinglePost($postId);
        $commentsData = (new CommentService(new CommentModel(), $this->session))->getComments($postId);
        $this->render('layouts/post.html.twig', [
            'post' => $postData,
            'comments' => $commentsData
        ]);
    }
}
