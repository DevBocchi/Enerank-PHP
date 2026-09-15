<?php

use App\Controllers\EnergeticoController;
use App\Controllers\PaginaController;

return [
    'home'   => [PaginaController::class, 'home'],
    'index'  => [EnergeticoController::class, 'index'],
    'create' => [EnergeticoController::class, 'create'],
    'store'  => [EnergeticoController::class, 'store'],
    'edit'   => [EnergeticoController::class, 'edit'],
    'update' => [EnergeticoController::class, 'update'],
    'delete' => [EnergeticoController::class, 'delete'],
];