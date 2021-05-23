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
        $turno = $this->calcularTurno($posiciones);

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
     * Colocar ficha en el tablero si movimiento correcto
     *
     * @return \Illuminate\View\View
     */
    public function colocarFicha(Request $request)
    {
        $partida = $this->getPartidaEnJuego();

        // solo si existe una partida en juego no terminada
        if ($partida && is_null($partida->ended_at)) {
            $posiciones = $this->determinarPosiciones($partida);
            // si el movimiento es correcto
            if ($posiciones[$request->celdaSeleccionada] == false) {
                if ($this->calcularTurno($posiciones) == 'O') {
                    $posicionesO = json_decode($partida->posicionesO, true);
                    $posicionesO[] = $request->celdaSeleccionada;
                    $partida->posicionesO = json_encode($posicionesO);
                } else {
                    $posicionesX = json_decode($partida->posicionesX, true);
                    $posicionesX[] = $request->celdaSeleccionada;
                    $partida->posicionesX = json_encode($posicionesX);
                }
                $partida->save();
            }
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

    /**
     * Calcular turno del juego
     *
     * @param array $posiciones (del tablero)
     * @return String ['X', 'O']
     */
    private function calcularTurno(array $posiciones)
    {
        return (0 == count(array_filter($posiciones)) % 2) ? 'O' : 'X';
    }
}
