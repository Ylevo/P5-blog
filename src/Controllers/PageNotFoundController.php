<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class PageNotFoundController extends Controller
{
    public function notFound() : void
    {
        $this->render('layouts/404.html.twig');
    }
}
