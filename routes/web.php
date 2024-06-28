<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\webradio\BlogController;
use App\Http\Controllers\webradio\CategorieController;
use App\Http\Controllers\webradio\CommuniqueController;
use App\Http\Controllers\webradio\DashboadController;
use App\Http\Controllers\webradio\HomeController;
use App\Http\Controllers\webradio\PaymentController;
use App\Http\Controllers\webradio\ProgrammeController;
use App\Http\Controllers\webradio\ServiceController;
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

Route::get('/article/{article}/{slug}',[HomeController::class,'show'])->name('home.show');

Route::get('/categorie/{categorie}/{name}',[HomeController::class,'showCategorie'])->name('home.show.categorie');

//Pour afficher le contenu de l'article
Route::get('/article/show/htmx/{article}',[HomeController::class,'getHtmxData'])->name('home.show.htmx');

/* Pour afficher le carousel */
Route::get('/carousel/htmx',[HomeController::class,'getCarouselHtmxData'])->name('home.carousel.htmx');

//Route utiliser en ajax pour envoyer les informations de l'utilisateur au front
Route::post('/auth/user',[HomeController::class,'getUserData'])->name('auth.data');

Route::get('/programme',[ProgrammeController::class,'index'])->name('programme');

Route::get('/grille-tarifaire',[ProgrammeController::class,'showGrille'])->name('grille');

Route::get('/service',[ServiceController::class,'index'])->name('service.list');


Route::post('/process',[CommuniqueController::class,'process'])->name('communique.create.process');
Route::delete('/revert',[CommuniqueController::class,'revert'])->name('communique.create.revert');
// Pour afficher les fichiers deja uploader par l'utilisateur
Route::post('/load/file',[CommuniqueController::class,'loadFile'])->name('communique.update.load.file');



/* Route::get('service/payment',[PaymentController::class,'index'])->name('service.payment')->middleware(['auth','verified']); */


Route::prefix('/service')->name('service.')->middleware(['auth','verified'])->group(function() {

    /* communiqué */
    Route::get('/communique',[CommuniqueController::class,'index'])->name('communique');

    Route::post('/communique',[CommuniqueController::class,'create'])->name('communique.create');

    Route::delete('/communique/delete/{communique}',[CommuniqueController::class,'delete'])->name('communique.delete');

    Route::get('/communique/update/{communique}',[CommuniqueController::class,'updateView'])->name('communique.update.view');

    Route::patch('/communique/update/{communique}',[CommuniqueController::class,'update'])->name('communique.update');

    //htmx route
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

    //Administration home
    Route::get('/administration',[DashboadController::class,'administration'])->name('dashboard.administration')->can('show_administration');

    //Administration action
    Route::patch('/administration/action',[DashboadController::class,'action'])->name('dashboard.administration.action')->can('show_administration');



    //Page configuration
    Route::get('/administration/configuration',[DashboadController::class,'configuration'])->name('dashboard.configuration')->can('show_administration');

    Route::patch('/administration/configuration/update/price',[DashboadController::class,'price'])->name('dashboard.configuration.price')->can('show_superadmin_interface');

    //Pour les requetes HTMX 
    /* Pour changer les roles */
    Route::post('/administration/configuration/update/role/htmx',[DashboadController::class,'getHtmxData'])->name('dashboard.configuration.role.htmx')->can('show_superadmin_interface');

    /* Pour changer les roles */
    Route::patch('/administration/configuration/update/role/{user}',[DashboadController::class,'role'])->name('dashboard.configuration.role')->can('show_superadmin_interface');

    /* Creer une categorie */
    Route::post('/administration/configuration/create/categorie',[CategorieController::class,'create'])->name('dashboard.configuration.create.categorie')->can('show_administration');

    /* supprimer une categorie */
    Route::delete('/administration/configuration/delete/categorie/{categorie}',[CategorieController::class,'delete'])->name('dashboard.delete.categorie')->can('show_administration');

    /* Modification d'une categorie */
    Route::get('/administration/configuration/update/categorie/{categorie}',[CategorieController::class,'update'])->name('dashboard.update.categorie')->can('show_administration');

    Route::patch('/administration/configuration/update/categorie/{categorie}',[CategorieController::class,'saveUpdate'])->name('dashboard.update.categorie')->can('show_administration');

    //Page de Gestion des categories et des article
    Route::get('/administration/blog',[BlogController::class,'index'])->name('dashboard.blog.index')->can('show_administration');

    //Page pour Creer un article
    Route::get('/administration/create/article',[BlogController::class,'create'])->name('dashboard.blog.create.article')->can('show_administration');

    Route::post('/administration/create/article',[BlogController::class,'store'])->name('dashboard.blog.store.article')->can('show_administration');

    Route::delete('/administration/delete/article/{article}',[BlogController::class,'delete'])->name('dashboard.blog.delete.article')->can('show_administration');

    //Modification d'un article
    Route::get('/administration/update/article/{article}',[BlogController::class,'update'])->name('dashboard.blog.update.article')->can('show_administration');

    Route::patch('/administration/update/article/{article}',[BlogController::class,'saveUpdate'])->name('dashboard.blog.update.save')->can('show_administration');
    //Affiche l'editeur et son contenu lors de la modification
    Route::patch('/administration/article/htmx/{article}',[BlogController::class,'getHtmxData'])->name('dashboard.blog.htmx')->can('show_administration');

    //uploadFile via ajax (au niveau de l'editeur)
    Route::post('/administration/blog/upload/file',[BlogController::class,'uploadFile'])->name('dashboard.blog.upload.file')->can('show_administration');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
