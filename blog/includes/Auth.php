<?php 

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Session.php';

class Auth
{
    public static function login($username, $password)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $name, $email, $hashed_password);
        if ($stmt->fetch()) {
            $stmt->close();
            if (password_verify($password, $hashed_password)) {
                $session = new Session();
                $session->start();
                $session->set('user_id', $id);
                $session->set('name', $name);
                $session->set('email', $email);
                $session->set('logged_in', true);
                return true;
            } else {
                $stmt->close();
                return false; // Invalid password
            }
        } else {
            $stmt->close();
            return false; // User not found
        }
    }

    public static function logout()
    {
        $session = new Session();
        $session->start();
        $session->destroy();
    }
};
