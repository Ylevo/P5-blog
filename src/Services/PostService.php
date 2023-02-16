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
        $data['lastPage'] = (int)ceil($this->postModel->getPostsCount() / $postsPerPage);
        $data['currentPage'] = $page > $data['lastPage'] ? $data['lastPage'] : $page;
        $offset = $data['currentPage'] > 1 ? ($data['currentPage'] - 1) * $postsPerPage : 0;
        $postsArray = $this->postModel->getPosts($offset, $postsPerPage);
        $data['posts'] = array_map(function($post){
            return new Post($post);
        }, $postsArray);

        return $data;
    }

    public function getSinglePost(int $postId) : Post
    {
        $postData = $this->postModel->getPost($postId);

        return $postData ? new Post($postData) : exit(header("Location: /404"));
    }

    public function createPost(array $postData) : void
    {
        $newPost = new Post($postData);
        $this->postModel->createPost(
            $newPost->getUserId(),
            $newPost->getTitle(),
            $newPost->getLede(),
            $newPost->getContent(),
            date('Y-m-d H:i:s'));
    }

    public function updatePost(array $postData) : void
    {
        $updatedPost = new Post($postData);
        $this->postModel->updatePost(
            $updatedPost->getPostId(),
            $updatedPost->getTitle(),
            $updatedPost->getLede(),
            $updatedPost->getContent(),
            date('Y-m-d H:i:s'));
    }

    public function deletePost(int $postId) : void
    {
        $this->postModel->deletePost($postId);
    }
}
