<?php

namespace Core;

class Authenticator
{
  public function attempt($email, $password)
  {
    // Check if the credentials match
    $user = App::resolve(Database::class)
      ->query('select * from users where email = :email', [
        'email' => $email
      ])->find();

    if ($user) {
      // perform the login
      if (password_verify($password, $user['password'])) {
        $this->login([
          'email' => $email
        ]);
        
        return true;
      }
    }

    return false;
  }

  // login
  public function login($user)
  {
    $_SESSION['user'] = [
      'email' => $user['email']
    ];

    session_regenerate_id(true);
  }

  //logout
  public function logout()
  {
    Session::destroy();
  }
}