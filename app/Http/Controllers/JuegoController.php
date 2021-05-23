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

        return view('tablero', compact('partida'));
    }

    private function getPartidaEnJuego()
    {
        return null;
    }
}
