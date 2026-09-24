<?php

namespace App\Models;

use PDO;

/**
 * Model da tabela `energeticos`.
 * Todo SQL relacionado a energéticos vive aqui — nada de query solta
 * dentro das páginas de public/.
 */
class Energetico
{

    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM energeticos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function find(int $id): ?array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM energeticos WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }


    public static function create(array $dados): bool
    {
        $pdo = Database::getConnection();
        $query = "INSERT INTO energeticos (marca, nome, sabor, nota, zero)
                  VALUES (:marca, :nome, :sabor, :nota, :zero)";

        $stmt = $pdo->prepare($query);

        return $stmt->execute([
            'marca' => $dados['marca'],
            'nome'  => $dados['nome'],
            'sabor' => $dados['sabor'],
            'nota'  => $dados['nota'],
            'zero'  => $dados['zero'],
        ]);
    }


    public static function update(int $id, array $dados): bool
    {
        $pdo = Database::getConnection();
        $query = "UPDATE energeticos
                  SET marca = :marca, nome = :nome, sabor = :sabor, nota = :nota, zero = :zero
                  WHERE id = :id";

        $stmt = $pdo->prepare($query);

        return $stmt->execute([
            'id'    => $id,
            'marca' => $dados['marca'],
            'nome'  => $dados['nome'],
            'sabor' => $dados['sabor'],
            'nota'  => $dados['nota'],
            'zero'  => $dados['zero'],
        ]);
    }


    public static function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM energeticos WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}