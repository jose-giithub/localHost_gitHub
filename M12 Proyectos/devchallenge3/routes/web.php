<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return redirect()->route('login');
});

//iniciar sesion y la vista iniciar desde el login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
     Route::get('/event/index', [EventController::class, 'index'])->name('calendar');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::put('/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/event/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});
