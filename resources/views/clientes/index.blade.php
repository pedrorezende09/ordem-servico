<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <!-- Título + botão -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Lista de Clientes</h1>

            <a href="{{ route('clientes.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-black font-semibold px-4 py-2 rounded-lg shadow">
                + Novo Cliente
            </a>
        </div>

        <!-- Mensagem -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'"
                class="font-bold">
                X
            </button>
        </div>
        @endif

        <form method="GET" action="{{ route('clientes.index') }}" class="mb-4 flex gap-2">

            <input type="text"
                name="busca"
                placeholder="Buscar cliente..."
                value="{{ request('busca') }}"
                class="border rounded p-2">

            <button class="bg-gray-800 text-white px-4 py-2 rounded">
                Buscar
            </button>

            <a href="{{ route('clientes.index') }}"
                class="bg-gray-300 px-4 py-2 rounded">
                Limpar
            </a>

        </form>

        <!-- Tabela -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">

                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nome</th>
                        <th class="px-4 py-3 text-left">CPF</th>
                        <th class="px-4 py-3 text-left">Telefone</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Ações</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @foreach ($clientes as $cliente)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-3">{{ $cliente->id }}</td>
                        <td class="px-4 py-3">{{ $cliente->nome }}</td>
                        <td class="px-4 py-3">{{ $cliente->cpf }}</td>
                        <td class="px-4 py-3">{{ $cliente->telefone }}</td>
                        <td class="px-4 py-3">{{ $cliente->email }}</td>

                        <td class="px-4 py-3 flex gap-3">

                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                                class="text-blue-600 hover:underline">
                                Editar
                            </a>

                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
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

            <div class="mt-4">
                {{ $clientes->links() }}
            </div>
        </div>

    </div>

</x-app-layout>