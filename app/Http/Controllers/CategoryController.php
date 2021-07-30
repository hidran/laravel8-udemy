<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $rules = [
        'category_name' => 'required',

    ];

    protected $messages = [
        'category_name.required' => 'Field name is required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $categories =auth()->user()->categories()->paginate(10);

        $categories = Category::getCategoriesByUserId(auth()->user())->paginate(10);
        $category = new Category();
       return view('categories.index', compact('categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
      return view('categories.create')->withCategory($category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules,$this->messages);
      $res =  Category::create([
           'category_name' => $request->category_name,
           'user_id' => auth()->id()
       ]);
      $message = $res ? 'Category created' : 'Problem creating category '.$request->category_name;
      session()->flash('messages', $message);
      if($request->expectsJson()){
          return [
              'message' => $message,
              'success' => $res,
              'data' => $res
          ];
      }
      return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, $this->rules, $this->messages);
         $category->category_name = $request->category_name;
        $res = $category->save();
        $message = $res ? 'Category updated' : 'Problem updating category '.$request->category_name;
        session()->flash('messages', $message);
        if($request->expectsJson()){
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $res = $category->delete();
        $message = $res ? 'Category deleted' : 'Problem deleting category';
        session()->flash('messages', $message);
        if($request->expectsJson()){
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }
}
