<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Terjadi Kesalahan",
                "data" => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);

        $success["email"] = $user->email;
        $success["name"] = $user->name;

        return response()->json([
            "success" => true,
            "message" => "User created successfully.",
            "data" => $success
        ], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "success" => false,
                'message' => 'Unauthorized'], 401);
        }

        $auth = Auth::user();
        $success["token"] = $auth->createToken("auth_token")->plainTextToken;
        $success["name"]= $auth->name;
        return response()->json([
            "success" => true,
            "message" => "Login Success",
            "data" => $success
        ], 200);
    }
}