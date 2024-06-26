<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateCategorieRequest;
use App\Http\Requests\webradio\UpdateCategorieRequest;
use App\Models\webradio\Categorie;

class CategorieController extends Controller
{
    public function create(CreateCategorieRequest $request) {
        $name=$request->input('categorie_name');

        $res=Categorie::create(['name'=>$name]);

        return $res?redirect()->route('dashboard.blog.index')->with('success','La categorie a été créé avec succès.'):redirect()->route('dashboard.blog.index')->with('error',"Une erreur est survenue lors de la creation d'une categorie. Veuillez réessayer plus tard.");
    }

    //Page de modification
    public function update(Categorie $categorie) {

        return view('webradio.blog.update_categorie',['categorie'=>$categorie]);
    }

    /* Valider les modifications */
    public function saveUpdate(UpdateCategorieRequest $request,Categorie $categorie) {
        
        $name=$request->validated('categorie_name');

        $res=$categorie->update(['name'=>$name]);

        return $res?redirect()->route('dashboard.blog.index')->with('success','La categorie a été modifiée avec succès.'):redirect()->route('dashboard.blog.index')->with('error',"Une erreur est survenue lors de la modification . Veuillez réessayer plus tard.");
    }

    public function delete(Categorie $categorie) {

        $res=$categorie->delete();

        return $res?redirect()->route('dashboard.blog.index')->with('success','La categorie a été supprimé avec succès.'):redirect()->route('dashboard.blog.index')->with('error',"Une erreur est survenue lors de la suppression de cette categorie. Veuillez réessayer plus tard.");

    }
}
