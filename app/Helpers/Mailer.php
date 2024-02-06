<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $_mail;
    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Cấu hình SMTP hoặc các thiết lập gửi email khác ở đây
        $this->config();
    }

    private function config()
    {
        // Cấu hình SMTP hoặc các thiết lập gửi email khác ở đây
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'nguyenleanhkhoa25866@gmail.com';
        $this->mail->Password = 'atir avas dova miyp';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
    }

    public function sendMail($to, $subject, $body)
    {
        try {
            $this->mail->setFrom('your_email@example.com', 'Your Name');
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}