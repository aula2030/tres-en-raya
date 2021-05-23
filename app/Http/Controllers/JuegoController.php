<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Partida;

class JuegoController extends Controller
{

    /**
     * Gestionar y mostrar el tablero.
     *
     * @return \Illuminate\View\View
     */
    public function showTablero()
    {
        $partida = $this->getPartidaEnJuego();

        return view('tablero', [
            'partida' => $partida,
        ]);
    }

    /**
     * Recuperar los datos de la partida en juego, si hay una.
     *
     * @return \App\Models\Partida
     */
    private function getPartidaEnJuego()
    {
        return session()->has('partida_id')
            ? Partida::find(session('partida_id'))
            : null;
    }

    /**
     * Iniciar una nueva partida (si no hay ninguna activa)
     *
     * @return \Illuminate\View\View
     */
    public function nuevaPartida()
    {
        $partida = $this->getPartidaEnJuego();
        if (!$partida) {
            $partida = Partida::create([
                'posicionesX' => '[]',
                'posicionesO' => '[]',
            ]);
            session(['partida_id' => $partida->id]);
        }

        return redirect()->route('tablero');
    }
}
