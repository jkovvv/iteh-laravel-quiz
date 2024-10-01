<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuizAttempt;
use App\Models\Quiz;
use App\Models\User;

class QuizAttemptController extends Controller
{
    public function create(Request $request){
        $incoming_fields = $request->validate([
            'user_id' => 'required|integer',
            'quiz_id' => 'required|integer',
            'score' => 'required|numeric|min:0|max:100'
        ]);
        $incoming_fields['attempted_at'] = now();
        QuizAttempt::create($incoming_fields);
        return response()->json(['message' => 'Quiz attempt created successfully!'], 201);
    }

    public function read($quiz_id, $user_id)
    {
        $quizAttempt = QuizAttempt::where('quiz_id', $quiz_id)->where('user_id', $user_id)->first();

        if (!$quizAttempt) {
        return response()->json([
            'message' => 'No quiz attempt found for the given user and quiz.'
        ]);
        }
        return response()->json($quizAttempt);
    }

    public function update(Request $request, $quiz_id, $user_id)
    {
        $quizAttempt = QuizAttempt::where('quiz_id', $quiz_id)->where('user_id', $user_id)->first();

        $incoming_fields = $request->validate([
            'user_id' => 'required|integer',
            'quiz_id' => 'required|integer',
            'score' => 'required|numeric|min:0|max:100'
        ]);

        $quizAttempt->update($incoming_fields);
        return response()->json(['message' => 'Quiz attempt updated successfully!']);
    }

    public function delete($quiz_id, $user_id)
    {
        $quizAttempt = QuizAttempt::where('quiz_id', $quiz_id)->where('user_id', $user_id)->first();
        
        $quizAttempt->delete();
        return response()->json(['message' => 'Quiz attempt deleted successfully!']);
        
    }
}