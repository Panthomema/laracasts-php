<?php

$greeting = "Hello";
$user = "Juanito";
$name = "Dark Matter";
$read = true;

if ($read) {
  $message = "You have read \"$name\"";
} else {
  $message = "You have not read \"$name\"";
}

$books = [
  [
    'name' => 'Do Androids Dream of Electric Sheep',
    'author' => 'Philip K. Dick',
    'releaseYear' => 1968,
    'purchaseUrl' => 'https://example.com'
  ],
  [
    'name' => 'Project Hail Mary',
    'author' => 'Andy Weir',
    'releaseYear' => 2021,
    'purchaseUrl' => 'https://example.com'
  ],
  [
    'name' => 'The Martian',
    'author' => 'Andy Weir',
    'releaseYear' => 2011,
    'purchaseUrl' => 'https://example.com'
  ]
];

$filteredBooks = array_filter($books, function ($book) {
  return $book['author'] === 'Andy Weir';
});

require "index.view.php";

