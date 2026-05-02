<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\HistoricoOrdem;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OrdemServico::with('cliente');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->busca) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->busca . '%');
            });
        }

        $ordens = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('ordens.index', compact('ordens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();

        return view('ordens.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string',
            'status' => 'required|in:aberta,andamento,finalizada',
        ]);

        OrdemServico::create([
            'codigo' => 'OS-' . date('Y') . '-' . strtoupper(Str::random(6)),
            'cliente_id' => $request->cliente_id,
            'user_id' => Auth::id(),
            'descricao' => $request->descricao,
            'valor_servico' => $request->valor_servico,
            'data_ordem' => $request->data_ordem,
            'status' => $request->status,
            'pagamento_status' => $request->pagamento_status,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        $clientes = Cliente::all();

        return view('ordens.edit', compact('ordem', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descricao' => 'required|string',
            'status' => 'required|in:aberta,andamento,finalizada',
        ]);

        $ordem = OrdemServico::findOrFail($id);

        $statusAntigo = $ordem->status;
        $pagamentoAntigo = $ordem->pagamento_status;
        $formaPagamentoAntiga = $ordem->forma_pagamento;
        $descricaoAntiga = $ordem->descricao;
        $valorAntigo = $ordem->valor_servico;
        $dataOrdemAntiga = $ordem->data_ordem;
        $clienteAntigo = $ordem->cliente_id;

        $ordem->update([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'valor_servico' => $request->valor_servico,
            'data_ordem' => $request->data_ordem,
            'status' => $request->status,
            'pagamento_status' => $request->pagamento_status,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        if ($statusAntigo != $request->status) {
            HistoricoOrdem::create([
                'ordem_servico_id' => $ordem->id,
                'user_id' => Auth::id(),
                'campo_alterado' => 'status',
                'valor_antigo' => $statusAntigo,
                'valor_novo' => $request->status,
            ]);
        }

        if ($pagamentoAntigo != $request->pagamento_status) {
            HistoricoOrdem::create([
                'ordem_servico_id' => $ordem->id,
                'user_id' => Auth::id(),
                'campo_alterado' => 'pagamento_status',
                'valor_antigo' => $pagamentoAntigo,
                'valor_novo' => $request->pagamento_status,
            ]);
        }

        if ($formaPagamentoAntiga != $request->forma_pagamento) {
            HistoricoOrdem::create([
                'ordem_servico_id' => $ordem->id,
                'user_id' => Auth::id(),
                'campo_alterado' => 'forma_pagamento',
                'valor_antigo' => $formaPagamentoAntiga,
                'valor_novo' => $request->forma_pagamento,
            ]);

            if ($descricaoAntiga != $request->descricao) {
                HistoricoOrdem::create([
                    'ordem_servico_id' => $ordem->id,
                    'user_id' => Auth::id(),
                    'campo_alterado' => 'descricao',
                    'valor_antigo' => $descricaoAntiga,
                    'valor_novo' => $request->descricao,
                ]);
            }

            if ($valorAntigo != $request->valor_servico) {
                HistoricoOrdem::create([
                    'ordem_servico_id' => $ordem->id,
                    'user_id' => Auth::id(),
                    'campo_alterado' => 'valor_servico',
                    'valor_antigo' => $valorAntigo,
                    'valor_novo' => $request->valor_servico,
                ]);
            }

            if ($dataOrdemAntiga != $request->data_ordem) {
                HistoricoOrdem::create([
                    'ordem_servico_id' => $ordem->id,
                    'user_id' => Auth::id(),
                    'campo_alterado' => 'data_ordem',
                    'valor_antigo' => $dataOrdemAntiga,
                    'valor_novo' => $request->data_ordem,
                ]);
            }

            if ($clienteAntigo != $request->cliente_id) {
                HistoricoOrdem::create([
                    'ordem_servico_id' => $ordem->id,
                    'user_id' => Auth::id(),
                    'campo_alterado' => 'cliente_id',
                    'valor_antigo' => $clienteAntigo,
                    'valor_novo' => $request->cliente_id,
                ]);
            }
        }

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        $ordem->delete();

        return redirect()->route('ordens.index')
            ->with('success', 'Ordem excluída com sucesso!');
    }

    public function historico($id)
    {
        $ordem = OrdemServico::with(['historicos.user'])
            ->findOrFail($id);

        return view('ordens.historico', compact('ordem'));
    }

    public function relatorioPdf()
    {
        $ordens = OrdemServico::with('cliente')
            ->latest()
            ->get();

            $pdf = Pdf::loadView('ordens.pdf', compact('ordens'));

            return $pdf->download('relatorio-ordens.pdf');
    }
}
