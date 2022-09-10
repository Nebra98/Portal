<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Category;
use App\Comment;
use App\News;
use App\User;
use Auth;



class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();

        if(Gate::allows('delete-users')){
            return view('news.create')->with('categories', $categories);
        }
        if(Gate::denies('delete-users')){
            return back()->with('error','You do not have permission to access the specified page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $news = new News;
        $news->user_id = Auth::user()->id;
        $news->category_id = $request->category_id;
        $news->title = $request->title;
        $news->content = $request->content;

        if($news->save()){

            $request->session()->flash('success', "The news " . $news->title . ' was created successfully');
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        $user = User::find($news->user_id);

        $comments_count = Comment::where('news_id', $news->id)->count();

        return view("news.show")->with('news', $news)->with('user', $user)->with('comments_count', $comments_count);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {

        if(Gate::denies('delete-users')){
            session()->flash('error', "Something went wrong!");
            return back();
        }else{
            $news->delete();
            session()->flash('success', "News is deleted successfully.");
            return back();
            
        }

    }
}
