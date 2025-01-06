<style>
        h1{
           font-size: 50px!important; 
        }
        /* Tabela geral */
.table-body {
  max-width: 500px;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 16px;
  text-align: left;
  border-radius: 10px;
  color: #333;
}

.table-body thead tr {
  background-color: #2ecc71; /* Verde mais escuro para o cabeçalho */
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
}

.table-body th, .table-body td {
  padding: 12px 15px;
  border: 1px solid #ddd;
}

.table-body tbody tr:nth-child(even) {
  background-color: #f9f9f9; /* Alternar cores para melhor leitura */
}

.table-body tbody tr:hover {
  background-color: #d4edda; /* Realce em verde claro ao passar o mouse */
}

/* Estilizando colunas específicas */
.table-body td:first-child {
  font-weight: bold;
  color: #27ae60; /* Verde para nomes */
}

.table-body td:last-child {
  text-align: center;
}

/* Botões de tarefa */
.task-button-confirm {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 4px;
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
}

.task-button-confirm.awaiting {
  background-color: #f39c12; /* Amarelo para tarefas pendentes */
  color: #fff;
}

.task-button-confirm.completed {
  background-color: #2ecc71; /* Verde para tarefas completas */
  color: #fff;
}

.task-button-confirm a {
  color: inherit;
  text-decoration: none;
}

/* Ícones */
.task-button-confirm a:hover {
  text-decoration: underline;
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

                                <div class="task-points">Pontos: <span>{{ $info->gift_value }}</span></div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    @endisset
    <div>
        <table class="table-body">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Value</th>
                <th>Complete</th>
              </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->getValidTables() as $info)
                    @if($info->type === "BING_VARIAVEL" || $info->type === "XBOX_VARIAVEL")
                    <tr>
                        
                        @if ($info->streak > 0)
                            <td>{{$info->name + ' ' + $info->streak + 🔥}}</td>
                        @else 
                            <td>{{$info->name}}</td>
                        @endif
                        <td>{{ $info->point_value }}</td>
                        <td>
                            <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                {{ $info->is_completed ? '✔️' : 'X' }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endif 
                    @endforeach
            </tbody>
          </table>
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