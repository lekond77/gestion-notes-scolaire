<?php

declare(strict_types=1);

namespace App\controllers;

use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{

        private PHPMailer $phpMailer;

        public function __construct()
        {
                $this->phpMailer = new PHPMailer();
                $this->phpMailer->isSMTP();
                $this->phpMailer->Host = 'sandbox.smtp.mailtrap.io';
                $this->phpMailer->SMTPAuth = true;
                $this->phpMailer->Port = 2525;
                $this->phpMailer->Username = 'username';
                $this->phpMailer->Password = 'password';
                $this->phpMailer->CharSet = 'UTF-8';
                $this->phpMailer->isHTML(true);
                $this->phpMailer->SetFrom ('contactnotesscolaires@contact.bj', 'CEG INCONNU');
        }

        public function sendMail($to, $subject, $content, $name): bool
        {
                $this->phpMailer->Subject = $subject;
                $this->phpMailer->addAddress($to, $name);
                $this->phpMailer->Body = $content;

                return $this->phpMailer->send();
        }
}

