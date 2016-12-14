<?php
namespace Core;

use App\Events\NewJobPostedForModerationEvent;
use App\Listeners\ModerationEmailAlert;
use Illuminate\Events\Dispatcher;

/**
 * Class Loader
 * @package Core
 */
class Loader
{
    /**
     * Loader constructor.
     */
    public function __construct()
    {
        $dispatcher = new Dispatcher();
        $dispatcher->listen([NewJobPostedForModerationEvent::class], ModerationEmailAlert::class);
    }
}
