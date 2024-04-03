<?php

namespace App\admin\Controllers;

use App\admin\Core\DbConnect;
use App\admin\Models\AdminModel;

require_once __DIR__ . '/../core/SessionHandler.php';

class ConfirmationController
{
    public function confirm($token)
    {
        $adminModel = new AdminModel();

        $tokenValue = is_array($token) ? $token['token'] : $token;
        $admin = $adminModel->getAdminByToken($tokenValue);

        if ($admin) {

            require __DIR__ . '/../Views/administrator/confirmForm.php';
        } else {
            echo "Token invalide ou expiré.";
        }
    }




    public function updatePassword($token, $password)
    {
        $adminModel = new AdminModel();
        if ($adminModel->updateAdminPassword($token, $password)) {
            $_SESSION['message'] = "Votre mot de passe a été mis à jour avec succès.";
        } else {
            $_SESSION['message'] = "Token invalide ou expiré.";
        }
    }
}
