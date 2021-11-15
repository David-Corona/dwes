<?php

namespace cursophp7dc\app\utils;

use cursophp7dc\app\exceptions\AppException;
use cursophp7dc\core\App;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MyMail
{
    private $mailer;

    /**
     * @throws AppException
     */
    public function __construct()
    {
        $config = App::get('config')['swiftmail'];
        $security_method = 'tls';
        $transport = new Swift_SmtpTransport($config['smtp_server'], $config['smtp_port'], $config['smtp_security']);
        $transport->setUsername($config['username']);
        $transport->setPassword($config['password']);

        // Create the Mailer using your created Transport
        $this->mailer = new Swift_Mailer($transport);
    }

    /**
     * @param string $subject
     * @param string $mailTo
     * @param string $nameTo
     * @param string $text
     * @return bool
     * @throws AppException
     */
    public function send(string $subject, string $mailTo, string $nameTo, string $text): bool
    {
        $config = App::get('config')['swiftmail'];

        $message = new Swift_Message($subject);
        $message->setFrom([$config['email'] => $config['name']]);
        $message->setTo([$mailTo => $nameTo]);
        $message->setBody($text);


        $result = $this->mailer->send($message);
        return ($result === 1);
    }
}