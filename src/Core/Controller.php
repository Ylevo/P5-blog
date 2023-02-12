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

    public function badRequest()
    {
        $this->session->addErrorMessage("You must be logged in to post a comment.");
        exit(header("Location: /"));
    }
}