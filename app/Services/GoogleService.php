<?php

namespace App\Services;

// models
use App\Models\User;

// third-party
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;


class GoogleService
{

    public function login($firebase_token)
    {

        $auth = app('firebase.auth');
        try {
            $verifiedIdToken = $auth->verifyIdToken($firebase_token);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'message' => 'The token is invalid: ' . $e->getMessage(),
            ], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $user = $auth->getUser($uid);
        $user_email = $user->email;

        $user = User::where("email", $user_email)->first();


        $token = "";
        if (!empty($user)) {
            $token = $user->createToken("user")->plainTextToken;
        } else {
            $user = new User();

            $user->email = $user_email;
            $user->save();

            $token = $user->createToken("user")->plainTextToken;
        }

        return response([
            "token" => $token,
            "data" => $user
        ], 200);
    }
}
