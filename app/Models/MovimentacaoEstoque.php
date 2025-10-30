<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    protected $fillable = ['produto_id', 'tipo', 'quantidade', 'motivo', 'data_validade'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}