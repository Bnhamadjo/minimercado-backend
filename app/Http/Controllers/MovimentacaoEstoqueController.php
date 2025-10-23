<?php

namespace App\Http\Controllers;

use App\Models\MovimentacaoEstoque;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class MovimentacaoEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function indexMovimentacoes(Request $request)
{
    $query = MovimentacaoEstoque::with('produto');

    if ($request->has('data_inicio') && $request->has('data_fim')) {
        $query->whereBetween('created_at', [$request->data_inicio, $request->data_fim]);
    }

    if ($request->has('tipo')) {
        $query->where('tipo', $request->tipo);
    }

    return $query->orderBy('created_at', 'desc')->get();
}

   // keep a simple index method that forwards to the unique implementation
   public function index(Request $request)
{
    return $this->indexMovimentacoes($request);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'produto_id' => 'required|exists:produtos,id',
        'tipo' => 'required|in:entrada,saida',
        'quantidade' => 'required|integer|min:1',
        'motivo' => 'nullable|string',
    ]);

    $produto = Produto::findOrFail($request->produto_id);

    if ($request->tipo === 'saida' && $produto->quantidade < $request->quantidade) {
        return response()->json(['erro' => 'Estoque insuficiente'], 400);
    }

    DB::transaction(function () use ($request, $produto) {
        MovimentacaoEstoque::create($request->all());

        $request->tipo === 'entrada'
            ? $produto->increment('quantidade', $request->quantidade)
            : $produto->decrement('quantidade', $request->quantidade);
    });

    return response()->json(['mensagem' => 'Movimentação registrada com sucesso']);
}

    /**
     * Display the specified resource.
     */
    public function show(MovimentacaoEstoque $movimentacaoEstoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovimentacaoEstoque $movimentacaoEstoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MovimentacaoEstoque $movimentacaoEstoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovimentacaoEstoque $movimentacaoEstoque)
    {
        //
    }

    
}
