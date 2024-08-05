<!DOCTYPE html>
<html>
<head>
    <title>Registros e Pontos Extras do Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .no-data {
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Registros deste Mês</h1>
    @if (isset($result['registers']) && count($result['registers']) > 0)
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Pontos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result['registers'] as $register)
                    <tr>
                        <td>{{$register->table_name}}</td>
                        <td>{{$register->point_table_type}}</td>
                        <td>{{ \Carbon\Carbon::parse($register['created_at'])->format('d/m/Y H:i') }}</td>
                        <td>{{ $register->point_table_value}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">Não há registros para este mês.</p>
    @endif

    <h1>Pontos Extras deste Mês</h1>
    @if (isset($result['extraPoints']) && count($result['extraPoints']) > 0)
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Pontos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result['extraPoints'] as $extraPoint)
                    <tr>
                        <td>{{$extraPoint->table_name}}</td>
                        <td>{{ \Carbon\Carbon::parse($extraPoint['created_at'])->format('d/m/Y H:i') }}</td>
                        <td>{{ $extraPoint->point_value}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">Não há pontos extras para este mês.</p>
    @endif
</body>
</html>
