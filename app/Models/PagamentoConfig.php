<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagamentoConfig extends Model
{
    protected $fillable = [
        'dinheiro',
        'cartao',
        'pix',
        'vale',
        'taxa_cartao',
        'desconto_pix',
        'parcelamento',
    ];
}