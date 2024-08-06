<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Data</title>
</head>
<body>


    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div style="display: flex; justify-content: center; flex-direction: column;gap: 2rem; align-items: center">
        <h1>Insira o Mês e Ano desejado</h1>
        <form action="get-status" method="POST">
            @csrf
            <div>
                <label for="month">Mês:</label>
                <input type="number" id="month" name="month" min="1" max="12" value="{{ old('month') }}">
            </div>
            <div>
                <label for="year">Ano:</label>
                <input type="number" id="year" name="year" min="1900" max="2100" value="{{ old('year') }}">
            </div>
            <div>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

</body>
</html>