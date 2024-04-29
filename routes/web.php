<?php

use App\Http\Controllers\Public\HomepageController;
use App\Http\Controllers\Public\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded within a group which contains the "web" middleware
| group.
|
*/

Route::get('/', HomepageController::class)->name('home');
Route::get('/sitemaps/{sitemap}.xml', [SitemapController::class, 'show'])->name('sitemap.show');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');

require __DIR__ . '/web/auth.php';
require __DIR__ . '/web/admin.php';
require __DIR__ . '/web/public.php';
