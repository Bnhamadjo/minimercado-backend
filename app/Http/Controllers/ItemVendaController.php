<?php
namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function index()
    {
        return ItemVenda::with(['venda', 'produto'])->get();
    }

    public function show($id)
    {
        return ItemVenda::with(['venda', 'produto'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $item = ItemVenda::create($request->only([
            'produto_id',
            'quantidade',
            'preco_unitario',
            'subtotal',
            'parcelas'
        ]));

        return response()->json($item, 201);
    }

    public function destroy($id)
    {
        ItemVenda::destroy($id);
        return response()->json(['message' => 'Item de venda removido com sucesso']);
    }
}