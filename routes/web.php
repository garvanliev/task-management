<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard',[AdminController::class,'index'])->middleware(['auth', 'verified','role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index');

    Route::post('/tasks',[TaskController::class,'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit',[TaskController::class,'edit'])->name('tasks.edit');
    Route::patch('/tasks/{task}',[TaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',[TaskController::class,'destroy'])->name('tasks.delete');

    Route::resource('tasks.comments', CommentsController::class)->only(['store', 'destroy']);


    Route::resource('status',StatusController::class)->only(['store', 'destroy']);

});

Route::middleware(['auth'])->group(function () {
    Route::get('/view-all', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin');
});

require __DIR__.'/auth.php';
