<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Comments;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\CommentModel;
use App\Services\CommentService;

class AdminDeleteCommentsController extends Controller
{
    public function deleteComments()
    {
        if (!isset($_POST['comments'])) {
            exit(header("Location: /admin/comments"));
        }

        (new CommentService(new CommentModel(), $this->session))->deleteComments($_POST['comments']);
        $this->session->addMessage(sizeof($_POST['comments']) . " comments successfully deleted.", MessageType::Success);
        exit(header("Location: /admin/comments"));
    }

}
