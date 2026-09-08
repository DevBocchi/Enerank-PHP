<?php
$dbHost = "";
$dbPort = "";
$dbName = "";
$dbUser = "";
$dbPassword = "";

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;port=$dbPort;dbname=$dbName",
        $dbUser,
        $dbPassword
    );
} catch (PDOException $e) {
    echo "Error na conexao: " . $e->getMessage();
}