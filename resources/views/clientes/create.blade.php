<x-app-layout>

    <h1>Cadastrar Cliente</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                    @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div>
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label>CPF:</label>
            <input type="text" name="cpf" required>
        </div>

        <div>
            <label>Telefone:</label>
            <input type="text" name="telefone">
        </div>

        <div>
            <label>Email:</label>
            <input type="email" name="email">
        </div>

        <div>
            <label>Endereço:</label>
            <input type="text" name="endereco">
        </div>

        <button type="submit">Salvar</button>

    </form>

</x-app-layout>