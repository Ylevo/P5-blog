<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class CommentModel extends Model
{
    public function getComments(int $postId) : array
    {
        return $this->database->run(
            'SELECT comment_id, post_id, comment.user_id, content, creation_date, validated, CONCAT(first_name, " ", last_name) as author_name
                 FROM comment
                 INNER JOIN user ON comment.user_id = user.user_id
                 WHERE post_id = ?
                 ORDER BY creation_date DESC
                 ', [$postId])->fetchAll();
    }

    public function createComment(int $postId, int $userId, string $content, string $creationDate, bool $validated) : void
    {
        $this->database->run("INSERT INTO comment (post_id, user_id, content, creation_date, validated) 
                                     VALUES (?, ?, ?, ?, ?)",
                                     [$postId, $userId, $content, $creationDate, $validated]);
    }

    public function getUnvalidatedCommentsCount() : int
    {
        return $this->database->run('SELECT COUNT(*) FROM comment WHERE validated = 0')->fetchColumn();
    }

    public function getUnvalidatedComments(int $offset, int $commentsPerPage) : array
    {
        return $this->database->run(
            'SELECT comment_id, post_id, comment.user_id, content, creation_date, CONCAT(first_name, " ", last_name) as author_name
                 FROM comment
                 INNER JOIN user ON comment.user_id = user.user_id
                 WHERE comment.validated = 0
                 ORDER BY creation_date DESC
                 LIMIT ?, ?
                 ', [$offset, $commentsPerPage])->fetchAll();
    }

    public function validateComments(array $comments) : void
    {
        $this->database->runTransaction("UPDATE comment SET validated = 1 WHERE comment_id = ?", $comments);
    }

    public function deleteComments(array $comments) : void
    {
        $this->database->runTransaction("DELETE FROM comment WHERE comment_id = ?", $comments);
    }
}
