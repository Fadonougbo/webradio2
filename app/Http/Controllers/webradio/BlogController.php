<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateArticleFormRequest;
use App\Models\webradio\Categorie;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index() {
        $categories=Categorie::orderByDesc('id')->get();

        return view('webradio.blog.blog',['categories'=>$categories]); 
    }

    public function create () {
        
        $categories=Categorie::all();
        return view('webradio.blog.new_article',['categories'=>$categories]);
    }

    public function store(CreateArticleFormRequest $request) {
        dump($request->validated());
    }

    public function uploadFile(Request $request) {


        $debug=$request->file('editor_file')->getClientOriginalExtension();

        $file=$request->file('editor_file');
        $badExtentions=['php','js'];

        $inBadExtentionArray=in_array($file->getClientOriginalExtension(),$badExtentions);

        abort_if($inBadExtentionArray,500);
        
        abort_unless($file->isValid(),500);
        abort_unless($file->isFile(),500);
        
        $path=$file->store('blogfiles','public');

        $fullPath=asset('storage/'.$path);

        return response()->json($fullPath);
    }
}
