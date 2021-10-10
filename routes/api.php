<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/lemmas', [AddressesController::class, 'getLemmas']);
Route::get('/lemmas', [AddressesController::class, 'getMyLemmas'])->middleware('val_get_req');
