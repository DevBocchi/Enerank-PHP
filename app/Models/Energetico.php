<?php

class Energetico
{
    public static function all(): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM energeticos");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(array $dados): bool
    {
        $pdo = Database::getConnection();
        $query = ("INSERT INTO energeticos (marca, nome, sabor, nota, zero)
                                   VALUES (:marca, :nome, :sabor, :nota, :zero)
                                  ");
        $stmt = $pdo->prepare($query);

        return $stmt->execute([
           'marca' => $dados['marca'],
           'nome' => $dados['nome'],
           'sabor' => $dados['sabor'],
           'nota' => $dados['nota'],
           'zero' => $dados['zero']
        ]);
    }

    public static function update(int $id, array $dados): bool
    {
        $pdo = Database::getConnection();
        $query = ("UPDATE energeticos 
                   SET marca = :marca, nome = :nome, sabor = :sabor, nota = :sabor, zero = :zero
                   WHERE id = :id");
        $stmt = $pdo->prepare($query);

        return $stmt->execute([
            'id' => $id['id'],
            'marca' => $dados['marca'],
            'nome' => $dados['nome'],
            'sabor' => $dados['sabor'],
            'nota' => $dados['nota'],
            'zero' => $dados['zero']
        ]);
    }

    public static function delete(int $id) : bool
    {
        $pdo = Database::getConnection();
        $query = ("DELETE FROM energeticos WHERE id = :id");
        $stmt = $pdo->prepare($query);

        return $stmt->execute(['id' => $id]);
    }
}