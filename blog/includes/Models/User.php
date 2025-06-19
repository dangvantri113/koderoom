<?php

class User {
  public $id;
  public $name;
  public $email;
  public $password;
  public $created_at;

  public function __construct($id, $name, $email, $password, $created_at = null) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    $this->created_at = $created_at ? $created_at : date('Y-m-d H:i:s');
  }

  public function save() {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $this->name, $this->email, $this->password, $this->created_at);
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
