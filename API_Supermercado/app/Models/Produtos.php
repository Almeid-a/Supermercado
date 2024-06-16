<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    // Definindo o nome da tabela associada ao modelo
    protected $table = 'produtos';

    // Colunas que podem ser preenchidas em massa
    protected $fillable = [
        'nome', 
        'preco', 
        'tipo', 
        'quantidade', 
        'foto'
    ];
}