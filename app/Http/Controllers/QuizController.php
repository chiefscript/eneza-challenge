<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use App\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();
        return response()->json($quizzes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $quiz = new Quiz();
        $quiz->name = $request->name;

        $quiz->save();
        return response()->json($quiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        return response()->json($quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quiz= Quiz::find($id);

        $quiz->name = $request->input('name');
        $quiz->save();
        return response()->json($quiz);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        return response()->json('The quiz has been deleted successfully');
    }

    public function assignQuestion(Request $request)
    {
        $data = $request->only('quiz_id', 'question_id');

        $validator = Validator::make($request->all(), [
            'quiz_id' => 'required',
            'question_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $quiz = Quiz::find($request->quiz_id);
            $question = Question::find($request->question_id);

            if (!$quiz) {
                return response()->json([
                    'message' => 'The quiz selected does not exist',
                    'status' => 0
                ]);
            }

            if (!$question) {
                return response()->json([
                    'message' => 'The question selected does not exist',
                    'status' => 0
                ]);
            }

            $quiz_question = QuizQuestion::firstOrNew([
                'quiz_id' => $request->quiz_id,
                'question_id' => $request->question_id
            ]);

            $quiz_question->fill($data);

            $status = $quiz_question->save();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'The record already exists.',
                'status' => 0],
                HttpResponse::HTTP_CONFLICT);
        }

        return response()->json([
            'message' => 'The question has been added to the quiz.',
            'status' => $status
        ]);
    }
}
