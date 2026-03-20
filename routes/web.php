<?php

use App\Http\Controllers\Auth2Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", [Auth2Controller::class, "login"])->name("login");
Route::get("/{oauth}/oauth-redirect", [Auth2Controller::class, "redirect"])->name("oauth-redirect");
Route::get("/{oauth}/oauth-callback", [Auth2Controller::class, "callback"])->name("oauth-authenticate");
