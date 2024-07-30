<?php

namespace App\Providers;

use App\Events\ForgetPassword;
use App\Events\QuizCompleted;
use App\Events\ResetPassword;
use App\Listeners\ForgetPasswordNotification;
use App\Listeners\QuizCompletedNotification;
use App\Listeners\ResetPasswordNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        QuizCompleted::class => [
            QuizCompletedNotification::class
        ],

        ForgetPassword::class => [
            ForgetPasswordNotification::class
        ]
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
