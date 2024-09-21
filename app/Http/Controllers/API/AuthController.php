<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// importing services
use App\Services\GoogleService;

class AuthController extends Controller
{

    protected $googleAuth;

    public function __construct(GoogleService $googleService)
    {
        $this->googleAuth = $googleService;
    }



    public function login(Request $request)
    
    {
        return $this->googleAuth->login($request->firebase_token);
    }
}
