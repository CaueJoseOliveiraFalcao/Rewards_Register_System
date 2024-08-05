<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Data</title>
</head>
<body>
    <h1>Formulário de Data</h1>

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
</body>
</html>