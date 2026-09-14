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

    public static function edit(): void
    {
        $id = $_GET['id'] ?? null;

        $energetico = Energetico::find($id);

        require __DIR__ . '/../Views/energetico/editar.php';
    }

    public static function update(): void
    {
        $id = $_POST['id'];

        $dados = [
            'marca' => $_POST['marca'],
            'nome'  => $_POST['nome'],
            'sabor' => $_POST['sabor'],
            'nota'  => $_POST['nota'],
            'zero'  => isset($_POST['zero']) ? 1 : 0,
        ];

        Energetico::update($id, $dados);

        header('Location: verEnergetico.php');
        exit;
    }
}