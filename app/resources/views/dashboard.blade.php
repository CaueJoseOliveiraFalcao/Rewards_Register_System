<style>
        h1{
           font-size: 50px!important; 
        }
    </style>
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="/tablePointCreator">CRIAR TAREFA</a>
    </x-slot>

    <div class="flex flex-col justify-content-center items-center">
        <div class="flex flex-col justify-content-center items-center">
            <h1>Pontos : {{Auth::user()->getPointTableInfo()->point_value}}</h1>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('dashboard')">
                                {{ __('EDITAR PONTOS') }}
                </x-nav-link>    
        </div>
    </div>

    <div>
        <h1 class="text-center mt-9">TAREFAS</h1>
    <div class="task-container">
        @foreach(Auth::user()->getValidTables() as $info)
        <div class='each-div'>
            <div class="task-name"><span>{{ $info->name }}</span></div>
                @if ($info->streak > 0)
                <div class="task-sequence">🔥 <span>{{ $info->streak }}</span></div>
                @endif
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
                    <a href="#">✏️</a>
                    </div>
                </div>

        </div>

        @endforeach
</div>

    </div>
</x-app-layout>

<style>
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
    .task-container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .each-div{
        padding: 1rem;
        background-color: greenyellow;
        border-radius: 6px;
        margin-bottom: 1rem;
        display: flex;
        width: 1000px;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
</style>