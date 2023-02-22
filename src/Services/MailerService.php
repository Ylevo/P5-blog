<?php
declare(strict_types=1);

namespace App\Services;

use App\Core\MessageType;
use App\Core\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    private PHPMailer $mailer;
    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->mailer = new PHPMailer(true);
        $this->configMailer();
    }

    public function sendEmail(array $mailData) : void
    {
        try {
            $this->mailer->addReplyTo(filter_var($mailData['email'], FILTER_SANITIZE_EMAIL));
            $this->mailer->Subject = "Message from " . filter_var($mailData['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->mailer->Body = filter_var($mailData['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->mailer->send();
            $this->session->addMessage("Your message was successfully sent. We'll reply to you later, maybe.", MessageType::Success);
        } catch (Exception $e) {
            error_log((string)$e);
            $this->session->addMessage("Error : Could not send your message. Please try again later.", MessageType::Error);
        }
    }

    private function configMailer() : void
    {
        $mailerConfig = $this->getMailerConfig();
        $this->mailer->Host = $mailerConfig['smtpServer'];
        $this->mailer->Port = $mailerConfig['smtpPort'];
        $this->mailer->Username = $mailerConfig['username'];
        $this->mailer->Password = $mailerConfig['password'];
        $this->mailer->setFrom($mailerConfig['senderEmail'], 'Blog');
        $this->mailer->addAddress($mailerConfig['senderEmail']);
        $this->mailer->isSMTP();
        $this->mailer->CharSet = PHPMailer::CHARSET_UTF8;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->SMTPAuth = true;
    }

    private function getMailerConfig() : array
    {
        return yaml_parse_file(__DIR__ . '/../../config/mailerConfig.yml');
    }
}
