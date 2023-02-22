<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class PostsController extends Controller
{
    public function getPosts(?int $page = 1, int $postsPerPage = 5) : void
    {
        $postsData = (new PostService(new PostModel()))->getPaginatedPosts($page ?? 1, $postsPerPage);
        $this->render('layouts/posts.html.twig', [
            'posts' => $postsData['posts'],
            'currentPage' => $postsData['currentPage'],
            'lastPage' => $postsData['lastPage']
        ]);
    }

    public function getPostsFromPagination() : void
    {
        $this->getPosts($this->getPaginationPage());
    }

}
