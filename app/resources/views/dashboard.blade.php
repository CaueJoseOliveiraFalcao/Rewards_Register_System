<style>
        h1{
           font-size: 50px!important; 
        }
    </style>
<x-app-layout >
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="/tablePointCreator">CRIAR TAREFA</a>


    </x-slot>

    <div class="flex flex-col justify-content-center items-center" style="padding-top:80px;">
        <div class="flex flex-col justify-content-center items-center">
            <h1>Pontos : {{Auth::user()->getPointTableInfo()->point_value}}</h1>
            <h2>Pontos Hoje : {{$todayPoints}}</h2>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('dashboard')">
                                {{ __('EDITAR PONTOS') }}
                </x-nav-link>    
        </div>
    </div>
    
    <div>
        @isset(Auth::user()->gift)
        <h2 class="text-tite">Gifts Cards Resgatafos</h2>
    <div class="task-container">
            @foreach(Auth::user()->gift as $info)
                    <div class='each-div'>
                        <div class="card">
                            <div class="flex">
                                <div class="task-name"><span>{{ $info->gift_name }}</span></div>
                            </div>

                            <div class="task-points">Pontos: <span>{{ $info->gift_value }}</span></div>
                            </div>
                        </div>

                    </div>
            @endforeach
    </div>
    @endisset
    <div>
        <h2 class="text-tite">TAREFAS VARIAVEIS </h2>
    <div class="task-container">
            @foreach(Auth::user()->getValidTables() as $info)
                @if($info->type === "BING_VARIAVEL" || $info->type === "XBOX_VARIAVEL")
                    <div class='each-div'>
                        <div class="card">
                            <div class="flex">
                                <div class="task-name"><span>{{ $info->name }}</span></div>
                                @if ($info->streak > 0)
                                <div class="task-sequence">🔥 <span>{{ $info->streak }}</span></div>
                                @endif
                            </div>

                            <div class="task-points">Pontos: <span>{{ $info->point_value }}</span></div>
                            <div class='flex'>
                                <div class="task-complete mr-2">
                                    <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                        <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                        {{ $info->is_completed ? '✔️' : 'X' }}
                                        </a>
                                    </div>
                                </div>
                                <div class="edit-div">
                                <a href="/edit-table/{{$info->id}}">✏️</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach
    </div>
        <h2 class="text-tite">TAREFAS BING </h2>
    <div class="task-container">
            @foreach(Auth::user()->getValidTables() as $info)
                @if($info->type === "BING")
                    <div class='each-div' style="background-color: #87CEEB">
                        <div class="card">
                            <div class="flex">
                                <div class="task-name"><span>{{ $info->name }}</span></div>
                                @if ($info->streak > 0)
                                <div class="task-sequence">🔥 <span>{{ $info->streak }}</span></div>
                                @endif
                            </div>

                            <div class="task-points">Pontos: <span>{{ $info->point_value }}</span></div>
                            <div class='flex'>
                                <div class="task-complete mr-2">
                                    <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                        <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                        {{ $info->is_completed ? '✔️' : 'X' }}
                                        </a>
                                    </div>
                                </div>
                                <div class="edit-div">
                                <a href="/edit-table/{{$info->id}}">✏️</a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach
    </div>
    <h2 class="text-tite">TAREFAS XBOX </h2>
    <div class="task-container">
        @foreach(Auth::user()->getValidTables() as $info)
            @if($info->type === "XBOX")
                <div class='each-div' style="background-color: #107C10;">
                    <div class="card">
                        <div class="flex">
                            <div class="task-name"><span>{{ $info->name }}</span></div>
                            @if ($info->streak > 0)
                            <div class="task-sequence">🔥 <span>{{ $info->streak }}</span></div>
                            @endif
                        </div>

                        <div class="task-points">Pontos: <span>{{ $info->point_value }}</span></div>
                        <div class='flex'>
                            <div class="task-complete mr-2">
                                <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                    <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                    {{ $info->is_completed ? '✔️' : 'X' }}
                                    </a>
                                </div>
                            </div>
                            <div class="edit-div">
                            <a href="/edit-table/{{$info->id}}">✏️</a>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        @endforeach
</div>
        <h1 class="text-tite">PONTOS EXTRAS</h1>
        <div class="task-container">
            @foreach(Auth::user()->getExtraPoints() as $info)
            <div class='each-div'>
                <div class="task-name"><span>{{ $info->table_name }}</span></div>
                    <div class="task-points">Pontos: <span>{{ $info->point_value }}</span></div>
                    <div class='flex'>
                        <div class="task-complete mr-2">
                            <div class="task-button-confirm delete">
                                <form method="POST" action="delete-extra-point/{{$info->id}}">
                                    @csrf
                                    <input value="🗑️" type="submit"/>
                                        
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
    
            @endforeach
    </div>

    </div>
</x-app-layout>

<style>
    .text-tite{
        font-size: 15px;
        padding-left: 3rem;
        margin: 0
    }
    .edit-div{
        width: 30px;
        height: 30px;
        background-color: blue;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .task-button-confirm {
        width: 30px;
        height: 30px;
        background-color: red;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .task-button-confirm.completed{
        background-color: green!important;
    }
    .task-button-confirm.delete{
        background-color: red!important;
    }
    .task-container{
        display: flex;
        flex-wrap: wrap;
        padding-left: 3rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
        gap: 1rem;
        width: 100%;
        flex-direction: row;
    }
    .each-div{
        padding: 1rem;
        background-color: rgb(31 41 55);
        border-radius: 6px;
        color: white;
        width: 250px;
        height: 150px;
    }
    .card{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between; /* Distribui o espaço entre os itens igualmente */
        height: 100%; /* Garante que o card use toda a altura disponível */
    }
</style>