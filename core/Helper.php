<?php
namespace Core;

use App\Events\Events;
use App\Events\NewJobPostedForModerationEvent;
use App\Listeners\ModerationEmailAlert;
use Illuminate\Encryption\Encrypter;
use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;
use Monolog\Logger;

/**
 * Class Helper
 * @package Core
 */
class Helper
{
    /**
     * @param $uri
     * @return string
     */
    public static function makeUrl($uri)
    {
        return $GLOBALS['config']['siteUrl'].$uri;
    }

    /**
     * @param Events $event
     * @return array|null
     */
    public static function fire(Events $event)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->listen([NewJobPostedForModerationEvent::class], ModerationEmailAlert::class);
        return $dispatcher->fire($event);
    }

    /**
     * @param $toEmailAddress
     * @param $subject
     * @param $body
     * @throws \phpmailerException
     */
    public static function sendMail($toEmailAddress, $subject, $body)
    {

        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.mailtrap.io';
        $mail->Port = 25;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "90bc740f36f85d";
        $mail->Password = "1d06e7cf6ba0d8";
        $mail->setFrom('test@mueezsattar.com', 'First Last');
        $mail->addReplyTo('test@mueezsattar.com', 'First Last');
        $mail->addAddress($toEmailAddress, "New log");
        $mail->AllowEmpty = true;
        $mail->msgHTML($body);
        $mail->Subject = $subject;
        $mail->AltBody = $body;

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

    /**
     * @return Writer
     */
    public static function logger()
    {
        $log = new Writer(new Logger("Pirate test"));
        $log->useFiles(LOG_PATH."pirates.log");

        return $log;

    }
}
