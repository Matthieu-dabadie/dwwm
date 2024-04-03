<?php

namespace App\admin\Controllers;

require_once __DIR__ . '/../core/SessionHandler.php';

require '../../app/vendor/autoload.php';

use App\admin\Models\AdminModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class PasswordResetController
{
    public function showResetRequestForm()
    {

        require_once __DIR__ . '../../Views/requestResetForm.php';
    }

    public function sendResetLink()
    {
        session_start();
        $email = $_POST['email'];
        $token = bin2hex(random_bytes(16));

        $adminModel = new AdminModel();
        if ($adminModel->emailExists($email)) {
            $adminModel->storeResetToken($email, $token);

            $mail = new PHPMailer(true);
            try {
                // Configuration du serveur
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = '********************';
                $mail->Password   = '********************';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->addAddress($email);
                $mail->Subject = 'Réinitialisation de votre mot de passe';
                $mail->Body    = 'Veuillez cliquer sur ce lien pour reinitialiser votre mot de passe : <a href="http://dwwm/app/admin/index.php?controller=passwordReset&action=resetPassword&token=' . $token . '">Réinitialiser mon mot de passe</a>';
                $mail->send();

                $_SESSION['flash_message'] = 'Le lien de réinitialisation a été envoyé à votre adresse e-mail.';
                $_SESSION['flash_message_type'] = 'success';
            } catch (Exception $e) {
                $_SESSION['flash_message'] = 'L\'envoi du lien de réinitialisation a échoué. Erreur : ' . $mail->ErrorInfo;
                $_SESSION['flash_message_type'] = 'danger';
            }
        } else {
            $_SESSION['flash_message'] = 'Aucun compte n\'est associé à cette adresse e-mail.';
            $_SESSION['flash_message_type'] = 'danger';
        }
        header('Location: index.php?controller=passwordReset&action=showResetRequestForm');
        exit;
    }

    public function resetPassword()
    {
        $token = $_GET['token'] ?? null;

        require_once __DIR__ . '../../Views/resetForm.php';
    }

    public function handleResetPassword()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $token = $_POST['token'] ?? null;
            $newPassword = $_POST['password'] ?? null;

            $adminModel = new AdminModel();
            if ($adminModel->resetPassword($token, $newPassword)) {
                // Si la réinitialisation réussit
                $_SESSION['flash_message'] = "Votre mot de passe a été réinitialisé avec succès.";
                $_SESSION['flash_message_type'] = 'success';
            } else {
                // Si la réinitialisation échoue
                $_SESSION['flash_message'] = "Erreur lors de la réinitialisation du mot de passe.";
                $_SESSION['flash_message_type'] = 'error';
            }


            header("Location: index.php?controller=passwordReset&action=resetFormConf");
            exit;
        } else {

            http_response_code(405);
            echo "Méthode non autorisée.";
        }
    }

    public function resetFormConf()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        require_once __DIR__ . '../../Views/resetFormConf.php';
    }
}
