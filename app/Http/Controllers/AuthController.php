<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
  use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
 

public function login(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['token' => $token], 200);
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }


    public function resetPassword(Request $request)
{
    // Validação básica
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'new_password' => 'required|string|min:6',
    ]);

    // Busca usuário pelo email
    $user = User::where('email', $request->email)->first();

    // Atualiza senha com hash
    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json([
        'message' => 'Senha redefinida com sucesso'
    ], 200);
}


    public function createToken($user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}