<?php

require_once __DIR__ . '/../Database.php';

class Post {
    public $id;
    public $title;
    public $body;
    public $created_at;

    public function __construct($id, $title, $body, $created_at) {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->created_at = $created_at;
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO posts (title, body, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->title, $this->body, $this->created_at);
        return $stmt->execute();
    }

    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, title, body, created_at FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $title, $body, $created_at);
        if ($stmt->fetch()) {
            $post = new Post($id, $title, $body, $created_at);
            $stmt->close();
            return $post;  
        } else {
            $stmt->close();
            return null;
        }
    }

    public static function all() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, title, body, created_at FROM posts ORDER BY created_at DESC");
        $stmt->execute();
        $stmt->bind_result($id, $title, $body, $created_at);
        $posts = [];
        while ($stmt->fetch()) {
            $posts[] = new Post($id, $title, $body, $created_at);
        }
        $stmt->close();
        return $posts;
    }
}

