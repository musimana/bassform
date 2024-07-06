<?php

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| This file is for defining the HTTP web routes relating to site admins
| for the application.
|
*/

Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    /** PageController Routes */
    Route::controller(PageController::class)->group(function () {
        Route::get('pages/{page}', 'edit')->name('page.edit');
        Route::patch('pages/{page}', 'update')->name('page.update');
    });
});
