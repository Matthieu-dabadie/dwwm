<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getAllAdmins()
    {
        $stmt = $this->db->prepare("SELECT * FROM admins");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAdminById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function getAdminByToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateAdminPassword($token, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE admins SET password = :password, token = NULL WHERE token = :token");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }

    public function addAdminWithToken($username, $token)
    {
        $stmt = $this->db->prepare("INSERT INTO admins (username, token) VALUES (:username, :token)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
    }


    public function updateAdmin($id, $username, $password = null)
    {
        if ($password !== null) {
            $stmt = $this->db->prepare("UPDATE admins SET username = :username, password = :password WHERE id = :id");
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        } else {
            $stmt = $this->db->prepare("UPDATE admins SET username = :username WHERE id = :id");
        }
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function deleteAdmin($id)
    {
        $stmt = $this->db->prepare("DELETE FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function emailExists($email)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM admins WHERE username = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function storeResetToken($email, $token)
    {
        $stmt = $this->db->prepare("UPDATE admins SET reset_token = :token, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE username = :email");
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function resetPassword($token, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE admins SET password = :password, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = :token AND reset_token_expiry > NOW()");
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
