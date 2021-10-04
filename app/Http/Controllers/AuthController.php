<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Http\Traits\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    use ApiController;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        Log::debug("ーーーーーーー");
        Log::debug($credentials);
        Log::debug("ーーーーーーー");


        if (!$token = auth()->attempt($credentials)) {
            throw new UnauthorizedException(
                'メールアドレスかパスワードが誤っています',
                401,
                '認証情報が不正です'
            );
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
