<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loja;

class NotificacaoConfig extends Model
{
    protected $fillable = [
        'alerta_vencimento',
        'alerta_estoque_baixo',
        'alerta_venda_alta',
        'canal_email',
        'canal_popup',
        'canal_sms',
    ];

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

}