<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// models
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required|string"
        ]);

        $admin = Admin::where("email", $request->email)->first();


        if ($admin) {
            $is_password_correct = Hash::check($request->password, $admin->password);

            if ($is_password_correct) {
                $token = $admin->createToken("admin")->plainTextToken;

                return response([
                    "message" => "Login successful",
                    "token" => $token
                ], 200);
            }
        }

        return response([
            "message" => "Username or Password Incorrect",
            "status" => true
        ], 400);
    }

    public function createAdmin(Request $request)
    {
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return response([
            "message" => "Admin Created Successfully",
            "status" => true
        ], 200);
    }
}
