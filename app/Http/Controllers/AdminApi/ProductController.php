<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "brand_id" => "required|exists:brands,id",
            "category_id" => "required|exists:categories,id",
            "title" => "required|string",
            "price" => "required",
        ]);

        $product = new Product();

        $product->title = $request->title;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return response([
            "message" => "Product Added Successfully",
            "status" => true
        ], 200);
    }
}
