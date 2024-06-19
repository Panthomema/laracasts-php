<?php

use \Core\Session;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';

require BASE_PATH . 'Core/functions.php';

session_start();

// can't use base_path() over here, its created in functions.php

require base_path('bootstrap.php');

$router = new \Core\Router(); // Initialize??

$routes = require base_path('routes.php');
// parses url to get the path
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
  $router->route($uri, $method);
} catch (\Core\ValidationException $exception) {
  Session::flash('errors', $exception->errors);
  Session::flash('old', $exception->old);

  return redirect($router->previousUrl());
}

Session::unflash();