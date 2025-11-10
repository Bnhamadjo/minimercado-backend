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
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'produto_id' => 'required|exists:produtos,id',
        'tipo' => 'required|in:entrada,saida',
        'quantidade' => 'required|integer|min:1',
        'motivo' => 'nullable|string',
        'data_validade' => 'nullable|date',
    ]);

    $produto = Produto::findOrFail($validated['produto_id']);

    if ($validated['tipo'] === 'saida' && $produto->quantidade < $validated['quantidade']) {
        return response()->json(['erro' => 'Estoque insuficiente'], 400);
    }

    DB::transaction(function () use ($validated, $produto) {
        // Atualiza o estoque do produto
        if ($validated['tipo'] === 'entrada') {
            $produto->increment('quantidade', $validated['quantidade']);
        } else {
            $produto->decrement('quantidade', $validated['quantidade']);
        }

        // Registra a movimentação
        MovimentacaoEstoque::create([
            'produto_id' => $produto->id,
            'tipo' => $validated['tipo'],
            'quantidade' => $validated['quantidade'],
            'motivo' => $validated['motivo'] ?? '',
            'data_validade' => $validated['data_validade'] ?? null,
        ]);
    });

    
    return response()->json(['mensagem' => 'Movimentação registrada com sucesso']);
}

  
}
