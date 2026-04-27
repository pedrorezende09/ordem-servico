<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrdemServico;
use App\Models\Cliente;


class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OrdemServico::with('cliente');

        if($request->status) {
            $query->where('status', $request->status);
        }

        if($request->busca) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->busca . '%');
            });
        }

        $ordens = $query->paginate(5)->withQueryString();

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
            'cliente_id' => $request->cliente_id,
            'user_id' => Auth::id(),
            'descricao' => $request->descricao,
            'status' => $request->status,
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

        $ordem->update([
            'cliente_id' => $request->cliente_id,
            'descricao' => $request->descricao,
            'status' => $request->status,
        ]);

        return redirect()->route('ordens.index')
                         -> with('success', 'Ordem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        $ordem->delete();

        return redirect()->route('ordens.index')
                         ->with('success', 'Ordem excluída com sucesso!');
    }
}
