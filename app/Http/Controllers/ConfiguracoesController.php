<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Loja;
use App\Models\EstoqueConfig;
use App\Models\NotificacaoConfig;
use App\Models\PagamentoConfig;
use App\Models\PermissaoConfig;

class ConfiguracoesController extends Controller
{
    // GET: /configuracoes
    public function index()
    {
        return response()->json([
            'loja' => Loja::first(),
            'estoque' => EstoqueConfig::first(),
            'notificacoes' => NotificacaoConfig::first(),
            'pagamento' => PagamentoConfig::first(),
            'permissoes' => PermissaoConfig::all(),
            'perfil' => Auth::user(),
        ]);
    }

    // PERFIL (vinculado ao usuário autenticado)
    public function perfil()
    {
        return response()->json(Auth::user());
    }

    public function atualizarPerfil(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        

        return response()->json(['mensagem' => 'Perfil atualizado com sucesso', 'perfil' => $user]);
    }

    public function listarPerfis()
{
    return response()->json(User::select('id', 'name', 'email', 'perfil')->get());
}


    // LOJA
    public function loja()
    {
        return response()->json(Loja::first());
    }

    public function atualizarLoja(Request $request)
{
    $loja = Loja::firstOrFail();

    // Atualiza campos de texto
    $loja->update($request->only($loja->getFillable()));

    // Se houver logo enviado
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $logoPath = $logo->store('public/logos'); // salva em storage/app/public/logos
        $loja->logo_url = asset(str_replace('public/', 'storage/', $logoPath)); // gera URL pública
        $loja->save();
    }

    return response()->json(['mensagem' => 'Loja atualizada com sucesso', 'loja' => $loja]);
}

    // ESTOQUE
    public function estoque()
    {
        return response()->json(EstoqueConfig::first());
    }

    public function atualizarEstoque(Request $request)
    {
        $estoque = EstoqueConfig::firstOrFail();
        $estoque->update($request->only($estoque->getFillable()));
        return response()->json(['mensagem' => 'Configuração de estoque atualizada', 'estoque' => $estoque]);
    }

    // NOTIFICAÇÕES
    public function notificacoes()
    {
        return response()->json(NotificacaoConfig::first());
    }

    public function atualizarNotificacoes(Request $request)
    {
        $notificacoes = NotificacaoConfig::firstOrFail();
        $notificacoes->update($request->only($notificacoes->getFillable()));
        return response()->json(['mensagem' => 'Notificações atualizadas', 'notificacoes' => $notificacoes]);
    }

    // PAGAMENTO
    public function pagamento()
    {
        $pagamento = PagamentoConfig::first();
        return response()->json(PagamentoConfig::first());
    }

    public function atualizarPagamento(Request $request)
    {
        $pagamento = PagamentoConfig::firstOrFail();
        $pagamento->update($request->only($pagamento->getFillable()));
        return response()->json(['mensagem' => 'Configurações de pagamento atualizadas', 'pagamento' => $pagamento]);
    }

    // PERMISSÕES
    public function permissoes()
    {
        return response()->json(PermissaoConfig::all());
    }

    public function atualizarPermissoes(Request $request)
    {
        $permissao = PermissaoConfig::findOrFail($request->id);
        $permissao->update($request->only($permissao->getFillable()));
        return response()->json(['mensagem' => 'Permissões atualizadas', 'permissao' => $permissao]);
    }

    // RELATÓRIOS (exemplo genérico)
    public function relatorios()
    {
        return response()->json(['formato' => 'PDF', 'frequencia' => 'mensal']);
    }

    public function atualizarRelatorios(Request $request)
    {
        return response()->json(['mensagem' => 'Preferências de relatórios atualizadas']);
    }
}