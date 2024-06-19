<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];
$db = App::resolve(Database::class);

// Validate the form input
$errors = [];
if (! Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address';
}

if (! Validator::string($password, 7, 255)) {
  $errors['password'] = 'Please provide a password between 7-255 characters';
}

if (! empty($errors)) {
  return view('registration/create.view.php', [
    'errors' => $errors
  ]);
}

// Check if the account already exists
$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

// If exists, redirect to a login
if ($user) redirect('/');

// If doesn't, create it, log in and redirect
$db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
  'email' => $email,
  'password' => password_hash($password, PASSWORD_BCRYPT)
]);

// Mark the user has logged in
login([
  'email' => $email
]);

// Redirect to wherever (home, dashboard...)
redirect('/');


  