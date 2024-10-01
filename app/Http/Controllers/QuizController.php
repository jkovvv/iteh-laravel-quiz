<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create(Request $request){
        $incoming_fields = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        $incoming_fields['title'] = strip_tags($incoming_fields['title']);
        $incoming_fields['description'] = strip_tags($incoming_fields['description']);
        Quiz::create($incoming_fields);
        return response()->json(['message' => 'Quiz created successfully!'], 201);
    }

    public function read(Quiz $quiz)
    {
        if (!$quiz) {
            return response()->json(['error' => 'Quiz not found']);
        }

        return response()->json($quiz);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $incoming_fields = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
        ]);

        $quiz->update($incoming_fields);
        return response()->json(['message' => 'Quiz updated successfully!']);
    }

    public function delete(Quiz $quiz)
    {
        if($quiz->allQuestions()->exists()){
            //Da l' mogu da zovem odavde QuestionController da ih izbrise sve?
            return response()->json(['message' => 'Cannot delete quiz, there are still questions in it.']);
        }
        else{
            $quiz->delete();
            return response()->json(['message' => 'Quiz deleted successfully!']);
        }
    }
}
