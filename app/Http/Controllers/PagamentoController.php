<?php   
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PagamentoConfig;
class PagamentoController extends Controller
{
    /**
     * Display the payment settings.
     */
    public function show()
    {
        $config = PagamentoConfig::first();
        return response()->json($config);
    }

    /**
     * Update the payment settings.
     */
public function update(Request $request)
{
    $validated = $request->validate([
        'dinheiro' => 'boolean',
        'cartao' => 'boolean',
        'pix' => 'boolean',
        'vale' => 'boolean',
        'taxa_cartao' => 'nullable|numeric|min:0',
        'desconto_pix' => 'nullable|numeric|min:0',
    ]);

    $config = PagamentoConfig::firstOrNew(['id' => 1]);
    $config->fill($validated);
    $config->save();

    return response()->json(['message' => 'Configurações de pagamento atualizadas com sucesso']);
}

public function criarPagamento(Request $request)
{
    $validated = $request->validate([
        'dinheiro' => 'boolean',
        'cartao' => 'boolean',
        'pix' => 'boolean',
        'vale' => 'boolean',
        'taxa_cartao' => 'numeric|nullable',
        'desconto_pix' => 'numeric|nullable',
    ]);

    $pagamento = PagamentoConfig::create($validated);

    return response()->json(['mensagem' => 'Configuração de pagamento criada com sucesso', 'pagamento' => $pagamento]);
}

}