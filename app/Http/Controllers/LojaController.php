<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loja;

class LojaController extends Controller
{
    /**
     * Display the store settings.
     */
    public function show()
    {
        $loja = Loja::first();
        return response()->json($loja);
    }

    /**
     * Update the store settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nome_loja' => 'required|string',
            'cnpj' => 'required|string',
            'endereco' => 'required|string',
            'telefone' => 'required|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        $loja = Loja::firstOrNew(['id' => 1]);
        $loja->fill($validated);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $loja->logo = $path;
        }

        $loja->save();

        return response()->json(['message' => 'Configurações da loja atualizadas com sucesso']);
    }
}