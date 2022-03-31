<?php

use App\Http\Controllers\Api\CandidateController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'voting.index')->name('home');

Route::get('voting', [CandidateController::class, 'show']);

require __DIR__.'/auth.php';
