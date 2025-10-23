<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $table = 'itens_venda'; // nome correto da tabela

    protected $fillable = ['venda_id', 'produto_id', 'quantidade', 'preco_unitario', 'parcelas',
 'subtotal'];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}