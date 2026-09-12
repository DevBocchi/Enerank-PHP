<?php

namespace App\Models;

use PDO;
use PDOException;

/**
 * Classe responsável por criar e devolver SEMPRE a mesma conexão PDO
 * durante uma requisição (padrão de projeto "Singleton").
 *
 * Por que Singleton? Sem ele, toda vez que algum trecho do código
 * precisasse do banco, poderia acabar abrindo uma NOVA conexão PDO.
 * Isso desperdiça recursos do servidor MySQL. Com o Singleton, a
 * primeira chamada cria a conexão; todas as chamadas seguintes
 * reaproveitam a mesma.
 */
class Database
{
    // Guarda a única instância de PDO que vai existir.
    // Começa como null porque, no início da requisição, ainda não conectamos.
    private static ?PDO $instance = null;

    // Construtor privado: ninguém de fora pode fazer "new Database()".
    // A única forma de usar essa classe é pelo método getConnection() abaixo.
    private function __construct()
    {
    }

    /**
     * Devolve a conexão PDO ativa. Cria uma nova apenas na primeira vez
     * que for chamada; nas próximas, devolve a que já existe.
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            self::loadEnv();

            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $name = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            try {
                self::$instance = new PDO(
                    "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4",
                    $user,
                    $pass
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }

        return self::$instance;
    }

    /**
     * Lê o arquivo .env (na raiz do projeto) e carrega cada linha
     * "CHAVE=valor" como uma variável de ambiente, disponível via getenv().
     *
     * Isso evita ter usuário/senha do banco escritos direto no código.
     * Frameworks grandes usam bibliotecas prontas pra isso (ex: vlucas/phpdotenv);
     * aqui fazemos uma versão simples, só pra entender o conceito.
     */
    private static function loadEnv(): void
    {
        $envPath = __DIR__ . '/../../.env';

        if (!file_exists($envPath)) {
            die("Arquivo .env não encontrado. Copie .env.example para .env e preencha com suas credenciais.");
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // ignora comentários (linhas que começam com #)
            if (str_starts_with($line, '#')) {
                continue;
            }

            [$key, $value] = array_map('trim', explode('=', $line, 2));
            putenv("$key=$value");
        }
    }
}