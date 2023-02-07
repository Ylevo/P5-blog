<?php
declare(strict_types=1);

namespace App\Core;
use Bramus\Router\Router as BramusRouter;
use App\Controllers;

class Router
{
    private BramusRouter $bramusRouter;
    private Session $session;

    public function __construct()
    {
        $this->bramusRouter = new BramusRouter();
        $this->session = new Session();
        $this->addRoutes();
    }

    private function addRoutes() : void
    {
        $parsedRouting = yaml_parse_file(__DIR__ . '/../../config/routes.yml');
        $this->bramusRouter->setNamespace($parsedRouting['namespace']);
        foreach ($parsedRouting['routes'] as $route) {
            $this->bramusRouter->match($route['method'], $route['pattern'], $route['controller']);
        }
        $this->bramusRouter->before('GET|POST', '/(login|signup)', function() {
            if ($this->session->get(('userId'))) {
                header("Location: /");
            }
        });
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }
}