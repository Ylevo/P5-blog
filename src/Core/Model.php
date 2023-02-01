<?php

namespace App\Core;


abstract class Model
{
    protected Database $db;

    public function __construct()
    {
       $this->db = new Database('blog', 'root'); //fichier config à faire charger ici plus tard
    }
}