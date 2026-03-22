<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // ✅ هنا

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);

            $user->save();

            return response()->json($user);

        } catch (\Throwable $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json(['error'=>'Invalid credentials'], 401);
        }

        $token = Str::random(60);

        $user->api_token = $token;
        $user->save();

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}