<?php
declare(strict_types=1);

namespace App\Core;
use Bramus\Router\Router as BramusRouter;

class Router
{
    private BramusRouter $bramusRouter;
    private Session $session;

    public function __construct()
    {
        $this->bramusRouter = new BramusRouter();
        $this->session = new Session();
        $this->generateCSRFToken();
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
        $this->bramusRouter->set404($parsedRouting['404']);
    }

    public function checkIfLoggedIn() : void
    {
        if ($this->session->isLoggedIn()) {
            header("Location: /");
            exit();
        }
    }

    public function checkIfAdmin() : void
    {
        if (!$this->session->isUserAdmin()) {
            $this->session->addMessage("Error : Unauthorized access.", MessageType::Error);
            header("Location: /");
            exit();
        }
    }

    public function generateCSRFToken() : void
    {
        if (empty($_SESSION['CSRFToken'])) {
            $_SESSION['CSRFToken'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }

    public function checkCSRFToken() : void
    {
        if (!empty($_POST['CSRFToken']) && !hash_equals($_SESSION['CSRFToken'], $_POST['CSRFToken'])) {
            $this->session->addMessage("Error : Invalid CSRF token.", MessageType::Error);
            header("Location: /");
            exit();
        }
    }

    public function run() : void
    {
        $this->bramusRouter->run();
    }
}
