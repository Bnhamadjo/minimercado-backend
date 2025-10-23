<?php
namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return Fornecedor::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'telefone' => 'nullable|string',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string',
        ]);

        return Fornecedor::create($request->all());
    }

    public function show($id)
    {
        return Fornecedor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $request->validate([
            'nome' => 'required|string',
            'telefone' => 'nullable|string',
            'email' => 'nullable|email',
            'endereco' => 'nullable|string',
        ]);
        $fornecedor->update($request->all());
        return $fornecedor;
    }

    public function destroy($id)
    {
        Fornecedor::destroy($id);
        return response()->json(['message' => 'Fornecedor removido com sucesso']);
    }
}
