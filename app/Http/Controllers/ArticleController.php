<?php

namespace App\Http\Controllers;

use App\Article;
use Auth;
use Validator;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function index(Request $request)
    {
        $articles = Auth::user()->articles;
        return view('home')->with(['articles' => $articles]);
    }

    protected function create(Request $request)
    {
        $article = new Article();
        $data = $request->all();
        $article->content = $data['content'];
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect('home');
    }
}