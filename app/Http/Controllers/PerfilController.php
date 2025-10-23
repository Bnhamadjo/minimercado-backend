<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;    
use Illuminate\Validation\ValidationException;
use App\Models\User;
class PerfilController extends Controller
{
    /**
     * Display the user's profile.
     */
  
public function update(Request $request)
{
    $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email',
        'senha' => 'nullable|string|min:6',
        'role' => 'nullable|string',
    ]);

    

    /** @var \App\Models\User|null $user */
    $user = Auth::user();

    if (! $user instanceof User) {
        throw ValidationException::withMessages(['user' => 'Authenticated user is not a valid User model.']);
    }

    $user->nome = $request->nome;
    $user->email = $request->email;
    if ($request->filled('senha')) {
        $user->password = bcrypt($request->senha);
    }

    // Atualiza role somente se estiver presente
    if ($request->filled('role')) {
    $user->role = $request->role;
    }

    $user->save();

    return response()->json(['message' => 'Perfil atualizado com sucesso']);
}
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }
}