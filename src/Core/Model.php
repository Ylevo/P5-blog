<?php
declare(strict_types=1);

namespace App\Core;

abstract class Model
{
    protected Database $database;

    public function __construct()
    {
       $config =  yaml_parse_file(__DIR__ . '/../../config/dbConfig.yml');
       $this->database = new Database($config['database'], $config['username']);
    }
}