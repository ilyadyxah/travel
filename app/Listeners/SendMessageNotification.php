<?php

namespace App\Listeners;

use App\Events\CreateMessageEvent;
use App\Mail\NewMessageMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

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
     * @param CreateMessageEvent $event
     * @return void
     */
    public function handle(CreateMessageEvent $event)
    {

        if (isset($event->message) && $event->message instanceof Message) {

            if ($event->message->to_user_id) {
                $recipient_email = User::find($event->message->to_user_id)->email;

            } else(
            $recipient_email = $event->message->recipient_email
            );

            Mail::to($recipient_email)
                ->queue(new NewMessageMail($event->message));
        }
    }
}
