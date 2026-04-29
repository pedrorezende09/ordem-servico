<x-app-layout>

    <div class="max-w-5xl mx-auto px-6 py-6">

        <!-- Título -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Histórico da Ordem #{{ $ordem->id }}
            </h1>

            <a href="{{ route('ordens.index') }}"
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Voltar
            </a>
        </div>

        <!-- Informações da ordem -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <p><strong>Cliente:</strong> {{ $ordem->cliente->nome }}</p>
            <p><strong>Descrição:</strong> {{ $ordem->descricao }}</p>
            <p><strong>Status Atual:</strong> {{ $ordem->status }}</p>
        </div>

        <!-- Histórico -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full">

                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Data</th>
                        <th class="px-4 py-3 text-left">Usuário</th>
                        <th class="px-4 py-3 text-left">Campo</th>
                        <th class="px-4 py-3 text-left">Valor Antigo</th>
                        <th class="px-4 py-3 text-left">Valor Novo</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 text-sm">
                    @forelse ($ordem->historicos as $historico)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $historico->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $historico->user->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $historico->campo_alterado }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $historico->valor_antigo }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $historico->valor_novo }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Nenhum histórico registrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</x-app-layout>