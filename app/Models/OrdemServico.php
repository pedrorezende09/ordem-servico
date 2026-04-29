<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historicos()
    {
        return $this->hasMany(HistoricoOrdem::class);
    }

    protected $fillable = [
    'cliente_id',
    'user_id',
    'descricao',
    'status',
    'pagamento_status',
    'forma_pagamento',
];

}
