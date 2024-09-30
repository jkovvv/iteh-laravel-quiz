<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Question related routes
Route::post('/store-question', [QuestionController::class, 'store']);
Route::get('/show-question/{question}', [QuestionController::class, 'show']);
Route::patch('/edit-question/{question}', [QuestionController::class, 'update']);
Route::delete('/delete-question/{question}', [QuestionController::class, 'destroy']);
