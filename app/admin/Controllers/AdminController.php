<?php

namespace App\admin\Controllers;

require_once __DIR__ . '/../core/SessionHandler.php';
require '../../app/vendor/autoload.php';

use App\admin\Models\AdminModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends Controller
{
    public function manage()
    {
        $adminModel = new AdminModel();
        $admins = $adminModel->getAllAdmins();
        $this->render('administrator/manage', ['admins' => $admins]);
    }

    public function add()
    {
        $this->render('administrator/add');
    }

    public function addAdmin()
    {

        $email = $_POST['username'];

        $token = bin2hex(random_bytes(16));

        $adminModel = new AdminModel();
        $adminModel->addAdminWithToken($email, $token);

        // Configurer PHPMailer et envoyer l'e-mail
        $mail = new PHPMailer(true);
        try {
            // Configuration du serveur
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '****************@gmail.com';
            $mail->Password   = '*******************';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Contenu de l'e-mail
            $mail->setFrom('your-email@example.com', 'Your Name');
            $mail->addAddress($_POST['username']);
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de creation de compte administrateur';
            $mail->Body    = 'Veuillez cliquer sur ce lien pour confirmer votre adresse e-mail et choisir votre mot de passe : <a href="http://dwwm/app/admin/index.php?controller=confirmation&action=confirm&token=' . $token . '">Confirmer mon e-mail</a>';

            $mail->send();
            echo 'L\'invitation a été envoyée avec succès.';
        } catch (Exception $e) {
            echo 'L\'invitation n\'a pas pu être envoyée. Erreur : ', $mail->ErrorInfo;
        }
    }


    public function edit($params)
    {
        $id = $params;
        if (is_array($params)) {
            $id = $params['id'];
        }
        $adminModel = new AdminModel();
        $admin = $adminModel->getAdminById($id);
        $this->render('administrator/edit', ['admin' => $admin]);
    }



    public function saveEdit()
    {
        $id = $_GET['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $adminModel = new AdminModel();
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $adminModel->updateAdmin($id, $username, $hashedPassword);
        } else {
            $adminModel->updateAdmin($id, $username);
        }

        header('Location: ?controller=admin&action=manage');
    }


    public function delete()
    {
        $id = $_GET['id'];
        $adminModel = new AdminModel();
        $adminModel->deleteAdmin($id);
        header('Location: ?controller=admin&action=manage');
    }
}
