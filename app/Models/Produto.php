<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Fornecedor;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'codigo_barras',
        'preco',
        'quantidade',
        'categoria_id',
        'fornecedor_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}