<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth:api", ["except" => ["login", 'register']]);
    }
/**
     * @param Request $request
     * verify token
     */
    public function register(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required",
            "name" => "required",
        ]);
        try {
            if($request->password !== $request->confirm_password){
                throw new Exception('Password not match');
            }
                $user = User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => bcrypt($request->password),
                ]);
            if ($token = $this->guard()->login($user)) {
                return response()
                    ->json(["status" => "success", "data" => $user], 200)
                    ->header("Authorization", $token);
            }
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 401);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     */

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if ($token = $this->guard()->attempt($credentials)) {
            return response()
                ->json(["status" => "success"], 200)
                ->header("Authorization", $token);
        }
        return response()->json(["error" => "login_error"], 401);
    }
    /**
     * Get the current user
     *
     * GET /api/auth/me
     */
    public function me()
    {
        return response()->json(Auth::user());
    }

    /**
     * Refresh a token.
     *  POST /api/auth/refresh
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     *
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
        ]);
    }

    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}