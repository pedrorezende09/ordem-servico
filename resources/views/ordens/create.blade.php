<x-app-layout>

    <div class="max-w-4xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">Nova Ordem de Serviço</h1>

        <form method="POST" action="{{ route('ordens.store') }}">
            @csrf

            <!--Cliente-->
            <div class="mb-4">
                <label>Cliente:</label>
                <select name="cliente_id" class="w-full border rounded p-2">
                    @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">
                        {{ $cliente->nome }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!--Descrição-->
            <div class="mb-4">
                <label>Descrição:</label>
                <textarea name="descricao" class="w-full border rounded p-2"></textarea>
            </div>


            <div>
                <label>Valor do Serviço:</label>
                <input type="number"
                    step="0.01"
                    name="valor_servico"
                    class="border rounded p-2 w-full">
            </div>

            <div>
                <label>Data da Ordem:</label>
                <input type="date"
                    name="data_ordem"
                    class="border rounded p-2 w-full">
            </div>


            <!--Status-->
            <div class="mb-4">
                <label>Status:</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="aberta">Aberta</option>
                    <option value="andamento">Em andamento</option>
                    <option value="finalizada">Finalizada</option>
                </select>
            </div>

            <!--Pagamento (Status):-->
            <div class="mb-4">
                <label>Status do Pagamento:</label>

                <select name="pagamento_status" class="w-full border rounded p-2">
                    <option value="pendente">Pendente</option>
                    <option value="pago">Pago</option>
                </select>
            </div>

            <!--Forma de Pagamento-->
            <div class="mb-4">
                <label>Forma de Pagamento:</label>

                <select name="forma_pagamento" class="w-full border rounded p-2">
                    <option value="">Selecione</option>
                    <option value="pix">PIX</option>
                    <option value="cartao">Cartão</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="transferencia">Transferência</option>
                </select>
            </div>


            <button class="bg-blue-800 text-black ox-4 py-2 rounded">
                Salvar
            </button>


        </form>

    </div>

</x-app-layout>