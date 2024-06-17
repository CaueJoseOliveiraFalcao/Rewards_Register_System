<style>
        h1{
           font-size: 50px!important; 
           color: white!important;
        }
    </style>
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col justify-content-center items-center">
        <div class="flex flex-col justify-content-center items-center">
            <h1>Pontos : {{Auth::user()->getPointTableInfo()->point_value}}</h1>
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('dashboard')">
                                {{ __('EDITAR PONTOS') }}
                </x-nav-link>    
        </div>

    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <p>ola</p>
</x-app-layout>
