<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Comments;

use App\Core\Controller;
use App\Core\MessageType;
use App\Models\CommentModel;
use App\Services\CommentService;

class AdminValidateCommentsController extends Controller
{
    public function validateComments()
    {
        if (!isset($_POST['comments'])) {
            exit(header("Location: /admin/comments"));
        }

        (new CommentService(new CommentModel(), $this->session))->validateComments($_POST['comments']);
        $this->session->addMessage(sizeof($_POST['comments']) . " comments successfully validated.", MessageType::Success);
        exit(header("Location: /admin/comments"));
    }

}
