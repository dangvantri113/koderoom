<?php

class Session
{
  public static function start()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public static function get($key)
  {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
  }

  public static function delete($key)
  {
    unset($_SESSION[$key]);
  }

  public static function exists($key)
  {
    return isset($_SESSION[$key]);
  }

  public static function destroy()
  {
    session_destroy();
  }

  public static function writeClose()
  {
    if (session_status() === PHP_SESSION_ACTIVE) {
      session_write_close();
    }
  }
}
