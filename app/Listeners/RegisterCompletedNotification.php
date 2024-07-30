<?php

namespace App\Listeners;

use App\Events\RegisterCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RegisterCompletedNotification implements ShouldQueue
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
    public function handle(RegisterCompleted $event): void
    {
        $data = $event->data;

        Mail::send('mail.welcome', $data, function ($message) use ($data) {
            $message->to($data["email"]);
            $message->subject("Quên mật khẩu");
        });
    }
}
