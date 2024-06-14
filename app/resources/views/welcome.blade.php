<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Styles -->
        <style>
                body {
                background: linear-gradient(to right, lightblue, lightgreen, gold);
            }
        </style>
    </head>
    <body class=" min-h-screen flex justify-center items-center">
        <div class="bg-teal-400 p-4 rounded-sm flex justify-center items-center flex-col">
            <h1 class="text-center text-white  my-3  text-xl">Registro de Pontos do Rewards</h1>
            <p>sistema para registro de pontos , estatistica de desempenho</p>
            <button class="bg-green-600 p-5 my-3 text-white rounded-xl text-center w-1/2" >Cadastro</button>
        </div>
    </body>
</html>
