@extends('layouts.app')

@section('content')
    <form id="formMovimiento" method="POST" action="/colocar">
        @csrf
        <input type="hidden" name="celdaSeleccionada" value="qq">
        <div class="rounded-t-xl bg-yellow-50 p-8">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($posiciones as $posicion)
                    <div class="{{ $partida && !$partida->finalizada() && !$posicion ? 'celda-tablero-libre' : 'celda-tablero' }}"
                        data-index-number="{{ $loop->index + 1 }}">
                        {{ $posicion }}
                    </div>
                @endforeach
            </div>
        </div>
    </form>

    @if ($partida)
        @if ($partida->finalizada())
            <div class="flex items-center justify-center text-gray-600">
                <p class="text-2xl font-medium">Ganador: {{ $partida->ganador }}</p>
            </div>
            @include('layouts.boton_iniciar')
        @else
            <div class="flex items-center justify-center text-gray-600">
                <p class="text-2xl font-medium">Turno Jugador {{ $turno }}</p>
            </div>
        @endif
    @else
        @include('layouts.boton_iniciar')
    @endif

@endsection
