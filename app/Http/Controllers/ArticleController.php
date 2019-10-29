<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $articles = Article::All();
        $articles = Article::with('user')->get();
//        return $articles;
//        return view('article.index',compact("$articles"));
//        return view("task.edit",compact("task"));

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("article.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        Article::create(['title' => $request->input("title"), 'user_id' => $user_id, 'img_link' => $request->input("img_link"), 'body' => $request->input("body")]);
        return redirect()->route('My_Articles');

//        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return $id;
//        $article = Article::where('id', $id)->with('user')->with('comments')->first();
        $article = Article::where('id', $id)->with(['user','comments' => function($q) {$q->with('user'); }])->first();

        return view('article.single_article',compact('article'));
//        return $comments;
//        return $article;

    }
    public function my_articles()
    {
        $user_id = Auth::id();
        $articles = Article::where('user_id', $user_id)->with(['user','comments' => function($q) {$q->with('user'); }])->get();

        return view('article.index', compact('articles'));
//        return $comments;
//        return $article;

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $article = Article::findOrFail($id);
//        return $article;
        return view("article.edit_article",compact("article"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Article= Article::where('id', $id)->update(['title' => $request->input("title"),'img_link' => $request->input("img_link"), 'body' => $request->input("body")]);
        return redirect()->route('Article.show', ['id' => $id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        return $id;
         Article::findOrFail($id)->delete();
//        $Article = Article::where('id', $id)->delete();
        return redirect()->route('My_Articles');
    }
}
