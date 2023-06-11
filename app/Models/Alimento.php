<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['icone', 'nome', 'desc', 'preco', 'restaurante_id', 'categoria_id'];

    public function restaurante(){
        return $this->belongsTo(Restaurante::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
