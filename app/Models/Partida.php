<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['posicionesX', 'posicionesO'];

    /**
     * Partida finalizada
     *
     * @return bool
     */
    public function finalizada()
    {
        return !is_null($this->ended_at);
    }
}
