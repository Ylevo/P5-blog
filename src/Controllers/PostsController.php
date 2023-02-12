<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class PostsController extends Controller
{
    public function getPosts(?int $page = 1, int $postsPerPage = 5) // could define posts per page in config file/admin dashboard later
    {
        $postsData = (new PostService(new PostModel()))->getPaginatedPosts($page ?? 1, $postsPerPage);
        $this->render('layouts/posts.html.twig', [
            'posts' => $postsData['posts'],
            'currentPage' => $postsData['currentPage'],
            'lastPage' => $postsData['lastPage']
        ]);
    }

    public function getPostsFromPagination()
    {
        if (!isset($_POST['pageNumber'])) {
            $this->badRequest();
        }

        $pageNumber = empty($_POST['pageNumber'][0]) ? $_POST['pageNumber'][1] : $_POST['pageNumber'][0];
        $this->getPosts((int)$pageNumber);
    }

}
