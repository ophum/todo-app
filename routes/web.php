<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/{id}', [TodoController::class, 'show'])->name('todos.show');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::post('/todos/{id}/update-done', [TodoController::class, 'updateDone'])->name('todos.updateDone');
    Route::post('/todos/{id}/update-deadline', [TodoController::class, 'updateDeadline'])->name('todos.updateDeadline');
});
