<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricoOrdem extends Model
{
    protected $table = 'historico_ordens';

    protected $fillable = [
       'ordem_servico_id',
       'user_id',
       'campo_alterado',
       'valor_antigo',
       'valor_novo',
    ];

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
