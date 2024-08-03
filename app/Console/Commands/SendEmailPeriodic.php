<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailPeriodicJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailPeriodic extends Command
{
    protected $signature = 'mail:send-email-periodic';

    protected $description = 'Send periodic emails';

    public function handle()
    {
        $users = User::where("role", 'member')->get();

        foreach ($users as $user) {
            SendEmailPeriodicJob::dispatch($user);
        }
    }
}
