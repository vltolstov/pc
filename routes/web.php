<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\XmlUploadController;
use App\Http\Controllers\ClientFormSendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])
    ->name('index');

Route::get('/sitemap.xml', [SiteMapController::class, 'sitemap']);
Route::get('/upload', [XmlUploadController::class, 'index']);

Route::get('/{slug}', [PageController::class, 'page']);
Route::post('/sending', [ClientFormSendController::class, 'sending'])
    ->name('form-sending');

