<?php

$routes = require('routes.php');

// checks if route exists in the app and requires the controller, reference stored in the array
function routeToController($uri, $routes) {
  if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
  } else {
    abort(); // if we don't have the route
  }
}

// responds with status code 
function abort($code = Response::NOT_FOUND) {
  http_response_code($code);
  require "views/{$code}.php";
  die();
}

// parses url to get the path
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);