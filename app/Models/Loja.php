<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NotificacaoConfig;

class Loja extends Model
{
    use HasFactory;

    protected $table = 'lojas';

    protected $fillable = [
        'nome_loja',
        'cnpj',
        'endereco',
        'telefone',
        'logo',
    ];

    public function notificacaoConfig()
    {
        return $this->hasOne(NotificacaoConfig::class);
    }

}