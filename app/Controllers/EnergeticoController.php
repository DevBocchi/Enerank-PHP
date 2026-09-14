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

    public static function create(): void
    {
        require __DIR__ . '/../Views/energetico/criar.php';
    }

    public static function store(): void
    {
        $dados = [
            'marca' => $_POST['marca'],
            'nome'  => $_POST['nome'],
            'sabor' => $_POST['sabor'],
            'nota'  => $_POST['nota'],
            'zero'  => isset($_POST['zero']) ? 1 : 0,
        ];

        Energetico::create($dados);

        header('Location: verEnergetico.php');
        exit;
    }
}