<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RelatorioConfig;
class RelatoriosController extends Controller
{
    /**
     * Display the report settings.
     */
    public function show()
    {
        $config = RelatorioConfig::first();
        return response()->json($config);
    }

    /**
     * Update the report settings.
     */

public function update(Request $request)
{
    $validated = $request->validate([
        'frequencia' => 'required|string|in:diario,semanal,mensal',
        'formato' => 'required|string|in:pdf,excel',
        'filtro_padrao' => 'required|string|in:data,produto,colaborador',
        'envio_email' => 'boolean',
        'email_destino' => 'nullable|email',
    ]);

    $config = RelatorioConfig::firstOrNew(['id' => 1]);
    $config->fill($validated);
    $config->save();

    return response()->json(['message' => 'Configurações de relatórios atualizadas com sucesso']);
}
}