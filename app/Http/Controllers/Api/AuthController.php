<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Repositories\UserRepository;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $user;
    protected $mover;
    protected $social;

    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'forgot', 'reset']]);
        $this->user = $user;
    }

    public function login(LoginRequest $request)
    {
        if (!$token = JWTAuth::attempt($request->only(['email', 'password']))) {
            throw new Exception('Invalid Credentials.', 1);
        }

        $user = auth()->user();
        $user->save();
        return $this->success(new LoginResource(['token' => $token, 'user' => auth()->user()]));
    }

    public function logout()
    {
        $user = auth()->user();
        $user->save();
        auth()->logout();
        return $this->success([], 'Logged out Successfully.');
    }

}
