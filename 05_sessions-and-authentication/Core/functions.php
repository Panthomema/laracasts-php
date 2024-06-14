<?php

use Core\Response;

// Checks if an url matches
function urlIs($value) 
{
  return $_SERVER['REQUEST_URI'] === $value;
}

// dd laravel function
function dd($variable) 
{
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
  die();
}

function abort($code = Response::NOT_FOUND) 
{
  http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

// authorization function
function authorize($condition, $status = Response::FORBIDDEN) 
{
  if (! $condition) {
    abort($status);
  }
}

// route normalization
function base_path($path) 
{
  return BASE_PATH . $path;
}

// call a view route
function view($path, $attributes = []) 
{
  extract($attributes);
  
  require base_path("views/{$path}");
}

// login
function login($user)
{
  $_SESSION['user'] = [
    'email' => $user['email']
  ];

  session_regenerate_id(true);
}

//logout
function logout()
{
  $_SESSION = [];
  session_destroy();

  $params = session_get_cookie_params();
  // just set the time sometime in the past
  setcookie(
    'PHPSESSID',
    '', 
    time() - 3600,
    $params['path'], 
    $params['domain'],
    $params['secure'],
    $params['httponly']
  ); 
}