<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fornecedor extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'fornecedores';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'endereco'
    ];

    /**
     * Relacionamento 1:N com produtos
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'fornecedor_id');
    }
}
