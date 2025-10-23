<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutos = Produto::count();
        $totalVendas = Venda::count();
        $valorTotalVendido = Venda::sum('valor_total');

        return response()->json([
            'total_produtos' => $totalProdutos,
            'total_vendas' => $totalVendas,
            'valor_total_vendido' => $valorTotalVendido,
        ]);
    }

    public function graficoVendas()
{
    $vendas = Venda::selectRaw('DATE(data_venda) as dia, SUM(valor_total) as total')
        ->groupBy('dia')
        ->orderBy('dia')
        ->get();

    $labels = $vendas->pluck('dia')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M'));
    $data = $vendas->pluck('valor_total');

    return response()->json([
        'labels' => $labels,
        'datasets' => [[
            'label' => 'Vendas por Dia',
            'data' => $data,
            'fill' => true,
            'tension' => 0.4,
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0,123,255,0.2)'
        ]]
    ]);
}
}
