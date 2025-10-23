<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissaoConfig;

class PermissoesController extends Controller
{
    /**
     * Consulta as permissões de um perfil específico.
     * GET /api/configuracoes/permissoes?perfil=operador
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'perfil' => 'required|string|in:administrador,operador,estoquista,caixa',
        ]);

        $config = PermissaoConfig::where('perfil', $validated['perfil'])->first();

        if (!$config) {
            return response()->json(['message' => 'Perfil não encontrado ou sem permissões configuradas'], 404);
        }

        return response()->json([
            'perfil' => $config->perfil,
            'permissoes' => json_decode($config->permissoes)
        ]);
    }

    /**
     * Atualiza ou cria permissões para um perfil.
     * PUT /api/configuracoes/permissoes
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'perfil' => 'required|string|in:administrador,operador,estoquista,caixa',
            'permissoes' => 'required|array',
            'permissoes.*' => 'string|in:visualizar,editar,excluir,exportar',
        ]);

        $config = PermissaoConfig::updateOrCreate(
            ['perfil' => $validated['perfil']],
            ['permissoes' => json_encode($validated['permissoes'])]
        );

        return response()->json(['message' => 'Permissões atualizadas com sucesso']);
    }
}