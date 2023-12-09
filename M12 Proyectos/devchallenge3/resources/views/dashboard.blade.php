<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<x-app-layout>
    <x-slot name="header">

         <button class="btn btn-success" style="margin-left: 5px;">
            <a href="{{ route('calendar') }}">{{ __('Calendario') }}</a>
          
        </button> 

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1>Bien venidos a mi devchallenge 2 y 3.</h1>
                <br>
                <p class="text-justify">Hola, soy Jose luis Rodríguez Blanco y actualmente me encuentro en la apasionante etapa de ser estudiante, dedicándome
                    a explorar y aprender sobre desarrollo de aplicaciones web. Hoy, quiero compartir con ustedes un proyecto, en el que he estado trabajando.
                </p> <br>
                <h3 class="text-xl-left">Proyecto: Login + Calendario</h3>
                <br>
                <p> Este proyecto combina dos elementos : un sistema de login y un calendario interactivo.
                    Una herramienta que no solo nos permita organizar nuestras actividades y
                    recordatorios de manera eficiente, sino que también garantice la seguridad y privacidad de nuestra información.</p>
            </div>
        </div>
    </div>
</x-app-layout>