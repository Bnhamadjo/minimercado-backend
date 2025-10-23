<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoEstoque extends Model
{
    protected $fillable = ['produto_id', 'tipo', 'quantidade', 'motivo'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}