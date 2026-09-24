<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController
{
    public function register(): void
    {
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function store(): void
    {
        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        ];

        Usuario::create($dados);

        header('Location: index.php?rota=login');
        exit;
    }

    public function login(): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function autenticador(): void
    {
        $usuario = Usuario::findByEmail($_POST['email']);

        if(!$usuario || !password_verify($_POST['senha'], $usuario['senha_hash'])){
            header('Location: index.php?rota=login&error=1');
            exit;
        }

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header('Location = index.php');
        exit;
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}











