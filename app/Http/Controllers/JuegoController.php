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
        if (!$partida || $partida->finalizada()) {
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
        $datosValidados = $request->validate([
            'celdaSeleccionada' => 'required|integer|min:1|max:9',
        ]);

        $partida = $this->getPartidaEnJuego();

        // solo si existe una partida en juego no terminada
        if ($partida && !$partida->finalizada()) {
            $this->procesarMovimiento($partida, $datosValidados['celdaSeleccionada']);
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

    /**
     * Guardar la nueva posición de ficha
     *
     * @param App\Models\Partida $partida
     * @param int $celda
     * @return void
     */
    private function procesarMovimiento(Partida $partida, int $celda)
    {
        // si el movimiento es correcto
        $posiciones = $this->determinarPosiciones($partida);
        if ($posiciones[$celda] == false) {
            $turno = $this->calcularTurno($posiciones);
            if ($turno == 'O') {
                $posicionesJugador = json_decode($partida->posicionesO, true);
                $posicionesJugador[] = $celda;
                $partida->posicionesO = json_encode($posicionesJugador);
            } else {
                $posicionesJugador = json_decode($partida->posicionesX, true);
                $posicionesJugador[] = $celda;
                $partida->posicionesX = json_encode($posicionesJugador);
            }
            // comprobar final de partida (por ganador o por tablero completo)
            if ($this->posicionGanadora($posicionesJugador)) {
                $partida->ended_at = now();
                $partida->ganador = $turno;
            } elseif (count(array_filter($posiciones)) == 8) {
                $partida->ended_at = now();
                $partida->ganador = 'Tablas';
            }
            $partida->save();
        }
    }

    /**
     * Comprobar si la posición es ganadora
     *
     * @param array $posiciones
     * @return bool
     */
    private function posicionGanadora(array $posicionesJugador)
    {
        return count(array_intersect($posicionesJugador, array("1", "2", "3"))) === 3
            || count(array_intersect($posicionesJugador, array("4", "5", "6"))) === 3
            || count(array_intersect($posicionesJugador, array("7", "8", "9"))) === 3
            || count(array_intersect($posicionesJugador, array("1", "4", "7"))) === 3
            || count(array_intersect($posicionesJugador, array("2", "5", "8"))) === 3
            || count(array_intersect($posicionesJugador, array("3", "6", "9"))) === 3
            || count(array_intersect($posicionesJugador, array("1", "5", "9"))) === 3
            || count(array_intersect($posicionesJugador, array("3", "5", "7"))) === 3;
    }
}
