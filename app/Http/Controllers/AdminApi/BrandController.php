<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// helper function
use App\Helper\FileUploader;

// models
use App\Models\Brand;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string",
            "image" => "required|image|mimes:png,jpg,jpeg,webp"
        ]);

        $brand = new Brand();

        $brand->title = $request->title;

        if ($request->image) {
            $brand->image = FileUploader::uploadFile($request->image, "images/brands");
        }

        $brand->save();

        return response([
            "message" => "Brand Added Successfully",
            "status" => true
        ], 200);
    }

    public function get()
    {
        $brands = Brand::all();

        return response([
            "data" => $brands
        ], 200);
    }

    public function delete(Request $request)
    {
        $brand_id = $request->query("brand");

        Brand::find($brand_id)->delete();

        return response([
            "message" => "Brand Delete Successfully",
            "status" => true
        ], 200);
    }

    public function edit(Request $request)
    {
        $brand_id = $request->query("brand");
        $brand = Brand::find($brand_id);

        return response([
            "data" => $brand,
            "status" => true
        ], 200);
    }

    public function update(Request $request)
    {
        $brand_id = $request->id;

        $brand = Brand::find($brand_id);

        $brand->title = $request->title;

        if ($request->image) {
            $brand->image = FileUploader::uploadFile($request->image, "images/brand");
        }
        $brand->save();

        return response([
            "message" => "Brand Updated Successfully",
            "status" => true
        ], 200);
    }
}
