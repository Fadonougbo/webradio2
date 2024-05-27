<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\webradio\HomeController;
use App\Http\Controllers\webradio\PaimentController;
use App\Http\Controllers\webradio\ProgrammeController;
use App\Http\Controllers\webradio\PubliciteController;
use App\Http\Controllers\webradio\ServiceController;
use App\Models\Publicite;
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

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/programme',[ProgrammeController::class,'index'])->name('programme');

Route::get('/service',[ServiceController::class,'index'])->name('service.list');

Route::prefix('/service')->name('service.')->group(function() {
    
    Route::get('/publicite',[PubliciteController::class,'index'])->middleware(['auth','verified'])->name('publicite');

    Route::post('/publicite',[PubliciteController::class,'create'])->middleware(['auth','verified'])->name('publicite.create');

    Route::delete('/publicite/delete/{publicite}',[PubliciteController::class,'delete'])->middleware(['auth','verified'])->name('publicite.delete');

    Route::get('/paiment',[PaimentController::class,'paiment'])->middleware(['auth','verified'])->name('paiment');

    Route::get('/paiment/redirect/{publicite}',[PaimentController::class,'redirect'])->middleware(['auth','verified'])->name('paiment.redirect');

    Route::patch('/paiment',[PaimentController::class,'paimentValidation'])->middleware(['auth','verified'])->name('paiment_validation');

});

Route::get('/dashboard', function () {

    $publicites=Publicite::all();

    return view('dashboard',[
        'publicites'=>$publicites
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
