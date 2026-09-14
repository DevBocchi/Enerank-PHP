<?php

use App\Controllers\EnergeticoController;

return [
    'index'  => [EnergeticoController::class, 'index'],
    'create' => [EnergeticoController::class, 'create'],
    'store'  => [EnergeticoController::class, 'store'],
    'edit'   => [EnergeticoController::class, 'edit'],
    'update' => [EnergeticoController::class, 'update'],
    'delete' => [EnergeticoController::class, 'delete'],
];