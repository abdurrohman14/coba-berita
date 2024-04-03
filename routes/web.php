<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('berita')->group(function () {
    Route::get('/view', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/store', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/show/{id_or_slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
    Route::get('/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
});