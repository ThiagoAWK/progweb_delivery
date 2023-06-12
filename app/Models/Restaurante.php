<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nome', 'endereco', 'fone'];
    protected $table = 'restaurantes';

    public function alimentos()
    {
        return $this->hasMany(Alimento::class);
    }
}
