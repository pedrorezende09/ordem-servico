 <h1>Relatório de Ordens de Serviço</h1>

    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Pagamento</th>
                <th>Data</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($ordens as $ordem)
            <tr>
                <td>{{ $ordem->codigo }}</td>
                <td>{{ $ordem->cliente->nome }}</td>
                <td>{{ $ordem->descricao }}</td>
                <td>{{ $ordem->valor_servico }}</td>
                <td>{{ $ordem->status }}</td>
                <td>{{ $ordem->pagamento_status }}</td>
                <td>{{ $ordem->data_ordem }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
