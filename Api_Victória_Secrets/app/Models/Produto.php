<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'categoria',
        'imagem',
    ];

    protected $appends = ['imagem_url'];

    public function getImagemUrlAttribute()
    {
        return $this->imagem ? url('storage/' . $this->imagem) : null;
    }
}
