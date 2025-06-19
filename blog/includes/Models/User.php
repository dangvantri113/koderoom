<?php

class User {
  public $id;
  public $name;
  public $email;
  public $password;
  public $created_at;

  public function __construct($name, $email, $password) {
    $this->name = $name;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function save() {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->name, $this->email, $this->password, date('Y-m-d H:i:s'));
    return $stmt->execute();
  }

  public static function findById($id) {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT id, name, email, password, created_at FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email, $password, $created_at);
    if ($stmt->fetch()) {
      $user = new User($id, $name, $email, $password, $created_at);
      $stmt->close();
      return $user;  
    } else {
      $stmt->close();
      return null;
    }
  }
}
