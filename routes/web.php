<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\webradio\CommuniqueController;
use App\Http\Controllers\webradio\DashboadController;
use App\Http\Controllers\webradio\HomeController;
use App\Http\Controllers\webradio\PaimentController;
use App\Http\Controllers\webradio\PaymentController;
use App\Http\Controllers\webradio\ProgrammeController;
use App\Http\Controllers\webradio\PubliciteController;
use App\Http\Controllers\webradio\ServiceController;
use Illuminate\Http\Request;
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

//Route utiliser en ajax pour envoyer les informations de l'utilisateur au front
Route::post('/auth/user',[HomeController::class,'getUserData'])->name('auth.data');

Route::get('/programme',[ProgrammeController::class,'index'])->name('programme');

Route::get('/grille-tarifaire',[ProgrammeController::class,'showGrille'])->name('grille');

Route::get('/service',[ServiceController::class,'index'])->name('service.list');


Route::post('/process',[CommuniqueController::class,'process'])->name('communique.create.process');
Route::delete('/revert',[CommuniqueController::class,'revert'])->name('communique.create.revert');
// Pour afficher les fichiers deja uploader par l'utilisateur
Route::post('/load/file',[CommuniqueController::class,'loadFile'])->name('communique.update.load.file');



Route::get('service/payment',[PaymentController::class,'index'])->name('service.payment')->middleware(['auth','verified']);


Route::prefix('/service')->name('service.')->middleware(['auth','verified'])->group(function() {

    /* communiqué */
    Route::get('/communique',[CommuniqueController::class,'index'])->name('communique');

    Route::post('/communique',[CommuniqueController::class,'create'])->name('communique.create');

    Route::delete('/communique/delete/{communique}',[CommuniqueController::class,'delete'])->name('communique.delete');

    Route::get('/communique/update/{communique}',[CommuniqueController::class,'updateView'])->name('communique.update.view');

    Route::patch('/communique/update/{communique}',[CommuniqueController::class,'update'])->name('communique.update');

    Route::match(['POST','PATCH'],'/communinique/htmx',[CommuniqueController::class,'getHtmxData'])->name('communique.htmx');


    /* Payment */
    Route::get('/payment',[PaymentController::class,'index'])->name('payment');
    Route::post('/payment/htmx/{id}/{type}',[PaymentController::class,'getHtmxData'])->name('payment.htmx');
    //Pour un payment direct
    Route::patch('/payment/validation',[PaymentController::class,'validation'])->name('payment.validation');
    //Pour un payment apres enregistrement
    Route::get('/payment/old/payment/validation/{id}/{type}',[PaymentController::class,'oldPaymentValidation'])->name('payment.old.payment.validation');
    
   

});



Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function() {

    Route::get('/',[DashboadController::class,'index'])->name('dashboard');

    Route::get('/administration',[DashboadController::class,'administration'])->name('dashboard.administration')->can('show_administration');

    Route::patch('/administration/action',[DashboadController::class,'action'])->name('dashboard.administration.action')->can('show_administration');

    Route::get('/administration',[DashboadController::class,'administration'])->name('dashboard.administration')->can('show_administration');

    Route::get('/administration/role',[DashboadController::class,'index'])->name('dashboard.gestion.role')->can('show_administration');

    Route::get('/administration/configuration',[DashboadController::class,'configuration'])->name('dashboard.configuration')->can('show_administration');

    Route::patch('/administration/configuration/update/price',[DashboadController::class,'price'])->name('dashboard.configuration.price')->can('show_administration');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
