<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\PostModel;

class PostService
{
    private PostModel $postModel;

    public function __construct(PostModel $postModel)
    {
        $this->postModel = $postModel;
    }

    public function getPaginatedPosts(int $page = 1, int $postsPerPage = 5) : array
    {
        $data['posts'] = $this->postModel->getPosts($page, $postsPerPage);
        $data['lastPage'] = ceil($this->postModel->getPostsCount() / $postsPerPage);

        return $data;
    }
}