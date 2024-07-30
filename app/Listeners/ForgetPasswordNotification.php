<?php

namespace App\Listeners;

use App\Events\ForgetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordNotification implements ShouldQueue
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
    public function handle(ForgetPassword $event): void
    {
        $data = $event->data;
        Mail::send('mail.forget-password', ["token" => $data["token"], "email" => $data["email"]], function ($message) use ($data) {
            $message->to($data["email"]);
            $message->subject("Quên mật khẩu");
        });
    }
}
