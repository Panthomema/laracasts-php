<?php

// parses url to get the path
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// routes we have in our app
$routes = [
  '/' => 'controllers/index.php',
  '/about' => 'controllers/about.php',
  '/contact' => 'controllers/contact.php'
];

// checks if route exists in the app and requires the controller, reference stored in the array
function routeToController($uri, $routes) {
  if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
  } else {
    abort(); // if we don't have the route
  }
}

// returns status code 
function abort($code = 404) {
  http_response_code($code);
  require "views/{$code}.php";
  die();
}

routeToController($uri, $routes);