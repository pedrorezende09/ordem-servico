<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- Título -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Ordens de Serviço</h1>

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
        <form method="GET" action="{{ route('ordens.index') }}" class="mb-4 flex gap-2">

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

            <button class="bg-gray-800 text-white px-4 py-2 rounded">
                Filtrar
            </button>

            <a href="{{ route('ordens.index') }}"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded">
                Limpar
            </a>

        </form>

        <!-- Tabela -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">

                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Código</th>
                        <th class="px-4 py-3 text-left">Cliente</th>
                        <th class="px-4 py-3 text-left">Descrição</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Pagamento</th>
                        <th class="px-4 py-3 text-left">Forma de Pagamento</th>
                        <th class="px-4 py-3 text-left">Ações</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @foreach ($ordens as $ordem)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3">{{ $ordem->codigo }}</td>
                        <td class="px-4 py-3">{{ $ordem->cliente->nome }}</td>
                        <td class="px-4 py-3">{{ $ordem->descricao }}</td>
                        <td class="px-4 py-3">{{ $ordem->status }}</td>
                        <td class="px-4 py-3">{{ $ordem->pagamento_status }}</td>
                        <td class="px-4 py-3">{{ $ordem->forma_pagamento ?? '-' }}</td>
                        


                        <td class="px-4 py-3 flex gap-2">

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

</x-app-layout>