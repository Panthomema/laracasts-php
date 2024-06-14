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

if (! Validator::string($password)) {
  $errors['password'] = 'Please provide a valid password';
}

if (! empty($errors)) {
  return view('session/create.view.php', [
    'errors' => $errors
  ]);
}

// Check if the credentials match
$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

if ($user) {
  // perform the login
  if (password_verify($password, $user['password'])) {
    login([
      'email' => $email
    ]);

    header('location: /');
    exit();
  }
}

// return password error
return view('session/create.view.php', [
  'errors' => [
    'password' => 'No matching account found for that email address and password'
  ]
]);


