<x-app-layout>

    <div class="max-w-4xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">Editar Ordem de Serviço</h1>

        <form method="POST" action="{{ route('ordens.update', $ordem->id) }}">
            @csrf
            @method('PUT')

            <!-- Cliente -->
            <div class="mb-4">
                <label>Cliente:</label>
                <select name="cliente_id" class="w-full border rounded p-2">
                    @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}"
                        {{ $cliente->id == $ordem->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Descrição -->
            <div class="mb-4">
                <label>Descrição:</label>
                <textarea name="descricao" class="w-full border rounded p-2">
                {{ $ordem->descricao }}
                </textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label>Status:</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="aberta" {{ $ordem->status == 'aberta' ? 'selected' : '' }}>Aberta</option>
                    <option value="andamento" {{ $ordem->status == 'andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="finalizada" {{ $ordem->status == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Status do Pagamento:</label>

                <select name="pagamento_status" class="w-full border rounded p-2">

                    <option value="pendente"
                        @selected($ordem->pagamento_status == 'pendente')>
                        Pendente
                    </option>

                    <option value="pago"
                        @selected($ordem->pagamento_status == 'pago')>
                        Pago
                    </option>

                </select>
            </div>

            <select name="forma_pagamento" class="w-full border rounded p-2">

                <option value="">Selecione</option>

                <option value="pix"
                    @selected($ordem->forma_pagamento == 'pix')>
                    PIX
                </option>

                <option value="cartao"
                    @selected($ordem->forma_pagamento == 'cartao')>
                    Cartão
                </option>

                <option value="dinheiro"
                    @selected($ordem->forma_pagamento == 'dinheiro')>
                    Dinheiro
                </option>

                <option value="transferencia"
                    @selected($ordem->forma_pagamento == 'transferencia')>
                    Transferência
                </option>

            </select>

            <button class="bg-blue-600 text-black px-4 py-2 rounded">
                Atualizar
            </button>

        </form>

    </div>

</x-app-layout>