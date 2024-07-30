<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SideBarServiceProdiver extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer("admin.layout.side-bar", function ($view) {

            $menuItems = [
                [

                    'id' => 'subject',
                    'icon' => 'ri-book-fill',
                    'name' => 'Subjects',
                    'routeName' => "subjects",
                ],

                [
                    'id' => 'exam',
                    'icon' => 'ri-timer-fill',
                    'name' => 'Exams',
                    'routeName' => "exams",
                ],

                [
                    'id' => 'question',
                    'icon' => 'ri-questionnaire-fill',
                    'name' => 'Questions',
                    'routeName' => "questions",
                ],

                [
                    'id' => 'user',
                    'icon' => 'ri-file-user-fill',
                    'name' => 'Users',
                    'routeName' => "users",
                ],

                [
                    'id' => 'manager',
                    'icon' => ' ri-admin-fill',
                    'name' => 'Managers',
                    'routeName' => "managers",
                ],
            ];


            $view->with("menuItems", $menuItems);
        });
    }
}
