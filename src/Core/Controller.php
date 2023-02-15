<?php
declare(strict_types=1);

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected Environment $twig;
    protected Session $session;

    public function __construct()
    {
        $this->session = new Session();
        $this->twig = new Environment(new FilesystemLoader('templates', getcwd().'/../'));
        $this->twig->addGlobal('session', $this->session);
    }

    public function render($template, $params = []): void
    {
        echo $this->twig->render($template, $params);
    }

    public function badRequest() : void
    {
        $this->session->addErrorMessage("Error 400 : bad request.");
        exit(header("Location: /"));
    }

    public function getPaginationPage() : int
    {
        if (!isset($_POST['pageNumber'])) {
            $this->badRequest();
        }

        return (int) empty($_POST['pageNumber'][0]) ? $_POST['pageNumber'][1] : $_POST['pageNumber'][0];
    }
}