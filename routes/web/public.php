<?php

use App\Http\Controllers\Public\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| This file is for defining the non-Ecommerce related public HTTP routes
| for the application.
|
*/

Route::get('/{page:slug}', [PageController::class, 'show'])->name('page.show');
