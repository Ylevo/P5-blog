<?php
declare(strict_types=1);

namespace App\Core;
use Bramus\Router\Router as BramusRouter;
use App\Controllers;

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
        $this->bramusRouter->get('/login', 'Auth\LoginFormController@loginForm');
        $this->bramusRouter->post('/login', 'Auth\LoginSubmitController@loginSubmit');
        $this->bramusRouter->get('/logout', 'Auth\LogoutController@logout');
        $this->bramusRouter->get('/signup', 'Auth\SignupFormController@signupForm');
        $this->bramusRouter->post('/signup', 'Auth\SignupSubmitController@signupSubmit');
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }

    public function test() : void
    {
        echo "lol";
    }
}