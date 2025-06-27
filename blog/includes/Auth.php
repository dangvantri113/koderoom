<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Session.php';
require_once __DIR__ . '/Models/User.php';

class Auth
{
  public static function login($email, $password)
  {  
    Session::start();
    $user = User::findByEmail($email);
    if ($user && password_verify($password, $user->password)) {
      Session::set('user_id', $user->id);
      Session::set('user_name', $user->name);
      Session::set('user_email', $user->email);
      Session::writeClose();
      return true;
    } else {
      return false;
    }
  }

  public static function logout()
  {
    Session::start();
    Session::destroy();
  }
};
