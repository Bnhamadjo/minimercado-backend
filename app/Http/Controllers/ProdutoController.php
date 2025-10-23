<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
        {
    if ($request->has('codigo_barras')) {
        return Produto::where('codigo_barras', $request->codigo_barras)->first();
    }

    return Produto::with(['categoria', 'fornecedor'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'codigo_barras' => 'required|unique:produtos',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
        ]);

        return Produto::create($request->all());
    }

    public function show($id)
    {
        return Produto::with(['categoria', 'fornecedor'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
        return $produto;
    }

    public function destroy($id)
    {
        Produto::destroy($id);
        return response()->json(['message' => 'Produto removido com sucesso']);
    }

    public function produtosComBaixoEstoque()
{
    return Produto::where('quantidade', '<=', 5)->get();
}
}
