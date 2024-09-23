<?php

namespace App\Http\Controllers\AdminApi;

use App\Helper\FileUploader;
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

        if ($request->image) {
            $category->image = FileUploader::uploadFile($request->image, "/images/category");
        }

        $category->save();

        return response([
            "message" => "Category Added Successfully"
        ], 200);
    }

    public function delete(Request $request)
    {
        $category_id = $request->query("id");

        Category::find($category_id)->delete();

        return response([
            "message" => "Category Deleted Successfully",
            "status" => true
        ], 200);


    }
}
