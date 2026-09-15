<?php

namespace App\Controllers;

class PaginaController
{
    public static function home(): void
    {
        require __DIR__ . '/../Views/home.php';
    }
}