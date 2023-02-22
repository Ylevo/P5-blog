<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Comments;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Services\CommentService;

class AdminCommentsListController extends Controller
{
    public function getComments(?int $page = 1, int $commentsPerPage = 15) : void
    {
        $comments = (new CommentService(new CommentModel(), $this->session))->getPaginatedUnvalidatedComments($page ?? 1, $commentsPerPage);
        $this->render('layouts/admin/admin_comments_list.html.twig', [
            'comments' => $comments['comments'],
            'currentPage' => $comments['currentPage'],
            'lastPage' => $comments['lastPage']
        ]);
    }

    public function getCommentsFromPagination()
    {
        $this->getComments($this->getPaginationPage());
    }

}
