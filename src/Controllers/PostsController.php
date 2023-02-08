<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class PostsController extends Controller
{
    public function getPosts(int $page = 1, int $postsPerPage = 5) // could define posts per page in config file/admin dashboard later
    {
        $postsData = (new PostService(new PostModel()))->getPaginatedPosts($page, $postsPerPage);
        $this->render('layouts/posts.html.twig', [
            'posts' => $postsData['posts'],
            'lastPage' => $postsData['lastPage']
        ]);
    }

}
