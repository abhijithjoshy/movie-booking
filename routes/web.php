<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TheaterController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/dashboard', [TheaterController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('add_theater',[TheaterController::class,'create_theater']);
Route::post('add_shows',[TheaterController::class,'create_show'])->name('saveShow');
Route::get('/image/{filename}', [TheaterController::class,'show_image'])->name('image.show');


require __DIR__.'/auth.php';
