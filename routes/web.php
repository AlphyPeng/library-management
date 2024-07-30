<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersAccount;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin', function () {
    return view('user/signin/signin', ['name' => 'Alphy']);
})->name('signin');

// Route::get('/signup', [UsersAccount::class, 'showSignUp']);
// Route::post('/signup', [UsersAccount::class, 'signUp'])->name('signup');


Route::controller(UsersAccount::class)->group(function () {
    Route::get('/signup', 'showSignUp');
    Route::post('/signup', 'signUp')->name('signup');
});
