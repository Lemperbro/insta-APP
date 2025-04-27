<?php

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::prefix('auth')->middleware('guest')->name('auth.')->group(function () {
    Route::get('login', \App\Livewire\Auth\LoginIndex::class)->name('login');
    Route::get('register', \App\Livewire\Auth\RegisterIndex::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('profile/{id}', \App\Livewire\Main\Profile\ProfileIndex::class)->name('profile');

    Route::get('post-form/{id?}', \App\Livewire\Main\PostForm\PostFormIndex::class)->name('post.form');
});


