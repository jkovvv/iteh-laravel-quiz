<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizAttemptController;

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

//Quiz related routes
Route::post('/create-quiz', [QuizController::class, 'create']);
Route::get('/show-quiz/{quiz}', [QuizController::class, 'read']);
Route::patch('/update-quiz/{quiz}', [QuizController::class, 'update']);
Route::delete('/delete-quiz/{quiz}', [QuizController::class, 'delete']);

//Quiz attempt related routes
Route::post('/create-quiz-attempt', [QuizAttemptController::class, 'create']);
//Moze ih biti vise - napravi show all?
Route::get('/show-quiz-attempt/{quiz}/{user}', [QuizAttemptController::class, 'read']);
Route::patch('/update-quiz-attempt/{quiz}/{user}', [QuizAttemptController::class, 'update']);
Route::delete('/delete-quiz-attempt/{quiz}/{user}', [QuizAttemptController::class, 'delete']);