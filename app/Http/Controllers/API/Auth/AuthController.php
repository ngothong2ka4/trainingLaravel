<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
class AuthController extends Controller
{
    use ApiResponse;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth('api')->attempt($credentials);

        if (!$token) {
            return $this->error('Unauthorized',401,[]);
        }

        $user = Auth('api')->user();

        return $this->success([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]],'Login successfully',200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return $this->success([],'Successfully Logout!',200);
    }


}
