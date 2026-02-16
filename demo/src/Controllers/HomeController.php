<?php

namespace App\Controllers;

use App\Controller;

use App\Core\Request;
use App\Core\Validator;
use App\Core\Session;

use PHPMailer\PHPMailer\PHPMailer as PHPMailerPHPMailer;

require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';

class HomeController extends Controller
{
    public function index()
    {
        $this->render('index');
    }

    public function store()
    {
        $errors = Validator::validate([
            'email' => ['email', 'required'],
            'subject' => ['min:3', 'required'],
            'message' => ['min:3', 'required'],
        ]);

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', Request::all());
            redirect('');
        }

        $mail = new PHPMailerPHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'davidkof72@gmail.com';
        $mail->Password = '###';
        $mail->SMTPSecure = PHPMailerPHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('davidkof72@gmail.com');
        $mail->addAddress('davidkof72@gmail.com');
        $mail->addReplyTo($_POST['email']);

        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];

        $mail->Body = "
            <strong>Email:</strong> {$_POST['email']} <br><br>
            <strong>Message:</strong><br>
            " . nl2br($_POST['message']);

        $mail->send();

        Session::flash('success', "Your message has been sent successfully");
        redirect('');
    }


}

