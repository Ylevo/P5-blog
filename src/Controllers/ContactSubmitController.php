<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\CommentService;
use App\Services\MailerService;
use App\Services\PostService;

class ContactSubmitController extends Controller
{
    public function contactSubmit() : void
    {
        if (!isset($_POST['name'], $_POST['email'], $_POST['message'])) {
            $this->badRequest();
        }

        (new MailerService($this->session))->sendEmail($_POST);

        $this->render('layouts/contact.html.twig');
    }
}
