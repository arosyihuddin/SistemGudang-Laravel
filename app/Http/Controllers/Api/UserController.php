<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userAuth(Request $request){
        return response()->json([
            "success" => true,
            "message" => "Authenticated user retrieved successfully.",
            "data" => $request->user()
        ], 200);
    }

    public function showHistory($id)
    {
        $user = User::with('mutasis')->findOrFail($id);

        return response()->json([
            "success" => true,
            "message" => "User mutasi history retrieved successfully.",
            "data" => $user
        ], 200);
    }
}
