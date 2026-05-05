<x-app-layout>

    <div class="max-w-5xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">
            Ordem {{ $ordem->codigo }}
        </h1>

        <!-- Dados principais -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-bold mb-4">Dados da Ordem</h2>

            <p><strong>Cliente:</strong> {{ $ordem->cliente->nome }}</p>
            <p><strong>Descrição:</strong> {{ $ordem->descricao }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($ordem->valor_servico, 2, ',', '.') }}</p>
            <p><strong>Data:</strong> {{ $ordem->data_ordem }}</p>
        </div>

        <!-- Controle -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-bold mb-4">Controle</h2>

            <td class="px-4 py-3">
                @if($ordem->status == 'aberta')
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                    Aberta
                </span>
                @elseif($ordem->status == 'andamento')
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">
                    Em andamento
                </span>
                @elseif($ordem->status == 'finalizada')
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                    Finalizada
                </span>
                @endif
            </td>
            <td class="px-4 py-3">
                @if($ordem->pagamento_status == 'pendente')
                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">
                    Pendente
                </span>
                @elseif($ordem->pagamento_status == 'pago')
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
                    Pago
                </span>
                @endif
            </td>
            <p><strong>Forma de pagamento:</strong> {{ $ordem->forma_pagamento ?? '-' }}</p>
        </div>

        <!-- Auditoria -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">
            <h2 class="text-lg font-bold mb-4">Auditoria</h2>

            <p><strong>Criada por:</strong> {{ $ordem->user->name }}</p>
            <p><strong>Criada em:</strong> {{ $ordem->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Última atualização:</strong> {{ $ordem->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <!-- Histórico -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-bold mb-4">Histórico de Alterações</h2>

            @forelse ($ordem->historicos as $historico)
            <div class="border-b py-3">
                <p><strong>Campo:</strong> {{ $historico->campo_alterado }}</p>
                <p><strong>De:</strong> {{ $historico->valor_antigo ?? '-' }}</p>
                <p><strong>Para:</strong> {{ $historico->valor_novo ?? '-' }}</p>
                <p><strong>Por:</strong> {{ $historico->user->name }}</p>
                <p><strong>Em:</strong> {{ $historico->created_at->format('d/m/Y H:i') }}</p>
            </div>
            @empty
            <p>Nenhuma alteração registrada.</p>
            @endforelse

        </div>

    </div>

</x-app-layout>