<?php
namespace App\Events;

use App\Models\Post;

/**
 * Class NewJobPostedForModerationEvent
 * @package App\Events
 */
class NewJobPostedForModerationEvent extends Events
{
    protected $moderatorEmail;
    protected $jobPosterEmail;
    protected $jobPost;

    /**
     * NewJobPostedForModerationEvent constructor.
     * @param $moderatorEmail
     * @param $jobPosterEmail
     * @param Post $jobPost
     */
    public function __construct($moderatorEmail, $jobPosterEmail, Post $jobPost)
    {
        $this->moderatorEmail = $moderatorEmail;
        $this->jobPosterEmail = $jobPosterEmail;
        $this->jobPost = $jobPost;
    }

    /**
     * @return mixed
     */
    public function getModeratorEmail()
    {
        return $this->moderatorEmail;
    }

    /**
     * @return mixed
     */
    public function getJobPosterEmail()
    {
        return $this->jobPosterEmail;
    }

    /**
     * @return Post
     */
    public function getJobPost()
    {
        return $this->jobPost;
    }
}
