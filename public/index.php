<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

$rotas = require __DIR__ . '/../config/routes.php';

$rota = $_GET['rota'] ?? 'home';

if (!isset($rotas[$rota])) {
    http_response_code(404);
    echo 'Página não encontrada';
    exit;
}

[$controller, $metodo] = $rotas[$rota];

call_user_func([$controller, $metodo]);