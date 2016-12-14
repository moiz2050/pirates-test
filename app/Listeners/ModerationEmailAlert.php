<?php
namespace App\Listeners;

use App\Events\NewJobPostedForModerationEvent;
use App\Models\Post;
use Core\Crypt;
use Core\Helper;

/**
 * Class ModerationEmailAlert
 * @package App\Listeners
 */
class ModerationEmailAlert
{

    /**
     * ModerationEmailAlert constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param NewJobPostedForModerationEvent $event
     */
    public function handle(NewJobPostedForModerationEvent $event)
    {

        $this->sendJobPosterEmail($event->getJobPosterEmail());
        $this->sendModeratorEmail($event->getModeratorEmail(), $event->getJobPost());
    }

    /**
     * @param $toEmail
     */
    private static function sendJobPosterEmail($toEmail)
    {
        $htmlBody = '<html><body>Your Job Posting is under review its soon published</body></html>';
        Helper::sendMail($toEmail, "Job is under review", $htmlBody);
        //Helper::logger()->alert("Email For Job poster : ".$htmlBody);
    }

    /**
     * @param $toEmail
     * @param Post $post
     */
    private static function sendModeratorEmail($toEmail, Post $post)
    {

        $encyptedString = Crypt::encrypt($toEmail);
        $htmlBody = '<html><body>';
        $htmlBody .= '<div> Job Title:'.$post->title.'</div><br>';
        $htmlBody .= '<div> Job Description:'.$post->description.'</div><br>';


        $htmlBody .='<a href="'. Helper::makeUrl('post/markPublish/'.$encyptedString.'/'.$post->id). '">';
        $htmlBody .='Publish</a><br>';

        $htmlBody .='<a href="'. Helper::makeUrl('post/markSpam/'.$encyptedString.'/'.$post->id). '">';
        $htmlBody .='Mark as Spam</a>';


        $htmlBody .='</body></html>';

        Helper::sendMail($toEmail, "A new Job is awaiting Approval", $htmlBody);


        //Helper::logger()->alert("EmailFor Moderator : ".$htmlBody);

    }
}
