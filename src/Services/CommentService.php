<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\Session;
use App\Entities\Comment;
use App\Models\CommentModel;

class CommentService
{
    private CommentModel $commentModel;
    private Session $session;

    public function __construct(CommentModel $commentModel, Session $session)
    {
        $this->commentModel = $commentModel;
        $this->session = $session;
    }
    
    public function getComments(int $postId) : array
    {
        return array_map(function($comment){
            return new Comment($comment);
        }, $this->commentModel->getComments($postId));
    }

    public function createComment(int $postId, string $commentContent) : void
    {
        if ($this->session->get('userId')) {
            $this->commentModel->createComment(
                $postId,
                $this->session->get('userId'),
                $commentContent,
                date('Y-m-d H:i:s'),
                $this->session->get('userRole') == 'Admin');
        } else {
            $this->session->addErrorMessage("You must be logged in to post a comment.");
        }
    }
}