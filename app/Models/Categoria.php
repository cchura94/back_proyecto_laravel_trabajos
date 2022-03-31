<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /*
    protected $table = 'mi_categoria';
    
    protected $primaryKey = 'idcat';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public $timestamps = false; // created_at, updated_at
    */
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }
    
}
