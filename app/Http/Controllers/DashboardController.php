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

        $totalFaturado = \App\Models\OrdemServico::where('pagamento_status', 'pago')
            ->sum('valor_servico');

        $totalPendente = \App\Models\OrdemServico::where('pagamento_status', 'pendente')
            ->sum('valor_servico');

        $ticketMedio = \App\Models\OrdemServico::avg('valor_servico');

        $ultimasOrdens = \App\Models\OrdemServico::with('cliente')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'total' => \App\Models\OrdemServico::count(),
            'abertas' => $abertas,
            'andamento' => $andamento,
            'finalizadas' => $finalizadas,
            'totalFaturado' => $totalFaturado,
            'totalPendente' => $totalPendente,
            'ticketMedio' => $ticketMedio,
            'ultimasOrdens' => $ultimasOrdens,
        ]);
    }
}
