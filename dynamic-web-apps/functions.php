<?php

function urlIs($value) {
  return $_SERVER['REQUEST_URI'] === $value;
}

function dd($variable) {
  echo '<pre>';
  var_dump($variable);
  echo '</pre>';
  die();
}