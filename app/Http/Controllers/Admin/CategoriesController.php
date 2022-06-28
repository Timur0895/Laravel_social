<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function index() {

    $categories = Category::orderBy('updated_at', 'DESC')->get();
    //dd($categories);

    return view('admin/categories')->with([
      'categories' => $categories
    ]);
  }
  
  public function addCategory(Request $request) {
    //dd($request->title);

    Category::create([
      'title' => $request->title,
      'slug' => SlugService::createSlug(Category::class, 'slug', $request->title),
    ])->save();

    //dd(Category::all());

    return redirect('admin/categories')->with('success', 'Катагория добавлена!');
  }

  public function deleteCategory($slug)
  {
    //dd($slug);
    $item = Category::where('slug', $slug)->first();

    $item->posts()->wherePivot('category_id','=', $item->id)->detach();

    //dd($itemPosts);

    $item->delete();

    return redirect('admin/categories')->with('delete', 'Катагория удалена!');
  }

  public function editCategory($id)
  {
    //dd($id);
    $item = Category::find($id);
    //dd($item);

    return view('admin/editCategory')->with('category', $item);
  }

  public function updateCategory(Request $request,  $id)
  {
    //dd($request);
    $category = Category::find($id);

    //dd($category);

    $category->update([
      'title' => $request->title,
      'slug' => SlugService::createSlug(Category::class, 'slug', $request->title),
    ]);

    //dd($category);

    return redirect('admin/categories')->with('success', 'Катагория изменена!');

  }
}