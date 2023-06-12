<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $fillable = ['alimento_id', 'quantidade'];

    public function alimento(){
        return $this->belongsTo(Alimento::class);
    }
}
