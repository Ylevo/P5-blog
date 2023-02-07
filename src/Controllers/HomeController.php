<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $this->render('layouts/home.html.twig');
    }

}
