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

    @if (!empty($mensajeError))
        <div class="rounded-md flex items-center justify-center bg-red-300 my-2 p-3">
            <p class="font-medium text-red-800">{{ $mensajeError }}</p>
        </div>
    @endif

    @if ($partida)
        <div class="flex items-center justify-center text-gray-600">
            <p class="text-2xl font-medium">Turno: </p>
        </div>
    @else
        <div class="flex items-center justify-center p-3">
            <form method="POST" action="/">
                @csrf
                <input type="submit" id="btn-iniciar-partida"
                    class="rounded-md bg-yellow-400 p-3 text-2xl font-medium text-white" value="Iniciar partida" />
            </form>
        </div>
    @endif

@endsection
