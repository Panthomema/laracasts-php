<?php

require 'functions.php';
require 'router.php';

/*
require 'Database.php';

$config = require('config.php');

$db = new Database($config['database']);

$id = $_GET['id'];
*/

/* Both are okay
$query = "select * from posts where id = ?";
$post = $db->query($query, [$id])->fetch();
*/

//

/* This way accepts more parameters
$query = "select * from posts where id = :id";
$post = $db->query($query, [':id' => $id])->fetch();

dd($post);
*/

/*
foreach ($posts as $post) {
  echo '<ul>';
  foreach ($post as $key => $value) {
    echo "<li>{$key}: $value</li>";
  }
  echo '</ul>';
}
*/
