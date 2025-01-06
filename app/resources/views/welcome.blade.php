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
                color: #036666;
                font-weight: bold!important;
            }
            .nav-text{
                font-weight: bold;
                color: white;
                border-radius: 8px;
                padding: 1rem;
                align-items: center;
                transition: .3s
            }
            .nav-text:hover{
                background-color: #88d4ab!important;
            }
            .size-div{
                display: flex;

                justify-content: center;
                max-width: 100%;
                height: 100%;
            }
            .info-div {
                background-color:#88d4ab;
                display: flex;
                padding-top: 2rem;
                justify-content: center;
                align-items: center;
                gap:2rem;
                margin-top:3rem;
            }

            @media (max-width: 1024px) {
                .info-div {
                    flex-direction: column !important;
                }
                .info-div2{
                    margin: 0;
                    width: 100%!important;
                    height: 100%!important;
                    padding: 2rem;
                }
                .back-img{
                    border-radius: 10px;
                    min-width: 300px!important;
                    min-height: 300px!important;
                    max-width: 400px!important;
                    max-height: 400px!important;
                }
                h1{
                    font-size: 24px!important;
                }
                .nav-text{
                    padding: 0.5rem
                }
                p{
                    font-size: 17px!important;
                    margin-top: 2rem!important;
                }
            }
            body{
                background-color:#88d4ab;
            }
            header{
                background-color: #56ab91;

            }
            .back-img{
                background: url('welcome.jpg');
                width: 50%;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                height: 100%;
            }
            .info-div2{
                width: 40%; 
                height: 100%;
            }
            p{
                color: #036666;
                font-size: 22px;
            }
        </style>
    </head>
    <header>
    <div class=" p-4 rounded-xl flex justify-between">
            <h1>Rewards System</h1>
            <div class="flex gap-5 items-center ">
                <a href="/register" style="background-color: #28CB8B;" class="nav-text" >Cadastro</a>
                <a href="/login" style="background-color: #28CB8B;" class="nav-text" >Login</a>
            </div>

        </div>
    </header>
    <body class="">
        <div class="size-div">
            <div class="info-div " >
                <div class="back-img">
                </div>
                <div class="info-div2">
                    <h1>O que é o Rewards System?</h1>
                    <p style="margin-top: 4rem;">
                        O Rewards System é uma plataforma onde você pode registrar, diariamente, seus pontos do 
                        Microsoft Rewards, oferecendo funcionalidades adicionais que não são fornecidas pela Microsoft, 
                        como relatórios detalhados de pontos.
                    </p>
                    <p style="margin-top: 4rem;">
                        Trata-se de um sistema totalmente modular. Quando uma tarefa do Rewards é alterada, você pode 
                        atualizar o valor correspondente diretamente no sistema de forma dinâmica.
                    </p>
                    <p style="margin-top: 4rem;">
                        Dentro do sistema, você encontrará tarefas pré-configuradas, prontas para serem ajustadas com 
                        base nos pontos do Rewards. Além disso, o sistema oferece relatórios mensais detalhados que mostram 
                        quando e quanto cada tarefa contribuiu para o seu total de pontos, bem como o histórico de resgates 
                        de gift cards, todos devidamente registrados.
                    </p>
                    
                 </div>
            </div>
        </div>
        
    </body>
</html>
