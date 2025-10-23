<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstoqueConfig extends Model
{
    protected $fillable = [
        'unidade_padrao',
        'alerta_minimo',
        'validade_ativa',
        'dias_validade_alerta',
    ];
}