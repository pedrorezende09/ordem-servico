<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <!-- Cards principais -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-gray-500 text-sm">Total de Ordens</p>
                <h2 class="text-3xl font-bold">{{ $total }}</h2>
            </div>

            <div class="bg-blue-100 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Abertas</p>
                <h2 class="text-3xl font-bold">{{ $abertas }}</h2>
            </div>

            <div class="bg-yellow-100 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Em andamento</p>
                <h2 class="text-3xl font-bold">{{ $andamento }}</h2>
            </div>

            <div class="bg-green-100 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Finalizadas</p>
                <h2 class="text-3xl font-bold">{{ $finalizadas }}</h2>
            </div>

        </div>

        <!-- Cards financeiros -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

            <div class="bg-green-50 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Total Faturado</p>
                <h2 class="text-2xl font-bold">
                    R$ {{ number_format($totalFaturado, 2, ',', '.') }}
                </h2>
            </div>

            <div class="bg-red-50 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Total Pendente</p>
                <h2 class="text-2xl font-bold">
                    R$ {{ number_format($totalPendente, 2, ',', '.') }}
                </h2>
            </div>

            <div class="bg-gray-100 rounded-xl shadow p-6">
                <p class="text-gray-600 text-sm">Ticket Médio</p>
                <h2 class="text-2xl font-bold">
                    R$ {{ number_format($ticketMedio, 2, ',', '.') }}
                </h2>
            </div>

        </div>

        <!-- Gráfico -->
        <div class="bg-white p-6 rounded-xl shadow mt-6">
            <h2 class="text-lg font-bold mb-4">Status das Ordens</h2>
            <canvas id="statusChart" height="100"></canvas>
        </div>

        <!-- Últimas ordens -->
        <div class="bg-white p-6 rounded-xl shadow mt-6">

            <h2 class="text-lg font-bold mb-4">Últimas Ordens</h2>

            <table class="min-w-full text-sm">

                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Código</th>
                        <th class="text-left py-2">Cliente</th>
                        <th class="text-left py-2">Valor</th>
                        <th class="text-left py-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ultimasOrdens as $ordem)
                    <tr class="border-b">
                        <td class="py-2">{{ $ordem->codigo }}</td>
                        <td class="py-2">{{ $ordem->cliente->nome }}</td>
                        <td class="py-2">
                            R$ {{ number_format($ordem->valor_servico, 2, ',', '.') }}
                        </td>
                        <td class="py-2">{{ $ordem->status }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('statusChart');

        const data = [
            {{ json_encode($abertas) }},
            {{ json_encode($andamento) }},
            {{ json_encode($finalizadas) }}
        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Abertas', 'Em andamento', 'Finalizadas'],
                datasets: [{
                    label: 'Quantidade de Ordens',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</x-app-layout>