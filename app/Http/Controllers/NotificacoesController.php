<?php
namespace App\Http\Controllers;
use App\Models\NotificacaoConfig;
use Illuminate\Http\Request;
class NotificacoesController extends Controller
{
public function update(Request $request)
{
    $validated = $request->validate([
        'alerta_vencimento' => 'boolean',
        'alerta_estoque_baixo' => 'boolean',
        'alerta_venda_alta' => 'boolean',
        'canal_email' => 'boolean',
        'canal_popup' => 'boolean',
        'canal_sms' => 'boolean',
    ]);

    $config = NotificacaoConfig::firstOrNew(['id' => 1]);
    $config->fill($validated);
    $config->save();

    return response()->json(['message' => 'Notificações atualizadas com sucesso']);
}

/**
     * Display the notification settings.
     */
    public function show()
    {
        $config = NotificacaoConfig::first();
        return response()->json($config);

    }

    

}

    