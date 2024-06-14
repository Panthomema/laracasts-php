<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 3;

// find the corresponding resource
$note = $db->query('select * from notes where id = :id', [
  'id' => $_POST['id']
])->findOrFail();

// check if the current user can edit the note
authorize($note['user_id'] === $currentUserId);

// validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of no more than 1000 characters is required';
}

// if no validation errors, update the record in the database table
if (count($errors)) {
  return view('notes/edit.view.php', [
    'heading' => 'Edit Note',
    'errors' => $errors,
    'note' => $note
  ]);
}

// query with own Database class
if (empty($errors)) {
  $db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
  ]);
}

// redirect the user
header('location: /notes');
die();