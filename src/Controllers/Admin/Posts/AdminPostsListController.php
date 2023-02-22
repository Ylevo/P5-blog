<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Posts;

use App\Core\Controller;
use App\Models\PostModel;
use App\Services\PostService;

class AdminPostsListController extends Controller
{
    public function getPosts(?int $page = 1, int $postsPerPage = 20) : void
    {
        $postsData = (new PostService(new PostModel()))->getPaginatedPosts($page ?? 1, $postsPerPage);
        $this->render('layouts/admin/admin_posts_list.html.twig', [
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
