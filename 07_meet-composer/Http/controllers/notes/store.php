<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$userId = 3;
$errors = [];

// validation with validator class
if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of no more than 1000 characters is required';
}

if (! empty($errors)) {
  view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

// query with own Database class
if (empty($errors)) {
  $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => $userId
  ]);

  redirect('/notes');
}


