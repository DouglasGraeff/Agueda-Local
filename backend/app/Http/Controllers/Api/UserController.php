<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Obter perfil do utilizador autenticado
     * Retorna dados completos do utilizador e timestamps
     */
    public function me(\Illuminate\Http\Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'data' => [
                'user' => [
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'user_type' => $user->userType?->name,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ],
            ],
        ], 200);
    }

    /**
     * Atualizar dados do perfil do utilizador
     * Permite atualizar nome, email, telefone e palavra-passe (com verificação de atual)
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        try {
            // Verificar password atual se quer alterar a password
            if ($request->filled('password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return response()->json([
                        'message' => 'Palavra-passe atual inválida',
                    ], 422);
                }

                $user->password = Hash::make($request->password);
            }

            // Atualizar campos opcionais
            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            if ($request->filled('phone')) {
                $user->phone = $request->phone;
            }

            $user->save();

            return response()->json([
                'message' => 'Perfil atualizado com sucesso',
                'data' => [
                    'user' => [
                        'uuid' => $user->uuid,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'user_type' => $user->userType?->name,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ],
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao atualizar perfil',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ver perfil público de um utilizador
     * Retorna apenas informações públicas (uuid, nome, tipo de utilizador)
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'data' => [
                'user' => [
                    'uuid' => $user->uuid,
                    'name' => $user->name,
                    'user_type' => $user->userType?->name,
                    'created_at' => $user->created_at,
                ],
            ],
        ], 200);
    }

    /**
     * Eliminar a conta do utilizador
     * Apenas o próprio utilizador pode deletar a sua conta
     */
    public function destroy(\Illuminate\Http\Request $request, User $user): JsonResponse
    {
        // Verificar permissão - apenas o dono da conta pode deletá-la
        if ($request->user()->id !== $user->id) {
            return response()->json([
                'message' => 'Não tem permissão para eliminar esta conta',
            ], 403);
        }

        try {
            $user->delete();

            return response()->json([
                'message' => 'Conta eliminada com sucesso',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao eliminar conta',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
