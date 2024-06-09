<?php

// Checks if an url matches
function urlIs($value) {
  return $_SERVER['REQUEST_URI'] === $value;
}

// dd laravel function
function dd($variable) {
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
  die();
}

// authorization function
function authorize($condition, $status = Response::FORBIDDEN) {
  if (! $condition) {
    abort($status);
  }
}