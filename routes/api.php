<?php

use arashrasoulzadeh\Zal\Controllers\ZalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$prefix = config('zal.router.prefix');

Route::any($prefix.'/{action}/{id?}', [ZalController::class, 'serve']);
