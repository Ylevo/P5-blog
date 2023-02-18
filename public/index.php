<?php
require '../vendor/autoload.php';
session_start();

use App\Core\Router;

try {
    (new Router())->run();
} catch (Exception $ex) {
    echo "Error 500: something went wrong.";
    // add logging here
}
