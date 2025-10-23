<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissaoConfig extends Model
{
   protected $fillable = ['user_id', 'perfil', 'permissoes'];

protected $casts = [
    'permissoes' => 'array'
];
 public function user()
    {
        return $this->belongsTo(User::class);
    }

}
