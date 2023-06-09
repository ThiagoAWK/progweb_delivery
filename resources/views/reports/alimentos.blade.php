<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatórios de Alimentos</title>
</head>
<body>
    <h1> Relatório de Alimentos</h1>
    <hr>
    <table border="2" cellpadding = '0' cellspacing="4"
        style="width: 100%" border="">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Restaurante</th>
            <th>Categoria</th>
            <th>Icone</th>
    </tr>
    @forelse ( $alimentos as $alimento )
    <tr>
        <td>{{ $alimento->id }}</td>
        <td>{{ $alimento->nome }}</td>
        <td>{{ $alimento->desc }}</td>
        <td>R$ {{ $alimento->preco }}</td>
        <td>{{ $alimento->restaurante->nome }}</td>
        <td>{{ $alimento->categoria->nome }}</td>
        <td>{{ $alimento->icone }}</td>
        <td>
            <img src="{{ $logo }}" alt="">
            <img src="{{ public_path('uploads/alimentos/semfoto.jpg') }}">
        </td>
    </tr>
    @empty
        <tr>
            <td colspan="3">Nenhum alimento cadastrado</td>
        </tr>
    @endforelse

    </table>
</body>
</html>
