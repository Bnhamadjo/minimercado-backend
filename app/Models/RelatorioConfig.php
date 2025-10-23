<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatorioConfig extends Model
{
    protected $fillable = [
        'frequencia',
        'formato',
        'filtro_padrao',
        'envio_email',
        'email_destino',
    ];
}