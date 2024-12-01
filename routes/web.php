<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get("/", [NoteController::class, "index"]) ->name("notes.index");
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');

Route::delete('/notes/{id}', [NoteController::class, 'delete'])->name('notes.delete');
