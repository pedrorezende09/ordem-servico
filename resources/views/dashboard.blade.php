<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <!-- Cards -->
        <div class="grid grid-cols-4 gap-4">

            <div class="bg-white p-4 rounded shadow">
                <p class="text-gray-500">Total</p>
                <h2 class="text-2xl font-bold">{{ $total }}</h2>
            </div>

            <div class="bg-blue-100 p-4 rounded shadow">
                <p class="text-gray-500">Abertas</p>
                <h2 class="text-2xl font-bold">{{ $abertas }}</h2>
            </div>

            <div class="bg-yellow-100 p-4 rounded shadow">
                <p class="text-gray-500">Em andamento</p>
                <h2 class="text-2xl font-bold">{{ $andamento }}</h2>
            </div>

            <div class="bg-green-100 p-4 rounded shadow">
                <p class="text-gray-500">Finalizadas</p>
                <h2 class="text-2xl font-bold">{{ $finalizadas }}</h2>
            </div>

        </div>

        <!-- Gráfico -->
        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="text-lg font-bold mb-4">Status das Ordens</h2>

            <canvas id="statusChart"></canvas>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('statusChart');

        const data = [
            <?php echo json_encode($abertas); ?>,
            <?php echo json_encode($andamento); ?>,
            <?php echo json_encode($finalizadas); ?>
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