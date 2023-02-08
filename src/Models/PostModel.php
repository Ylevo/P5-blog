<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class PostModel extends Model
{
    public function getPosts(int $page, int $postsPerPage) : array
    {
        $offset = $page > 1 ? ($page - 1) * $postsPerPage : 0;
        return $this->database->run(
            'SELECT post_id, title, lede, creation_date, last_modified_date, first_name, last_name 
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
}
