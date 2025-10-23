<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|unique:categorias,nome',
        ]);

        return Categoria::create($request->all());
    }

    public function show($id)
    {
        return Categoria::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $request->validate([
            'nome' => 'required|string|unique:categorias,nome,' . $id,
        ]);
        $categoria->update($request->all());
        return $categoria;
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return response()->json(['message' => 'Categoria removida com sucesso']);
    }
}
