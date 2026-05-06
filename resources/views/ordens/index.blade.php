<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- Título -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Ordens de Serviço</h1>

            <a href="{{ route('ordens.pdf') }}"
                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                Gerar PDF
            </a>


            <a href="{{ route('ordens.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-black font-semibold px-4 py-2 rounded-lg shadow">
                + Nova Ordem
            </a>
        </div>

        <!-- Mensagem -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Filtro -->
        <!-- Filtro -->
        <form method="GET" action="{{ route('ordens.index') }}" class="mb-6">

            <!-- Linha principal -->
            <div class="flex gap-2 items-center flex-wrap">

                <input type="text"
                    name="busca"
                    placeholder="Buscar por cliente..."
                    value="{{ request('busca') }}"
                    class="border rounded p-2">

                <select name="status" class="border rounded p-2">
                    <option value="">Todos</option>

                    <option value="aberta" @selected(request('status')=='aberta' )>
                        Aberta
                    </option>

                    <option value="andamento" @selected(request('status')=='andamento' )>
                        Em andamento
                    </option>

                    <option value="finalizada" @selected(request('status')=='finalizada' )>
                        Finalizada
                    </option>
                </select>

                <button type="button"
                    id="toggleFiltros"
                    class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Filtros
                </button>

                <button class="bg-gray-800 text-white px-4 py-2 rounded">
                    Filtrar
                </button>

                <a href="{{ route('ordens.index') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded">
                    Limpar
                </a>

            </div>

            <!-- Filtros avançados -->
            <div id="filtrosExtras"
                class="hidden mt-4 bg-gray-50 p-4 rounded-lg border">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <input type="text"
                        name="codigo"
                        placeholder="Buscar por código..."
                        value="{{ request('codigo') }}"
                        class="border rounded p-2">

                    <select name="pagamento_status" class="border rounded p-2">
                        <option value="">Pagamento</option>

                        <option value="pendente"
                            @selected(request('pagamento_status')=='pendente' )>
                            Pendente
                        </option>

                        <option value="pago"
                            @selected(request('pagamento_status')=='pago' )>
                            Pago
                        </option>
                    </select>

                    <input type="date"
                        name="data_inicio"
                        value="{{ request('data_inicio') }}"
                        class="border rounded p-2">

                    <input type="date"
                        name="data_fim"
                        value="{{ request('data_fim') }}"
                        class="border rounded p-2">

                    <input type="number"
                        step="0.01"
                        name="valor_min"
                        placeholder="Valor mínimo"
                        value="{{ request('valor_min') }}"
                        class="border rounded p-2">

                    <input type="number"
                        step="0.01"
                        name="valor_max"
                        placeholder="Valor máximo"
                        value="{{ request('valor_max') }}"
                        class="border rounded p-2">

                </div>

            </div>

        </form>

        <!-- Tabela -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full table-fixed">

                <thead class="bg-gray-100 text-gray-700 text-sm text-center">
                    <tr>
                        <th class="w-32 px-4 py-3 text-left">Código</th>
                        <th class="w-32 px-4 py-3 text-center">Cliente</th>
                        <th class="w-40 px-4 py-3 text-center">Descrição</th>
                        <th class="w-40 px-4 py-3 text-center">Valor</th>
                        <th class="w-40 px-4 py-3 text-center">Data</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Pagamento</th>
                        <th class="px-4 py-3 text-center">Forma de Pagamento</th>
                        <th class="w-56 px-4 py-3 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm text-center">
                    @foreach ($ordens as $ordem)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3">{{ $ordem->codigo }}</td>
                        <td class="px-4 py-3">{{ $ordem->cliente->nome }}</td>
                        <td class="px-4 py-3">{{ $ordem->descricao }}</td>
                        <td class="px-4 py-3">R$ {{ number_format($ordem->valor_servico, 2, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $ordem->data_ordem }}</td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center">
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
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($ordem->pagamento_status == 'pendente') bg-red-100 text-red-800
                                @elseif($ordem->pagamento_status == 'pago') bg-green-100 text-green-800
                                @endif">
                                {{ ucfirst($ordem->pagamento_status) }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            {{ $ordem->forma_pagamento ?? '-' }}
                        </td>


                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('ordens.show', $ordem->id) }}"
                                    class="text-green-600 hover:underline">
                                    Visualizar
                                </a>

                                <a href="{{ route('ordens.edit', $ordem->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Editar
                                </a>

                                <a href="{{ route('ordens.historico', $ordem->id) }}"
                                    class="text-blue-700 hover:underline">
                                    Histórico
                                </a>

                                <form action="{{ route('ordens.destroy', $ordem->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-red-600 hover:underline">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mt-4">
            {{ $ordens->links() }}
        </div>

    </div>

    <script>
        document.getElementById('toggleFiltros').addEventListener('click', function() {
            document.getElementById('filtrosExtras').classList.toggle('hidden');
        });
    </script>

</x-app-layout>