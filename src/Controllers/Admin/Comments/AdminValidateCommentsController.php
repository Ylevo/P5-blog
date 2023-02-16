<?php
declare(strict_types=1);

namespace App\Controllers\Admin\Comments;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Services\CommentService;

class AdminValidateCommentsController extends Controller
{
    public function validateComments()
    {
        if (!isset($_POST['comments'])) {
            $this->session->addErrorMessage("Nothing happened.");
            exit(header("Location: /admin/comments"));
        }

        (new CommentService(new CommentModel(), $this->session))->validateComments($_POST['comments']);
        $this->session->addErrorMessage(sizeof($_POST['comments']) . " comments successfully validated.");
        exit(header("Location: /admin/comments"));
    }

}
