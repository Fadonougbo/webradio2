<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateArticleFormRequest;
use App\Models\webradio\Article;
use App\Models\webradio\Categorie;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Number;
use Str;

class BlogController extends Controller
{

    public function index() {

        
        $categories=Categorie::orderByDesc('id')->get();
        $articles=Article::orderByDesc('id')->get();
        return view('webradio.blog.blog',['categories'=>$categories,'articles'=>$articles]); 
    }

    public function create (Request $request) {
        
        
        $data=json_decode($request->old('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $categories=Categorie::all();
        return view('webradio.blog.new_article',['categories'=>$categories]);
    }

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

    public function update(Request $request,Article $article) {
        
        $data=json_decode($request->old('blog_files_need_drop'))??[];

        $this->dropOldEditorFiles($data);

        $categories=Categorie::all();

        return view('webradio.blog.update_article',['article'=>$article,'categories'=>$categories]);
    }

    public function saveUpdate(Request $request) {
        dump($request->all());
    }

    public function delete(Article $article) {
        $res=$article->delete();

        return $res?redirect()->route('dashboard.blog.index')->with('success','Suppression OK'):redirect()->route('dashboard.blog.index')->with('error','Suppression ERROR');
    }

    public function uploadFile(Request $request) {


        //$debug=$request->file('editor_file')->getClientOriginalExtension();

        $file=$request->file('editor_file');
        $badExtentions=['php','js'];

        $inBadExtentionArray=in_array($file->getClientOriginalExtension(),$badExtentions);

        abort_if($inBadExtentionArray,500);

        //Limite la taille des fichiers a 19Mo
        abort_if($file->getSize()>19000000,500);
        
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

    private function uploadImage(UploadedFile $image,string $directory_name):string|null {

        $imagePath=null;

        //Case image is uploades 

        if( 
            $image && 
            $image->isValid() && 
            $image->getError()===UPLOAD_ERR_OK
        ) {
            $imagePath=$image->store($directory_name,'public');

        }

        


        //Case:image is uploaded and old image exist in DB
  
        /* if( 
            $store_image && 
            $store_image->isValid() && 
            $store_image->getError()===UPLOAD_ERR_OK &&
            !empty(Auth::user()->store->store_image)
        ) {

            $path=Auth::user()->store->store_image;

            Delete old image
            Storage::disk('public')->delete($path);

            $imagePath=$store_image->store($store_files_directory_name,'public');

        } */

        return $imagePath;
       

    }

        /**
     * Pour la gestion des requetes avec htmx
     *
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
