<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\CommentService;
use App\Services\PostService;

class AboutController extends Controller
{
    public function tellAboutMe() : void
    {
        $this->render('layouts/about.html.twig');
    }
}
