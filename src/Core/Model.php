<?php

namespace App\Core;


abstract class Model
{
    protected Database $database;
    protected Session $session;

    public function __construct()
    {
       $this->database = new Database('blog', 'root'); // fichier config à faire charger ici plus tard
       $this->session = new Session();

    }
}