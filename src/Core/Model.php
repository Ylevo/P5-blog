<?php
declare(strict_types=1);

namespace App\Core;


abstract class Model
{
    protected Database $database;

    public function __construct()
    {
       $this->database = new Database('blog', 'root'); // fichier config à faire charger ici plus tard
    }
}