<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class NewMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Message $message;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::find($this->message->from_user_id);
        return $this->markdown('emails.new')
            ->subject( 'Пользователь ' . Str::ucfirst($user->name) . ' поделился своим публичным профилем')
            ->with([
                'greeting' => 'Здравствуйте,',
                'salutation' => 'Респект и уважуха,',
                'message' =>  $this->message,
                'user' => $user,
            ]);
    }
}
