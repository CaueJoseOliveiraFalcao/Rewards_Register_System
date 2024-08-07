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
            h1 {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 40px!important;
                color: #28CB8B;
                font-weight: bold!important;
            }
        </style>
    </head>
    <body class=" min-h-screen flex justify-center items-center">
        <div class="bg-gray-100 p-4 rounded-xl flex justify-center items-center flex-col">
            <h1>Rewards System</h1>
            <div class="flex gap-5 ">
                <a href="/register" style="background-color: #28CB8B;" class="p-3 my-3 text-white rounded-sm text-center w-1/2" >Cadastro</a>
                <a href="/login" style="background-color: #28CB8B;" class="p-3 my-3 text-white rounded-sm text-center w-1/2" >Login</a>
            </div>

        </div>
    </body>
</html>
