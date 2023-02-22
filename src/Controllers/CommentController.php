<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\CommentService;
use App\Services\PostService;

class CommentController extends Controller
{
    public function addComment() : void
    {
        if (!isset($_POST['postId'], $_POST['commentContent']) || empty($_POST['commentContent'])) {
            $this->badRequest();
        }

        $postId = (int)$_POST['postId'];
        $commentService = new CommentService(new CommentModel(), $this->session);
        $commentService->createComment($postId, $_POST['commentContent']);
        $postData = (new PostService(new PostModel()))->getSinglePost($postId);
        $commentsData = $commentService->getComments($postId);

        $this->render('layouts/post.html.twig', [
            'post' => $postData,
            'comments' => $commentsData
        ]);

    }

}