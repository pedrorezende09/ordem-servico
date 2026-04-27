<x-app-layout>

<h1>Editar Cliente</h1>

<form action=" {{ route('clientes.update', $cliente->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nome:</label>
        <input type="text" name="nome" value="{{ $cliente->nome }}" required>
    </div>

    <div>
        <label>CPF:</label>
        <input type="text" name="cpf" value="{{ $cliente->cpf }}" required>
    </div>

    <div>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="{{ $cliente->telefone }}" required>
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $cliente->email }}" required>
    </div>

    <button type="submit">Atualizar</button>

</form>


</x-app-latout>