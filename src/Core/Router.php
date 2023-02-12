<?php
declare(strict_types=1);

namespace App\Core;
use App\Models\UserModel;
use App\Services\AuthService;
use Bramus\Router\Router as BramusRouter;

class Router
{
    private BramusRouter $bramusRouter;
    private Session $session;
    private AuthService $authService;

    public function __construct()
    {
        $this->bramusRouter = new BramusRouter();
        $this->session = new Session();
        $this->authService = new AuthService(new UserModel(), $this->session);
        $this->addRoutes();
    }

    private function addRoutes() : void
    {
        $parsedRouting = yaml_parse_file(__DIR__ . '/../../config/routes.yml');
        $this->bramusRouter->setNamespace($parsedRouting['namespace']);
        foreach ($parsedRouting['routes'] as $route) {
            $this->bramusRouter->match($route['method'], $route['pattern'], $route['controller']);
        }
        foreach ($parsedRouting['middlewares'] as $middleware) {
            $this->bramusRouter->before($middleware['method'], $middleware['pattern'], [$this, $middleware['callback']]);
        }
    }

    public function checkIfLoggedIn()
    {
        if ($this->authService->isLoggedIn()) {
            exit(header("Location: /"));
        }
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }


}