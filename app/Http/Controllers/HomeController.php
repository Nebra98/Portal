<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = Category::all();
        $news = News::all();

        

        return view('home')->with('categories', $categories)->with('news', $news);
    }
}
