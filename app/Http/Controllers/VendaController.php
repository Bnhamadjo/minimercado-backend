<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\ItemVenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;


class VendaController extends Controller
{
    public function index(Request $request)
{
    $query = Venda::with('itens.produto');

    if ($request->has('data_inicio') && $request->has('data_fim')) {
        $query->whereBetween('data_venda', [$request->data_inicio, $request->data_fim]);
    }

    if ($request->has('produto_id')) {
        $query->whereHas('itens', function ($q) use ($request) {
            $q->where('produto_id', $request->produto_id);
        });
    }

    return $query->orderBy('data_venda', 'desc')->get();
}

    public function store(Request $request)
    {
        $request->validate([
            'valor_total' => 'required|numeric',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $venda = Venda::create([
                'valor_total' => $request->valor_total,
                'data_venda' => now(),
            ]);

           foreach ($request->itens as $item) {
    $produto = Produto::find($item['produto_id']);

    if ($produto->quantidade < $item['quantidade']) {
        DB::rollBack();
        return response()->json([
            'error' => 'Estoque insuficiente para o produto: ' . $produto->nome
        ], 400);
    }

    $produto->decrement('quantidade', $item['quantidade']);

    ItemVenda::create([
        'venda_id' => $venda->id,
        'produto_id' => $produto->id,
        'quantidade' => $item['quantidade'],
        'preco_unitario' => $item['preco_unitario'],
        'subtotal' => $item['quantidade'] * $item['preco_unitario'],
    ]);
}

            DB::commit();
            return response()->json($venda->load('itens.produto'), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao registrar venda'], 500);
        }
    }

    public function show($id)
    {
        return Venda::with('itens.produto')->findOrFail($id);
    }

    public function destroy($id)
    {
        Venda::destroy($id);
        return response()->json(['message' => 'Venda removida com sucesso']);
    }

    public function registrarVendaPorCodigo(Request $request)
{
    $request->validate([
        'codigo_barras' => 'required|exists:produtos,codigo_barras',
        'quantidade' => 'required|integer|min:1',
    ]);

    $produto = \App\Models\Produto::where('codigo_barras', $request->codigo_barras)->first();

    if ($produto->quantidade < $request->quantidade) {
        return response()->json(['error' => 'Estoque insuficiente'], 400);
    }

    DB::beginTransaction();

    try {
        $subtotal = $produto->preco * $request->quantidade;

        $venda = Venda::create([
            'valor_total' => $subtotal,
            'data_venda' => now(),
        ]);

        ItemVenda::create([
            'venda_id' => $venda->id,
            'produto_id' => $produto->id,
            'quantidade' => $request->quantidade,
            'preco_unitario' => $produto->preco,
            'subtotal' => $subtotal,
        ]);
        
  // Adicionar o total à resposta
    $venda->total = $venda->valor_total;

        $produto->decrement('quantidade', $request->quantidade);

        DB::commit();
        return response()->json($venda->load('itens.produto'), 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['error' => 'Erro ao registrar venda'], 500);
    }
}

    public function vendasPorProduto($codigo_barras)
    {
    $produto = Produto::where('codigo_barras', $codigo_barras)->firstOrFail();

    return Venda::whereHas('itens', function ($q) use ($produto) {
        $q->where('produto_id', $produto->id);
    })->with('itens.produto')->get();
    }

}