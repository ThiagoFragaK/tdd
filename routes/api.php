<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;

Route::controller(ProjectsController::class)
    ->prefix("projects")
    ->group(function() {
        Route::get('/', 'index');
        Route::post('/create', 'store');
        Route::put('/edit', 'edit');
        Route::delete('/destroy', 'delete');
    });
