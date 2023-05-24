<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('/', 'HomeController');

Auth::routes();

Route::resource('home', 'HomeController');

Route::resource('create_poster', 'posterCreationController');

Route::resource('create_category', 'categoryCreationController');

Route::resource('poster', 'onePosterController');