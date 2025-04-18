<?php

namespace App\Http\Controllers;

use App\ApiResponseTrait;
use App\Http\Requests\LoginRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                throw new ModelNotFoundException('invalid username and password');
            }
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                'token' => $token,
                'user' => $user
            ];
            return $this->successResponse($data,"login successfully",200);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Invalid credentials', 401);
        } catch (Exception $e) {
            return $this->errorResponse('Server Error', 500);
        }
    }
}
