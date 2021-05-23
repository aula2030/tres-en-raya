        <div class="flex items-center justify-center p-3">
            <form method="POST" action="/">
                @csrf
                <input type="submit" class="rounded-md bg-yellow-400 p-3 text-2xl font-medium text-white cursor-pointer"
                    value="{{ $partida ? 'Empezar de nuevo' : 'Iniciar partida' }}" />
            </form>
        </div>
