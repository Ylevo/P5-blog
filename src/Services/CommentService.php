<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\MessageType;
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
            $this->session->addMessage("You must be logged in to post a comment.", MessageType::Error);
        }
    }

    public function getPaginatedUnvalidatedComments(int $page = 1, int $commentsPerPage = 15) : array
    {
        $data['lastPage'] = (int) ceil($this->commentModel->getUnvalidatedCommentsCount() / $commentsPerPage);
        $data['currentPage'] = min($page, $data['lastPage']);
        $offset = $data['currentPage'] > 1 ? ($data['currentPage'] - 1) * $commentsPerPage : 0;
        $data['comments'] =  array_map(function($comment){
            return new Comment($comment);
        }, $this->commentModel->getUnvalidatedComments($offset, $commentsPerPage));

        return $data;
    }

    public function validateComments(array $commentsIds) : void
    {
        $this->commentModel->validateComments($commentsIds);

    }

    public function deleteComments(array $commentsIds) : void
    {
        $this->commentModel->deleteComments($commentsIds);
    }
}