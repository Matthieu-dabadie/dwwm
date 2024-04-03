<?php

namespace App\public\Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../app/vendor/autoload.php';

class ContactModel
{
    public function sendContactEmail($name, $email, $subject, $message)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '*************************';
            $mail->Password   = '******************************';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            // Destinataires
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('*******************', 'Admin');


            // Contenu pour l'administrateur
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = "Email envoyé par: $name <$email><br>Message: $message";
            $mail->AltBody = strip_tags("Email envoyé par: $name <$email>\nMessage: $message");

            $mail->send();

            // Réinitialiser l'objet PHPMailer pour envoyer un email de confirmation
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            // Configuration pour l'email de confirmation à l'expéditeur
            $mail->setFrom('no-reply@example.com', 'Confirmation Mailer');
            $mail->addAddress($email, $name); // adresse de l'expéditeur

            // Contenu de l'email de confirmation
            $mail->Subject = 'Confirmation de réception de votre message';
            $mail->Body    = 'Bonjour ' . $name . ',<br><br>Votre message a bien été reçu et va être traité dans les plus brefs délais.<br><br>Cordialement,<br>L\'équipe';
            $mail->AltBody = 'Bonjour ' . $name . ",\n\nVotre message a bien été reçu et va être traité dans les plus brefs délais.\n\nCordialement,\nL'équipe";

            $mail->send();

            $_SESSION['email_sent'] = 'Votre message a été envoyé avec succès et une confirmation a été envoyée à votre adresse email.';
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            // En cas d'échec, retournez l'erreur
            $_SESSION['email_sent_error'] = "Le message n'a pas pu être envoyé. Erreur du mailer : {$mail->ErrorInfo}";
            header('Location: index.php');
            exit();
        }
    }
}
