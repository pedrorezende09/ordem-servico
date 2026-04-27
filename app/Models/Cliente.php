<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrdemServico;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco'
    ];

    public function ordens()
    {
        return $this->hasMany(OrdemServico::class);
    }
}
