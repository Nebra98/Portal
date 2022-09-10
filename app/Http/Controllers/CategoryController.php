<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\News;
use App\User;
use Auth;
use Gate;
use DB;

class CategoryController extends Controller
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

        if(Gate::allows('delete-users')){
            return view('category.create');
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
            'name' => 'required',
        ]);

        $category = new Category;
        $category->user_id = Auth::user()->id;
        $category->name = $request->name;

        if($category->save()){

            $request->session()->flash('success', "The category " . $category->name . ' was created successfully');
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
        
        $category = Category::find($id);
        $categories = Category::all();

        $news = News::all()->where('category_id', $id);


        return view('category.show')->with('category', $category)->with('news', $news)->with('categories', $categories);

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
    public function destroy(Category $category)
    {

        if(Gate::denies('delete-users')){
            session()->flash('error', "Something went wrong!");
            return back();
        }else{
            $category->delete();
            session()->flash('success', "Category is deleted successfully.");
            return back();
            
        }

    }
}
