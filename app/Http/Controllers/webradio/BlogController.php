<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateArticleFormRequest;
use App\Http\Requests\webradio\UpdateArticleFormRequest;
use App\Models\webradio\Article;
use App\Models\webradio\Blogfile;
use App\Models\webradio\Categorie;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Str;

class BlogController extends Controller
{

    //Affiche les articles et les categories
    public function index() {

        
        $categories=Categorie::orderByDesc('id')->paginate(perPage:20,pageName:'categorie');

        $articles=Article::orderByDesc('id')->paginate(perPage:10,pageName:'article');

        return view('webradio.blog.blog',['categories'=>$categories,'articles'=>$articles]); 
    }

    //affiche le formulaire pour creer une categorie
    public function create (Request $request) {
        
        
        $data=json_decode($request->old('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $categories=Categorie::all();

        return view('webradio.blog.new_article',['categories'=>$categories]);
    }

    //Enregistrer la categorie creer dans la base de donner
    public function store(CreateArticleFormRequest $request) {
        
        $data=json_decode($request->validated('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $fields=$request->validated();

        $fields['article_slug']=Str::slug( $fields['article_title'] );

        $fields['isOnline']=empty($fields['isOnline'])?0:$fields['isOnline'];

       

         //Create directory
         if( Storage::disk('public')->directoryMissing('blogfiles')) {

            Storage::disk('public')->makeDirectory('blogfiles');
        }


        /**
         * @var  UploadedFile
         * 
         */

        $image=$request->validated("article_principal_image");

        $fields['article_principal_image']=$this->uploadImage($image,'blogfiles');
        
        //Creation de l'article
       $article=Auth::user()->articles()->create($fields);

       $res=false;
       //Association article categorie
       if($article->exists()) {
            $categorieId=(int)$fields['categorie'];
            $res=$article->categorie()->associate($categorieId)->save();
       }

       $data=json_decode($request->validated('blog_valide_files'))??[];

       //Ajout des images du blog dans la base de donnees
       if($res && !empty($data)) {
        
            $pathList=array_map(function($path) use($article) {

                $basename='blogfiles/'.pathinfo($path,PATHINFO_BASENAME);

                return ['path'=>$basename];

            },$data);
            
           $article->blogfiles()->createMany($pathList);
        
       }
       

       return $res?redirect()->route('dashboard.blog.index')->with('success','OK'):redirect()->route('dashboard.blog.index')->with('error','ERROR');
        

    }

    //Afficher le formulaire pour une mise a jour
    public function update(Request $request,Article $article) {
        
        $data=json_decode($request->old('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $categories=Categorie::all();

        return view('webradio.blog.update_article',['article'=>$article,'categories'=>$categories]);
    }


    //Sauvegarder les mises a jours
    public function saveUpdate(UpdateArticleFormRequest $request,Article $article) {
        
        $data=json_decode($request->validated('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $fields=$request->validated();

        $fields['article_slug']=Str::slug( $fields['article_title'] );

        $fields['isOnline']=empty($fields['isOnline'])?0:$fields['isOnline'];

       

         //Create directory
         if( Storage::disk('public')->directoryMissing('blogfiles')) {

            Storage::disk('public')->makeDirectory('blogfiles');
        }


        /**
         * @var  UploadedFile
         * 
         */

        $image=$request->validated("article_principal_image");

        $fields['article_principal_image']=$this->uploadImage($image,'blogfiles',$article);

       
        
        //Update article
       $articleIsUpdate=$article->update($fields);

       

       $res=false;
       //Update Association article categorie
       if($articleIsUpdate) {
            $categorieId=(int)$fields['categorie'];

            $article->categorie_id=$categorieId;

            $res=$article->save();
       }

       $data=json_decode($request->validated('blog_valide_files'))??[];

       //supression des anciennennt image de l'article
       $article->blogfiles()->delete();

       //Ajout des images du blog dans la base de donnees
       if($res && !empty($data)) {
        
            $pathList=array_map(function($path) {

                $basename='blogfiles/'.pathinfo($path,PATHINFO_BASENAME);

                return ['path'=>$basename];

            },$data);
            
           $article->blogfiles()->createMany($pathList);
        
       }
       

        
       return $articleIsUpdate?redirect()->route('dashboard.blog.index')->with('success','OK'):redirect()->route('dashboard.blog.index')->with('error','ERROR');
    }

    //Supression d'un article
    public function delete(Article $article) {

        $fileSysteme=Storage::disk('public');

        //Suppression de fichier
        if($fileSysteme->exists($article->article_principal_image)) {
            $fileSysteme->delete($article->article_principal_image);
        }

        $article->blogfiles()->each(function(Blogfile $blogfile) use($fileSysteme) {

            if($fileSysteme->exists($blogfile->path)) {
                $fileSysteme->delete($blogfile->path);
            }
        });

        //Supression de l'article
        $res=$article->delete();

        return $res?redirect()->route('dashboard.blog.index')->with('success','Suppression OK'):redirect()->route('dashboard.blog.index')->with('error','Suppression ERROR');
    }

    //Enregistrer les images reçu de l'editeur via ajax
    public function uploadFile(Request $request) {


        //$debug=$request->file('editor_file')->getClientOriginalExtension();

        $file=$request->file('editor_file');
        $badExtentions=['php','js','html'];

        $inBadExtentionArray=in_array($file->getClientOriginalExtension(),$badExtentions);

        abort_if($inBadExtentionArray,500);

        //Limite la taille des fichiers a 48Mo
        abort_if($file->getSize()>48000000,500);
        
        abort_unless($file->isValid(),500);
        abort_unless($file->isFile(),500);
        
        $path=$file->store('blogfiles','public');

        $fullPath=asset('storage/'.$path);

        return response()->json($fullPath);
    }


    //Supprime les fichiers que l'utilisateur à supprimer au niveau de l'editeur
    public function dropOldEditorFiles(array $pathList) {


        if(!empty($pathList)) {

            foreach($pathList as $oldFile) {
                $basename='blogfiles/'.pathinfo($oldFile,PATHINFO_BASENAME);

                $fileExist=Storage::disk('public')->fileExists($basename);

                if($fileExist) {
                    Storage::disk('public')->delete($basename);
                }
                
            }
        }

    }

    //Enregistrer les images de l'article
    private function uploadImage(UploadedFile|null $image,string $directory_name,?Article $article=null):string|null {

        $imagePath=$article->article_principal_image??null;

        //Case image is uploades 

        if( 
            $image && 
            $image->isValid() && 
            $image->getError()===UPLOAD_ERR_OK &&
            empty($article)
        ) {
            $imagePath=$image->store($directory_name,'public');

        }

        


        //Case:image is uploaded and old image exist in DB
  
        if( 
            $image && 
            $image->isValid() && 
            $image->getError()===UPLOAD_ERR_OK &&
            !empty($article?->article_principal_image)
        ) {

            $path=$article->article_principal_image;

            //Delete old image
            if( Storage::disk('public')->exists($path) ) {

                Storage::disk('public')->delete($path);
            }

            $imagePath=$image->store($directory_name,'public');

        }

        return $imagePath;
       

    }

        /**
     * Pour la gestion des requetes avec htmx
     *Pour afficher l'editeur
     * @param Request $request
     * @return mixed
     */
    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.blog.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
