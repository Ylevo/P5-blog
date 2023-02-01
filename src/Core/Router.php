<?php

namespace App\Core;
use Bramus\Router\Router as BramusRouter;

class Router
{
    private BramusRouter $bramusRouter;

    public function __construct()
    {
        $this->bramusRouter = new BramusRouter();
        $this->addRoutes();
    }

    private function addRoutes() : void // fichier config à faire charger ici plus tard
    {
        $this->bramusRouter->setNamespace('\App\Controllers');
        $this->bramusRouter->get('/', 'HomeController@home');
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }
}