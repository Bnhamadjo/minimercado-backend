<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
   protected $fillable = [
        'valor_total',
        'forma_pagamento',
        'data_venda',
        'cliente_id',
    ];

    public function itens()
    {
        return $this->hasMany(ItemVenda::class);
    }
}
