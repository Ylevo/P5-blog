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

    public function addComment(int $postId, int $userId, string $content, string $creationDate, bool $validated)
    {
        $this->database->run("INSERT INTO comment (post_id, user_id, content, creation_date, validated) 
                                     VALUES (?, ?, ?, ?, ?)",
                                     [$postId, $userId, $content, $creationDate, $validated]);
    }
}