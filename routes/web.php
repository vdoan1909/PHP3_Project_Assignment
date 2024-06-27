<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ExamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::prefix("admin")
    ->as("admin.")
    ->middleware(["auth", "admin_auth"])
    ->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("index");

        Route::prefix("subject")
            ->as("subjects.")
            ->group(function () {
                Route::get("/", [SubjectController::class, "index"])->name("index");
                Route::get("create", [SubjectController::class, "create"])->name("create");
                Route::post("store", [SubjectController::class, "store"])->name("store");
                Route::get("edit/{slug}", [SubjectController::class, "edit"])->name("edit");
                Route::put("update/{slug}", [SubjectController::class, "update"])->name("update");
                Route::delete("destroy/{slug}", [SubjectController::class, "destroy"])->name("destroy");
            });

        Route::prefix("exam")
            ->as("exams.")
            ->group(function () {
                Route::get("/", [ExamController::class, "index"])->name("index");
                Route::get("create", [ExamController::class, "create"])->name("create");
                Route::post("store", [ExamController::class, "store"])->name("store");
                Route::get("edit/{slug}", [ExamController::class, "edit"])->name("edit");
                Route::put("update/{slug}", [ExamController::class, "update"])->name("update");
                Route::delete("destroy/{slug}", [ExamController::class, "destroy"])->name("destroy");
            });
    });
