<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $abertas = \App\Models\OrdemServico::where('status', 'aberta')->count();
        $andamento = \App\Models\OrdemServico::where('status', 'andamento')->count();
        $finalizadas = \App\Models\OrdemServico::where('status', 'finalizada')->count();

        return view('dashboard', [
            'total' => \App\Models\OrdemServico::count(),
            'abertas' => $abertas,
            'andamento' => $andamento,
            'finalizadas' => $finalizadas,

        ]);
    }
}
