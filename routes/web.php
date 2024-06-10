<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\webradio\AvisDeRechercheController;
use App\Http\Controllers\webradio\CommuniqueController;
use App\Http\Controllers\webradio\HomeController;
use App\Http\Controllers\webradio\PaimentController;
use App\Http\Controllers\webradio\ProgrammeController;
use App\Http\Controllers\webradio\PubliciteController;
use App\Http\Controllers\webradio\ServiceController;
use App\Models\AvisDeRecherche;
use App\Models\Publicite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/grille-tarifaire',[ProgrammeController::class,'showGrille'])->name('grille');

Route::get('/service',[ServiceController::class,'index'])->name('service.list');

Route::prefix('/service')->name('service.')->middleware(['auth','verified'])->group(function() {

    /* communiqué */
    Route::get('/communique',[CommuniqueController::class,'index'])->name('communique');
    Route::post('/communique',[CommuniqueController::class,'create'])->name('communique.create');

    Route::post('/communinique/htmx',[CommuniqueController::class,'getHtmxData'])->name('communique.htmx');

    
    /* Pub */
    Route::get('/publicite',[PubliciteController::class,'index'])->name('publicite');

    Route::get('/publicite/update/{publicite}',[PubliciteController::class,'update'])->name('publicite.update');

    Route::patch('/publicite/update/{publicite}',[PubliciteController::class,'updateValidation'])->name('publicite.update.validation');

    Route::post('/publicite',[PubliciteController::class,'create'])->name('publicite.create');

    Route::delete('/publicite/delete/{publicite}',[PubliciteController::class,'delete'])->name('publicite.delete');

    Route::get('/paiment',[PaimentController::class,'paiment'])->name('paiment');

    Route::get('/paiment/redirect/{publicite}',[PaimentController::class,'redirect'])->name('paiment.redirect');

    Route::patch('/paiment',[PaimentController::class,'paimentValidation'])->name('paiment_validation');



    /* AVR */
/*     Route::get('/avis-de-recherche',[AvisDeRechercheController::class,'index'])->name('avis_de_recherche');

    Route::post('/avis-de-recherche',[AvisDeRechercheController::class,'create'])->name('avis_de_recherche.create');

    Route::get('/adr/paiment',[PaimentController::class,'adr_paiment'])->name('adr_paiment');

    Route::get('/adr/paiment/redirect/{avisDeRecherche}',[PaimentController::class,'adr_redirect'])->name('adr.paiment.redirect');

    Route::patch('/adr/paiment',[PaimentController::class,'adr_paimentValidation'])->name('adr_paiment_validation');

    Route::get('/adr/update/{avisDeRecherche}',[AvisDeRechercheController::class,'update'])->name('adr.update');

    Route::patch('/adr/update/{avisDeRecherche}',[AvisDeRechercheController::class,'updateValidation'])->name('adr.update.validation');

    Route::delete('/adr/delete/{avisDeRecherche}',[AvisDeRechercheController::class,'delete'])->name('adr.delete'); */

});



Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function() {

    Route::get('/', function () {

        $publicites=Auth::user()->publicites()->orderByDesc('id')->get(); 

        $adr=Auth::user()->avis_de_recherche()->orderByDesc('id')->get(); 
    
        return view('dashboard',[
            'publicites'=>$publicites,
            'adr'=>$adr
        ]);
        
    })->name('dashboard');


    Route::get('/validation', function () {

        $publicites=Publicite::orderByDesc('id')->get();
        $adr=AvisDeRecherche::orderByDesc('id')->get();

        return view('webradio.service.admin.admin',[
            'publicites'=>$publicites,
            'adr'=>$adr
        ]);
        
    })->name('dashboard.validation')->can('show_superadmin_dashboard');

    Route::POST('/validation', function (Request $request) {

       $type=$request->input('type');
       $status=$request->input('status');

       if($type==='publicite') {

            foreach($status as $key=>$s) {
                
                Publicite::where('id','=',$key)->update(['status'=>$s]);
                
            }

       }else if($type==='adr') {
            foreach($status as $key=>$s) {
                    
                AvisDeRecherche::where('id','=',$key)->update(['status'=>$s]);
                
            }
       }
        
       return back()->with('success','');

    })->name('dashboard.validation.update')->can('show_superadmin_dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
