<?php

session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

// can't use base_path() over here, its created in functions.php

spl_autoload_register(function($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  require base_path("{$class}.php");
});

view('bootstrap.php');

$router = new \Core\Router(); // Initialize??

$routes = require base_path('routes.php');
// parses url to get the path
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);