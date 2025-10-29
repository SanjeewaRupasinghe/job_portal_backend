<?php

use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('logs', [LogViewerController::class, 'index']);
