<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

// helper function

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "image" => "required|image",
        ]);

        $category = new Category();
        $category->title = $request->title;

        if ($request->image) {
            $category->image = $request->image;
        }

        $category->save();

        return response([
            "message" => "Category Added Successfully",
            "status" => true
        ], 201);
    }

    public function get(Request $request){

    }
}
