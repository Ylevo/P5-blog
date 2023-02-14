<?php

namespace App\Controllers;

use App\Core\Controller;

class PageNotFoundController extends Controller
{
    public function notFound()
    {
        $this->render('layouts/404.html.twig');
    }
}