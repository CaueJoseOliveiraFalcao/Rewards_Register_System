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
  border-radius: 15px; /* Bordas arredondadas */
  overflow: hidden; /* Garante que o conteúdo respeite as bordas arredondadas */

  color: #333;
}

.table-body thead tr {
  background-color: gray; /* Verde mais escuro para o cabeçalho */
  color: #fff;
  text-transform: uppercase;
  font-weight: bold;
}

.table-body th, .table-body td {
  padding: 1rem;
  color: white!important;

}

.variable-th-td{
    color: white!important;
    background-color: rgb(94, 94, 94);

}
.table-body td:last-child {
    display: flex;
    text-align: center;
    justify-content: center;

}


.gift-th-td{
    color: white!important;
    background-color: rgb(161, 3, 3);
}
.bing-th-td{
    background-color: #87CEEB;
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
  display: inline-block;
  width: 40px;
  height: 40px;
  border-radius: 50%; /* Botão circular */
  position: relative;
  overflow: hidden;
  background-color: transparent; /* Transparente por padrão */
  border: 2px solid #f39c12; /* Cor inicial para tarefas incompletas */
  transition: all 0.5s ease-in-out; /* Suaviza a transição */
}

.task-button-confirm::before {
  content: 'X'; /* Símbolo inicial */
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 20px;
  color: rgba(255, 255, 255, 0.7); /* Branco translúcido */
  transition: all 0.5s ease-in-out; /* Transição suave */
}

.task-button-confirm.completed {
  width: 35px;
  height: 35px;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fff; /* Fundo branco ao completar */
  border: 2px solid #fff; /* Define uma borda verde visível */
  transition: all 0.3s ease-in-out; /* Transição suave */

}

.task-button-confirm.completed::before {
  content: '✔️'; /* Símbolo de certo */
  color: rgba(255, 255, 255, 1); /* Branco visível inicialmente */
  font-size: 16px; /* Ajusta o tamanho do símbolo */
  transition: all 0.3s ease-in-out; /* Suaviza a transição */
  position: absolute;
}

/* Estilo ao passar o mouse */
.task-button-confirm.completed:hover {
  color: white; /* Torna o símbolo principal invisível */
  background-color: transparent; /* Fundo transparente */
  border-color: #fff; /* Torna a borda branca */
}

.task-button-confirm.completed:hover::before {
  color: rgba(255, 255, 255, 0); /* Torna o símbolo invisível */
  background-color: transparent; /* Sem fundo para o pseudo-elemento */
}
.task-button-confirm.awaiting {
    width: 35px;
    height: 35px;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: transparent; /* Fundo transparente para tarefas incompletas */
  border: 2px solid #f39c12; /* Laranja para borda de tarefas incompletas */
  transition: all 0.3s ease-in-out; /* Suaviza a transição */
  position: relative; /* Necessário para o pseudo-elemento */
}

.task-button-confirm.awaiting::before {
  content: 'X'; /* Símbolo de tarefa pendente */
  color: rgba(255, 255, 255, 0.7); /* Branco translúcido */
  font-size: 16px; /* Ajusta o tamanho do símbolo */
  transition: all 0.3s ease-in-out; /* Suaviza a transição */
  position: absolute;
}

/* Estilo ao passar o mouse */
.task-button-confirm.awaiting:hover {
  background-color: #f39c12; /* Fundo laranja ao passar o mouse */
  border-color: transparent; /* Remove a borda */
}

.task-button-confirm.awaiting:hover::before {
  color: rgba(255, 255, 255, 1); /* Torna o símbolo visível */
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
                  </tr>
                </thead>
                <tbody>
                    @foreach(Auth::user()->gift as $info)
                        <tr>
                                <td  class="gift-th-td">{{ $info->gift_name }}</td>
                            <td  class="gift-th-td">{{ $info->gift_value }}</td>
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
                        </tr>
                        @endif 
                        @endforeach
                </tbody>
              </table>
        </div>
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