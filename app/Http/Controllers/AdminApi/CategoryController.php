<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// models
use App\Models\Category;

class CategoryController extends Controller
{
    public function get()
    {
        $data = Category::all();

        return response([
            "data" => $data,
            "status" => true
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "image" => "required|image"
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->image = $request->image;

        $category->save();

        return response([
            "message" => "Category Added Successfully"
        ], 200);
    }

    public function delete(Request $request)
    {
        $category_id = $request->query("category_id");


    }
}
