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

        $posiciones = $this->determinarPosiciones($partida);

        // cálculo del turno automático
        $turno = (0 == count(array_filter($posiciones)) % 2) ? 'X' : 'O';

        return view('tablero', [
            'partida' => $partida,
            'posiciones' => $posiciones,
            'turno' => $turno,
        ]);
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
     * Determinar las 9 posiciones del tablero (false, X, O)
     *
     * @return array
     */
    private function determinarPosiciones(Partida $partida = null)
    {
        $posiciones = array_fill(1, 9, false);

        if ($partida) {
            foreach (json_decode($partida->posicionesX, true) as $celdaX) {
                $posiciones[$celdaX] = 'X';
            }
            foreach (json_decode($partida->posicionesO, true) as $celdaO) {
                $posiciones[$celdaO] = 'O';
            }
        }

        return $posiciones;
    }
}
