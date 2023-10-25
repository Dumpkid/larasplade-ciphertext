<?php

use App\Http\Controllers\CipherController;
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

Route::middleware(['splade'])->group(function () {
    Route::get('/', fn () => view('home'))->name('home');
    Route::get('/ciphertext', fn () => view('docs'))->name('docs');
    // Route::resource('/ciphertext', CipherController::class);
    Route::post('/enkrip', [CipherController::class, 'enkripsi'])->name('enkrip');
    Route::post('/dekrip', [CipherController::class, 'dekripsi'])->name('dekrip');

    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
