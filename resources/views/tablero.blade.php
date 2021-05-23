@extends('layouts.app')

@section('content')
    <form id="formMovimiento" method="POST" action="/colocar">
        @csrf
        <input type="hidden" name="celdaSeleccionada" value="qq">
        <div class="rounded-t-xl bg-yellow-50 p-8">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($posiciones as $posicion)
                    <div class="{{ !$posicion ? 'celda-tablero-libre' : 'celda-tablero' }}"
                        data-index-number="{{ $loop->index + 1 }}">
                        {{ $posicion }}
                    </div>
                @endforeach
            </div>
        </div>
    </form>

    @if ($partida)
        <div class="flex items-center justify-center text-gray-600">
            <p class="text-2xl font-medium">Turno Jugador {{ $turno }}</p>
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
