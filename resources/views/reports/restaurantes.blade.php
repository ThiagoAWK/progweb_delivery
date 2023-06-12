<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatórios de Restaurantes</title>
</head>
<body>
    <h1> Relatório de Restaurantes</h1>
    <hr>
    <table border="2" cellpadding = '0' cellspacing="4"
        style="width: 100%" border="">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
    </tr>
    @forelse ( $restaurantes as $restaurante )
    <tr>
        <td>{{ $restaurante->id }}</td>
        <td>{{ $restaurante->nome }}</td>
        <td>{{ $restaurante->endereco }}</td>
        <td>{{ $restaurante->fone }}</td>
    </tr>
    @empty
        <tr>
            <td colspan="3">Nenhum restaurante cadastrado</td>
        </tr>
    @endforelse

    </table>
</body>
</html>
