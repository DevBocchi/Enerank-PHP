<?php

namespace App\Models;

class Usuario
{
    public static function create (array $dados): bool
    {
        $pdo = Database::getConnection();
        $query = "INSERT INTO usuarios (nome, email, senha_hash)
                  VALUES (:nome, :email, :senha_hash)
                 ";
        $stmt = $pdo->prepare($query);
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);

        return $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha_hash' => $senhaHash,
        ]);
    }

    public static function findByEmail (int $email): array|false
    {
        $pdo = Database::getConnection();
        $query = "SELECT * FROM usuarios
                  WHERE email = :email;
                 ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([ 'email' => $email ]);

        return $stmt->fetch();
    }
}