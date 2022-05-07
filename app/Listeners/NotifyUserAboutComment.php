<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUserPostWasCommented;
use App\Jobs\ThrottleMail;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUserAboutComment implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        ThrottleMail::dispatch(new CommentPostedMarkdown($event->comment), $event->comment->commentable->user);

        NotifyUserPostWasCommented::dispatch($event->comment);
    }
}
