<style>
        h1{
           font-size: 50px!important; 
        }
        /* Tabela geral */
.table-body {
  min-width: 100%;
  border-collapse: collapse;
  margin: 20px 0;
  font-size: 16px;
  text-align: left;
  overflow: hidden; /* Garante que o conteúdo respeite as bordas arredondadas */
  table-layout: fixed;
  color: #333;
}

.table-body thead tr {
  background-color: gray; /* Verde mais escuro para o cabeçalho */
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
}
.table-body tbody tr td {
  height: 60px; /* Define uma altura fixa para todas as células */
}
.table-body th, .table-body td {
  padding: 1rem;
  color: white!important;
  text-align: -webkit-center!important;
  vertical-align: middle; /* Centraliza verticalmente */

}
.table-body th {
  width: 25%; /* Define largura fixa para cada coluna */
}

.variable-th-td{
    color: white!important;
    background-color: rgb(94, 94, 94);

}
.table-body td:last-child {
    display: flex;
    z-index: 999;


}
@media (max-width: 768px){
    .table-body tbody tr td {
    height: 100px;
    font-size: 12px;
    vertical-align: middle !important;
    padding: 0.2rem;
    display: table-cell !important;
    
}
    .th{
        font-size: 15px;
    }
    .table-body th {
        width: 15%; /* Define largura fixa para cada coluna */
        font-size: 13px;
    }
}


