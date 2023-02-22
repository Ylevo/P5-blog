<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Comments;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\CommentModel;
use App\Services\CommentService;

class AdminDeleteCommentsController extends Controller
{
    public function deleteComments() : void
    {
        if (!isset($_POST['comments'])) {
            header("Location: /admin/comments");
            exit();
        }

        (new CommentService(new CommentModel(), $this->session))->deleteComments($_POST['comments']);
        $this->session->addMessage(sizeof($_POST['comments']) . " comments successfully deleted.", MessageType::Success);

        header("Location: /admin/comments");
        exit();
    }

}
