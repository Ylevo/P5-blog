<?php

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
}