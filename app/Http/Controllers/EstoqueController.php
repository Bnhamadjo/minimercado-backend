<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\EstoqueConfig;
class EstoqueController extends Controller
{
    /**
     * Display the stock settings.
     */
    public function show()
    {
        $config = EstoqueConfig::first();
        return response()->json($config);
    }

    /**
     * Update the stock settings.
     */
public function update(Request $request)
{
    $validated = $request->validate([
        'unidade_padrao' => 'required|string',
        'alerta_minimo' => 'required|integer|min:0',
        'validade_ativa' => 'boolean',
        'dias_validade_alerta' => 'nullable|integer|min:0',
    ]);

    $config = EstoqueConfig::firstOrNew(['id' => 1]);
    $config->fill($validated);
    $config->save();

    return response()->json(['message' => 'Configurações de estoque atualizadas com sucesso']);
}
}