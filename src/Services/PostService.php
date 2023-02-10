<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\PostModel;
use App\Entities\Post;

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
        $postsArray = $this->postModel->getPosts($data['currentPage'], $postsPerPage);
        $data['posts'] = array_map(function($post){
            return new Post($post);
        }, $postsArray);

        return $data;
    }

    public function getSinglePost(int $postId) : Post
    {
        return new Post($this->postModel->getPost($postId));
    }
}