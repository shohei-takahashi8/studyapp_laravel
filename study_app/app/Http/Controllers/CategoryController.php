<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateCategory;
use App\Category;

class CategoryController extends Controller
{

    public function index() {
        $categories = Auth::user()->categories()->get();

        return view('category/index', [
            'categories' => $categories,
        ]);
    }

    public function showCreateForm() {
        return view('category/create');
    }
    
    public function create(CreateCategory $request) {
        $category = new Category();
        $category->title = $request->title;
        Auth::user()->categories()->save($category);
        
        return redirect('/category');
    }
    
    public function showEditForm(Category $category) {
        $current_category = Category::find($category->id);

        return view('category/edit', 
        ['category' => $current_category]
      );
    }

    public function edit(Category $category, CreateCategory $request) {
        $category = Category::find($category->id);

        $category->title = $request->title;
        $category->save();

        return redirect()->route('category.index');
    }

    public function delete(Category $category) {
        $category = Category::find($category->id);

        $category->delete();

        return redirect()->route('category.index');
    }

}
