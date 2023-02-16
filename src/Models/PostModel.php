<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class PostModel extends Model
{
    public function getPosts(int $offset, int $postsPerPage) : array
    {
        return $this->database->run(
            'SELECT post_id, title, lede, creation_date, last_modified_date, CONCAT(first_name, " ", last_name) as author_name
                 FROM post
                 INNER JOIN user ON post.user_id = user.user_id
                 ORDER BY creation_date DESC
                 LIMIT ?, ?
                 ', [$offset, $postsPerPage])->fetchAll();
    }

    public function getPostsCount() : int
    {
        return $this->database->run('SELECT COUNT(*) FROM post')->fetchColumn();
    }

    public function getPost(int $pageId) : mixed
    {
        return $this->database->run(
            'SELECT post_id, title, lede, content, creation_date, last_modified_date, CONCAT(first_name, " ", last_name) as author_name
                 FROM post
                 INNER JOIN user ON post.user_id = user.user_id
                 WHERE post_id = ?
                 ', [$pageId])->fetch();
    }

    public function createPost(int $userId,
                               string $title,
                               string $lede,
                               string $content,
                               string $creationDate) : void
    {
        $this->database->run("INSERT INTO post (user_id, title, lede, content, creation_date, last_modified_date) 
                                   VALUES (?, ?, ?, ?, ?, ?)",
                                    [$userId, $title, $lede, $content, $creationDate, $creationDate]);
    }

    public function updatePost(int $postId,
                               string $title,
                               string $lede,
                               string $content,
                               string $lastModifiedDate) : void
    {
        $this->database->run('UPDATE post 
                                    SET title = ?,
                                        lede = ?,
                                        content = ?,
                                        last_modified_date = ?
                                    WHERE post_id = ?',
                                    [$title, $lede, $content, $lastModifiedDate, $postId]);
    }

    public function deletePost(int $postId) : void
    {
        $this->database->run('DELETE FROM post WHERE post_id = ?', [$postId]);
    }
}
