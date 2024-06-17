<?php

use Core\Authenticator;

// Validate the form input

$form = \Http\Forms\LoginForm::validate($attributes = [
  'email' => $_POST['email'],
  'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
  $attributes['email'], 
  $attributes['password']
);

if (! $signedIn) {
  $form->error(
    'password', 
    'No matching account found for that email address and password'
  )->throw();
}

redirect('/');





