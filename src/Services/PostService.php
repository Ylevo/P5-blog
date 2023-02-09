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
        $data['lastPage'] = (int) ceil($this->postModel->getPostsCount() / $postsPerPage);
        $data['currentPage'] = $page > $data['lastPage'] ? $data['lastPage'] : $page;
        $data['posts'] = $this->postModel->getPosts($data['currentPage'], $postsPerPage);

        return $data;
    }

    public function getSinglePost(int $postId)
    {
        return $this->postModel->getPost($postId);
    }
}