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
        $this->bramusRouter->get('/login', 'UserController@loginForm');
        $this->bramusRouter->post('/login', 'UserController@loginSubmit');
        $this->bramusRouter->get('/signup', 'UserController@signupForm');
        $this->bramusRouter->post('/signup', 'UserController@signupSubmit');
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }
}