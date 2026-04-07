<?php
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

$uri = $_SERVER['REQUEST_URI'];

$router = new Router();

require basePath('routes.php');

$router->route($uri);
