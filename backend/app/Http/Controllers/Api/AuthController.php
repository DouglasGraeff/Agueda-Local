<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register new user
     * 
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $validated['uuid'] = Str::uuid();

        $user = User::create($validated);

        // Create JWT token
        $token = auth('jwt')->login($user);

        return response()->json([
            'message' => 'Utilizador registado com sucesso',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'user_type_id' => $user->user_type_id,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 201);
    }

    /**
     * Login user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'password.required' => 'A palavra-passe é obrigatória',
        ]);

        $token = auth('jwt')->attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Email ou palavra-passe inválidos',
            ], 401);
        }

        $user = auth('jwt')->user();

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'user_type_id' => $user->user_type_id,
                ],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],
        ], 200);
    }

    /**
     * Logout user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        auth('jwt')->logout();

        return response()->json([
            'message' => 'Logout realizado com sucesso',
        ], 200);
    }
}
