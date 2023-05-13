<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->apiResource('user', 'ApiTokenController');

Route::apiResource('posters', 'PosterController');

Route::apiResource('categories', 'CategoryController');