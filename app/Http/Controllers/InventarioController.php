<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{

    public function inventario()
{
    $produtos = Produto::with(['categoria', 'fornecedor'])->get();

    // Calcula subtotal e lucro de cada produto
    $produtos->map(function ($produto) {
        // Total em estoque
        $produto->subtotal = $produto->preco * $produto->quantidade;

        // Total vendido deste produto
        $quantidadeVendida = DB::table('itens_venda')
            ->where('produto_id', $produto->id)
            ->sum('quantidade');

        $produto->quantidade_vendida = $quantidadeVendida;

        // Lucro: (preço_venda - preço_custo) * quantidade vendida
        $produto->lucro_total = ($produto->preco - $produto->preco_custo) * $quantidadeVendida;

        return $produto;
    });

    $vendasTotais = Venda::sum('valor_total');
    $lucroTotal = $produtos->sum('lucro_total');

    return response()->json([
        'produtos' => $produtos,
        'vendasTotais' => $vendasTotais,
        'lucroTotal' => $lucroTotal,
    ]);
}

    public function index()
    {


        $produtos = Produto::with(['categoria', 'fornecedor'])->get();
        $vendas = Venda::with(['itens.produto'])->get();

        $dados = [
            'total_produtos' => $produtos->count(),
            'estoque_total' => $produtos->sum('quantidade'),
            'valor_total_estoque' => $produtos->sum(fn($p) => $p->preco * $p->quantidade),
            'total_vendas' => $vendas->count(),
            'valor_total_vendas' => $vendas->sum('valor_total'),
            'lucro_estimado' => $vendas->flatMap->itens->sum(function ($item) {
                $precoVenda = $item->preco_unitario ?? 0;
                $precoCusto = $item->produto->preco ?? 0;
                return ($precoVenda - $precoCusto) * ($item->quantidade ?? 0);
            }),
            'produtos' => $produtos,
            'vendas' => $vendas,
        ];

        return response()->json($dados);
    }
}