.gift-th-td{
    color: white!important;
    background-color: rgb(161, 3, 3);

}
.bing-th-td{
    background-color: #87CEEB;
}
.xbox-th-td{
    background-color: #107C10;
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


/* Botão de tarefa */
.task-button-confirm {
    padding: 1rem;
    border-style: solid;
    border-width: 1px;
    border-color: transparent;
}

.task-button-confirm::before {

}

.task-button-confirm.completed {
    background-color: white;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    border-radius: 5px;
    transition: .3s all;
}
.task-button-confirm.completed:hover {
    background: transparent;
    border-style: solid;
    border-color: white;
}

.task-button-confirm.awaiting {
    background-color:rgb(233, 23, 23);
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 35px;
    height: 35px;
    border-radius: 5px;
    transition: .3s all;

}

/* Estilo ao passar o mouse */
.task-button-confirm.awaiting:hover {
    background: transparent;
    border-style: solid;
    border-color: red;
}


.task-button-confirm.awaiting:hover::before {
    border-style: solid;
    border-color: white;
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
        <div class="task-container">
            <table class="table-body">
                <thead>
                  <tr>
                    <th class="gift-th-td">GIFT CARDS</th>
                    <th class="gift-th-td">Pontos</th>
                    <th class="gift-th-td">Data de Resgate</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->gift as $info)
                        <tr>
                            <td  class="gift-th-td">{{ $info->gift_name }}</td>
                            <td  class="gift-th-td"  >{{ $info->gift_value }}</td>
                            <td  class="gift-th-td" style="display: flex;justify-content:center;">{{ \Carbon\Carbon::parse($info->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                </tbody>
              </table>
        </div>
    @endisset
    <div>
        <table class="table-body">
            <thead>
              <tr>
                <th class="variable-th-td">TAREFAS VARIAVEIS</th>
                <th class="variable-th-td">Pontos</th>
                <th class="variable-th-td">Status</th>
                <th class="variable-th-td">Editar</th>
              </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->getValidTables() as $info)
                    @if($info->type === "BING_VARIAVEL" || $info->type === "XBOX_VARIAVEL")
                    <tr>
                        @if ($info->streak > 0)
                            <td  class="variable-th-td">{{$info->name + ' ' + $info->streak + 🔥}}</td>
                        @else 
                            <td  class="variable-th-td">{{$info->name}}</td>
                        @endif
                        <td  class="variable-th-td">{{ $info->point_value }}</td>
                        <td  class="variable-th-td">
                            <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                {{ $info->is_completed ? '✔️' : 'X' }}
                                </a>
                            </div>
                        </td>
                        <td class="variable-th-td" style="display: table-cell;">
                            <div class="edit-div">
                                <a href="/edit-table/{{$info->id}}">✏️</a>
                                </div>
                        </td>
                    </tr>
                    @endif 
                    @endforeach
            </tbody>
          </table>
    </div>
        <div>
            <table class="table-body">
                <thead>
                  <tr>
                    <th class="bing-th-td">TAREFAS BING</th>
                    <th class="bing-th-td">Pontos</th>
                    <th class="bing-th-td">Status</th>
                    <th class="bing-th-td">Editar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->getValidTables() as $info)
                    @if($info->type === "BING")
                        <tr>
                            
                            @if ($info->streak > 0)
                                <td  class="bing-th-td">{{$info->name . ' ' . $info->streak . '🔥'}}</td>
                            @else 
                                <td  class="bing-th-td">{{$info->name}}</td>
                            @endif
                            <td  class="bing-th-td">{{ $info->point_value }}</td>
                            <td  class="bing-th-td">
                                <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                    <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                    {{ $info->is_completed ? '✔️' : 'X' }}
                                    </a>
                                </div>
                            </td>
                            <td class="bing-th-td" style="display: table-cell;">
                                <div class="edit-div">
                                    <a href="/edit-table/{{$info->id}}">✏️</a>
                                    </div>
                            </td>
                        </tr>
                        @endif 
                        @endforeach
                </tbody>
              </table>
        </div>
        <div>
            <table class="table-body">
                <thead>
                  <tr>
                    <th class="xbox-th-td">TAREFAS Xbox</th>
                    <th class="xbox-th-td">Pontos</th>
                    <th class="xbox-th-td">Status</th>
                    <th class="xbox-th-td">Editar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->getValidTables() as $info)
                    @if($info->type === "XBOX")
                        <tr>
                            
                            @if ($info->streak > 0)
                                <td  class="xbox-th-td">{{$info->name . ' ' . $info->streak . '🔥'}}</td>
                            @else 
                                <td  class="xbox-th-td">{{$info->name}}</td>
                            @endif
                            <td  class="xbox-th-td">{{ $info->point_value }}</td>
                            <td  class="xbox-th-td">
                                <div class="task-button-confirm {{ $info->is_completed ? 'completed' : 'awaiting' }}">
                                    <a href="{{ $info->is_completed ? '#' : route('register.create' , ['id' => $info->id])}}">
                                    {{ $info->is_completed ? '✔️' : 'X' }}
                                    </a>
                                </div>
                            </td>
                            <td class="xbox-th-td" style="display: table-cell;">
                                <div class="edit-div">
                                    <a href="/edit-table/{{$info->id}}">✏️</a>
                                    </div>
                            </td>
                        </tr>
                        @endif 
                        @endforeach
                </tbody>
              </table>
        </div>
            <?php if (Auth::user() && Auth::user()->getExtraPoints() !== null):?>
            <div class="task-container">
                <table class="table-body">
                    <thead>
                    <tr>
                        <th class="gift-th-td">PONTOS EXTRAS</th>
                        <th class="gift-th-td">Pontos</th>
                        <th class="gift-th-td">Data Criação</th>
                        <th class="gift-th-td">Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->getExtraPoints() as $info)
                            <tr>
                                <td  class="gift-th-td">{{ $info->table_name }}</td>
                                <td  class="gift-th-td">{{ $info->point_value }}</td>
                                <td  class="gift-th-td">{{ \Carbon\Carbon::parse($info->created_at)->format('d/m/Y H:i') }}</td>
                                <td  class="gift-th-td"  style="display: flex;justify-content:center;"> 
                                <form method="POST" action="delete-extra-point/{{$info->id}}">
                                    @csrf
                                    <input value="🗑️" type="submit"/>
                                </form></td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
    @endisset
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
        border-radius: 5px;
        background-color: blue;
        padding: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .task-container{
        display: flex;
        flex-wrap: wrap;
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