<?php

namespace App\public\Controllers;

use App\public\Models\ContactModel;

class ContactController extends Controller
{
    public function index()
    {
        $this->render('pages/contact');
    }

    public function sendContact()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $contactModel = new ContactModel();
            $sendMail = $contactModel->sendContactEmail($name, $email, $subject, $message);


            $this->render('pages/contact', ['message' => $sendMail]);
        }
    }
}
