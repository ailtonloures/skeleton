<?php

namespace App\Services\Utils;

use Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

final class Mail
{
    /** @var Exception $error */
    private $error;

    /** @var PHPMailer $mail */
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->SMTPDebug  = SMTP::DEBUG_OFF;
        $this->mail->SMTPAuth   = true;
        $this->mail->SMTPSecure = getenv('MAIL_CRYPT');
        $this->mail->Charset    = 'UTF-8';

        $this->mail->isSMTP();
        $this->mail->isHTML(true);
        $this->mail->setLanguage(getenv('APP_LOCALE'));

        $this->mail->Host     = getenv('MAIL_HOST');
        $this->mail->Username = getenv('MAIL_USERNAME');
        $this->mail->Password = getenv('MAIL_PASSWORD');
        $this->mail->Port     = getenv('MAIL_PORT');
    }

    /**
     * @param string $alt
     * @return Mail
     */
    public function altBody(string $alt): Mail
    {
        $this->mail->AltBody = $alt;

        return $this;
    }

    /**
     * @param string $path
     * @return Mail
     */
    public function attach(string $path): Mail
    {
        $this->mail->addAttachment($path);

        return $this;
    }

    /**
     * @param string $email
     * @param string|null $name
     * @return Mail
     */
    public function bcc(
        string $email,
        ?string $name = null
    ): Mail {
        $this->mail->addBCC($email, $name);

        return $this;
    }

    /**
     * @param string $body
     * @param boolean $html
     * @return Mail
     */
    public function body(string $body): Mail
    {
        $this->mail->Body = $body;

        return $this;
    }

    /**
     * @param string $email
     * @param string|null $name
     * @return Mail
     */
    public function cc(
        string $email,
        ?string $name = null
    ): Mail {
        $this->mail->addCC($email, $name);

        return $this;
    }

    /**
     * @param string $email
     * @param string|null $name
     * @return Mail
     */
    public function from(
        string $email,
        ?string $name = null
    ): Mail {
        $this->mail->setFrom($email, $name);

        return $this;
    }

    /**
     * @return Exception
     */
    public function getError(): Exception
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        try {
            $this->mail->send();
        } catch (Exception $exception) {
            $this->error = $exception;

            return false;
        }

        return true;
    }

    /**
     * @param string $subject
     * @return Mail
     */
    public function subject(string $subject): Mail
    {
        $this->mail->Subject = $subject;

        return $this;
    }

    /**
     * @param string $email
     * @param string|null $name
     * @return Mail
     */
    public function to(
        string $email,
        ?string $name = null
    ): Mail {
        $this->mail->addAddress($email, $name);

        return $this;
    }

    /**
     * @param string $path
     * @param array $data
     * @return Mail
     */
    public function view(
        string $path,
        array $data = []
    ): Mail {
        $this->mail->Body = getContent($path, $data);

        return $this;
    }
}
