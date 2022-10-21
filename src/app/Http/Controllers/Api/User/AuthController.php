<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAuthRequest;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Authtorise
     * 
     * @param UserAuthRequest $request
     */
    public function auth(UserAuthRequest $request)
    {
        $attr = $request->toArray();

        if (!auth()->attempt($attr)) {
            return $this->response(null, 401, 'Неправильные данные для авторизации.');
        }

        $user = User::find(auth()->id());
        $token = $user->createToken('API Token')->plainTextToken;

        return $this->response([
            'token' => $token,
            'user' => $user,
        ]);
    }

    /**
     * Log out
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = auth()->user();
        
        $user->tokens()->delete();

        return $this->response(null, 200, 'Вы успешно вышли из системы');
    }
}
