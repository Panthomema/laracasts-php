<?php

require 'Validator.php';

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Create Note';

$userId = 3; // hard coded

// form sends data to the same page, so we check for this to handle the data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];

  // validation with validator class
  if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1000 characters is required';
  }

  // query with own Database class
  if (empty($errors)) {
    $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
      'body' => $_POST['body'],
      'user_id' => $userId
    ]);
  }  
}

require 'views/note-create.view.php';