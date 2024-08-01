<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SubHeaderProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer("client.layout.sub-header", function ($view) {
            $customer = User::where("id", Auth::id())->select("avatar")->first();
            $view->with("customer", $customer);
        });
    }
}
