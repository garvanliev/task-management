<?php

namespace App\Listeners;

use App\Events\CommentMade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentCreated;
use App\Mail\CommentCreated as MailComment;
use Illuminate\Support\Facades\Mail;

class UpdateUserAboutComment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentMade $event): void
    {
        // Notification::send($event->task->user, new CommentCreated($event->comment, $event->task));

        Mail::to($event->task->user->email)->send(new MailComment($event->comment, $event->task));

    }
}
