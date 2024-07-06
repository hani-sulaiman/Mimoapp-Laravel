<?php

use App\Http\Controllers\api\FolderController;
use App\Http\Controllers\api\NoteController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[UserController::class,'login']);
Route::post('/signup',[UserController::class,'signup']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/note/all',[NoteController::class,'index']);
    Route::get('/note/{id}/folder',[NoteController::class,'getFolderByNote']); 
    Route::post('/note/create',[NoteController::class,'store']);
    Route::patch('/note/{noteId}/move-to/folder/{folderId}',[NoteController::class,'moveNoteToFolder']); 
    Route::patch('/note/edit/{id}',[NoteController::class,'update']);
    Route::delete('/note/delete/{id}',[NoteController::class,'destroy']);

    Route::get('/folder/all',[FolderController::class,'index']);
    Route::get('/folder/{id}/note/all',[FolderController::class,'getNotesByFolder']); 
    Route::post('/folder/create',[FolderController::class,'store']);
    Route::patch('/folder/edit/{id}',[FolderController::class,'update']);
    Route::delete('/folder/delete/{id}',[FolderController::class,'destroy']);
});
