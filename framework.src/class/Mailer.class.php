<?php


namespace webapp_php_sample_class;


use Exception;

class Mailer
{
    public static function createMail($targetAddress, $subject, $message, $mode): void
    {
        $header = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";

        switch ($mode) {
            case MAIL_INFO:
            {
                $header .= 'From: ' . MAIL_INFO . '@' . DOMAIN . "\r\n";
                $header .= 'Reply-To: ' . MAIL_INFO . '@' . DOMAIN . "\r\n";
            }

            case MAIL_AUTO:
            {
                $header .= 'From: ' . MAIL_AUTO . '@' . DOMAIN . "\r\n";
            }

            case MAIL_SUPPORT:
            {
                $header .= 'From: ' . MAIL_SUPPORT . '@' . DOMAIN . "\r\n";
                $header .= 'Reply-To: ' . MAIL_SUPPORT . '@' . DOMAIN . "\r\n";
            }
        }

        $header .= 'X-Mailer: PHP ' . PHP_VERSION;

        try {
            mail(
                $targetAddress,
                $subject,
                $message,
                $header
            );
        } catch (Exception $e) {
            ErrorHandler::FireError($e->getCode(), $e->getMessage());
        }
    }
}