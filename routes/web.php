<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdemServicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/ordens/{id}/historico', [
        OrdemServicoController::class,
        'historico'
    ])
        ->name('ordens.historico');

    Route::get('/ordens/relatorio/pdf',
        [OrdemServicoController::class, 'relatorioPdf']
    )
        ->name('ordens.pdf');

    Route::resource('clientes', ClienteController::class);

    Route::resource('ordens', OrdemServicoController::class)
        ->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
