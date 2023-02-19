<?php
require '../vendor/autoload.php';
session_start();

use App\Core\Router;

(new Router())->run();
