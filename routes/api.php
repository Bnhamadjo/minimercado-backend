<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimentacaoEstoqueController;
use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\PermissoesController;
use App\Http\Controllers\InventarioController;


// Autenticação
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->get('/user', fn(Request $request) => $request->user());

// Dashboard
Route::middleware('auth:sanctum')->get('/dashboard', [DashboardController::class, 'index']);
Route::get('/grafico-vendas', [DashboardController::class, 'graficoVendas']);

// Produtos
Route::get('/produtos/baixo-estoque', [ProdutoController::class, 'produtosComBaixoEstoque']);
Route::apiResource('produtos', ProdutoController::class);

// Vendas
Route::post('/registrar-venda', [VendaController::class, 'registrarVendaPorCodigo']);
Route::get('/vendas/produto/{codigo_barras}', [VendaController::class, 'vendasPorProduto']);
Route::apiResource('vendas', VendaController::class);
Route::apiResource('itens-venda', ItemVendaController::class);

// Fornecedores
Route::apiResource('fornecedores', FornecedorController::class);

// Categorias
Route::apiResource('categorias', CategoriaController::class);

// Movimentações de Estoque com prefixo /estoque
Route::prefix('estoque')->group(function () {
    Route::get('/movimentacoes', [MovimentacaoEstoqueController::class, 'index']);
    Route::post('/movimentacoes', [MovimentacaoEstoqueController::class, 'store']);
});

//inventario
Route::get('/inventario', [DashboardController::class, 'inventario']);
Route::get('/inventario/dados', [InventarioController::class, 'inventario']);
Route::get('/inventario', [InventarioController::class, 'index']);

// Configurações
Route::prefix('configuracoes')->group(function () {
    Route::get('/', [ConfiguracoesController::class, 'index']);
    Route::get('/perfil', [ConfiguracoesController::class, 'perfil']);
    Route::get('/loja', [ConfiguracoesController::class, 'loja']);
    Route::get('/pagamento', [ConfiguracoesController::class, 'pagamento']);
    Route::get('/estoque', [ConfiguracoesController::class, 'estoque']);
    Route::get('/relatorios', [ConfiguracoesController::class, 'relatorios']);
    Route::get('/permissoes', [PermissoesController::class, 'show']);
    Route::get('/notificacoes', [ConfiguracoesController::class, 'notificacoes']);

    Route::post('/pagamento', [ConfiguracoesController::class, 'criarPagamento']);

    Route::put('/perfil', [ConfiguracoesController::class, 'atualizarPerfil']);
    Route::put('/loja', [ConfiguracoesController::class, 'atualizarLoja']);
    Route::put('/pagamento', [ConfiguracoesController::class, 'atualizarPagamento']);
    Route::put('/estoque', [ConfiguracoesController::class, 'atualizarEstoque']);
    Route::put('/relatorios', [ConfiguracoesController::class, 'atualizarRelatorios']);
    Route::put('/notificacoes', [ConfiguracoesController::class, 'atualizarNotificacoes']);
    Route::put('/permissoes', [PermissoesController::class, 'update']);
});