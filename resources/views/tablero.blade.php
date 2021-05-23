@extends('layouts.app')

@section('content')
    <div class="rounded-xl bg-yellow-50 p-8">
        <div class="grid grid-cols-3 gap-4">
            <div class="celda-tablero">X
            </div>
            <div class="celda-tablero">O
            </div>
            <div class="celda-tablero">O
            </div>
            <div class="celda-tablero">O
            </div>
            <div class="celda-tablero">X
            </div>
            <div class="celda-tablero">X
            </div>
            <div class="celda-tablero">O
            </div>
            <div class="celda-tablero">X
            </div>
            <div class="celda-tablero">O
            </div>
        </div>
    </div>

    @if ($partida)
        <div class="flex items-center justify-center text-gray-600">
            <p class="text-2xl font-medium">Turno: </p>
        </div>
    @else
        <div class="flex items-center justify-center p-3">
            <button class="rounded-md bg-yellow-400 text-2xl font-medium text-white p-3">Iniciar partida</button>
        </div>
    @endif

@endsection
