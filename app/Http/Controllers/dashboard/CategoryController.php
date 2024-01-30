<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        $categories =  Category::all();
        return view('dashboard.category',['categories'=>$categories]);
    }

    public function createCategory(Request $request){
        $file = $request->file('thumbnail');
        $path = $file->store('public/category');
        $expath = explode('/',$path);
        Category::create([
            'name'=>$request->input('categoryname'),
            'description'=>$request->input('description'),
            'thumbnail'=>$expath[1].'/'.$expath[2],
        ]);
        return redirect('dashboard/categories');
    }

    public function deleteCategory($id){
        $category = Category::find($id);
        $imgpath =  $category->thumbnail;
        unlink(public_path('storage/'.$imgpath));
        $category->delete();
        return redirect('dashboard/categories');
    }
}
