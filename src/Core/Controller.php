<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('templates', getcwd().'/../');
        $this->twig = new Environment($loader);
    }

    public function render($template, $params = []): void
    {
        echo $this->twig->render($template, $params);
    }
}