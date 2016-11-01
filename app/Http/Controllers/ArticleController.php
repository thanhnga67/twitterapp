<?php

namespace App\Http\Controllers;

use App\Article;
use Auth;
use Response;
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
    
    public function index(Request $request)
    {
        $total = Auth::user()->articles()->count();
        $articles = Auth::user()->articles()->orderBy('created_at', 'desc')->take(config('constant.block_tweet'))->get();
        if($request->ajax()){
            $downarticle = view('Articles', array('articles' => $articles))->render();
            return response()->json(array('downarticle' => $downarticle));
        }
        return view('home', ['articles' => $articles, 'total' => $total]);
    }

    public function createArticle(Request $request)
    {
        $rules = array(
            'content' => 'required|max:140',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()), 422);
        }
        $article = new Article();
        $data = $request->all();
        $article->content = $data['content'];
        $article->user_id = $request->user()->id;
        $article->save();
        $articles = Auth::user()->articles;
        $uparticle = view('Article')->with(['article' => $article])->render();
        return response()->json(['uparticle' => $uparticle, 'article' => $article]);
    }

    public function getNextPage(Request $request)
    {
        if($request->ajax()){
            $offset = $request['offset'];
            $articles = Auth::user()->articles()->orderBy('created_at', 'desc')->take(config('constant.block_tweet'))->skip($offset)->get();
            $flag = count(Auth::user()->articles()) - count($offset);
            $downarticle = view('Articles', array('articles' => $articles))->render();
            return response()->json(array('downarticle' => $downarticle, 'flag' => $flag));
        }
    }
}
