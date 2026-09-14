<?php

namespace App\Controllers;

use App\Models\Energetico;

class EnergeticoController
{
    public static function index(): void
    {
        $energeticos = Energetico::all();

        require __DIR__ . '/../Views/energetico/listar.php';
    }
}