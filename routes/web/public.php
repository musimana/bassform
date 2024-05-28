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

/** PageController Routes */
Route::controller(PageController::class)->group(function () {
    Route::get('{page:slug}', 'show')->name('page.show');
    Route::post('{page:slug}', 'store')->name('page.store');
});
