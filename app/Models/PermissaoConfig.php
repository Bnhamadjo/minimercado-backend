<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissaoConfig extends Model
{
   protected $fillable = [ 'perfil', 'permissoes'];

protected $casts = [
    'permissoes' => 'array'
];
 public function user()
    {
        return $this->belongsTo(User::class);
    }

}
