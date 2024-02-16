<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv as Dotenv;

class Mailer
{
    protected $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        // Cấu hình SMTP hoặc các thiết lập gửi email khác ở đây
        $this->config();
    }

    public function config()
    {
        $dotenv = Dotenv::createImmutable(__DIR__. '/../../');
        $dotenv->load();

        // Cấu hình SMTP hoặc các thiết lập gửi email khác ở đây
        $this->mail->isSMTP();
        $this->mail->Host = $_ENV['MAIL_HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $_ENV['MAIL_USERNAME'];
        $this->mail->Password = $_ENV['MAIL_PASSWORD'];
        $this->mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $this->mail->Port = $_ENV['MAIL_PORT'];
    }

    public function sendMail($to, $subject, $body): bool
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