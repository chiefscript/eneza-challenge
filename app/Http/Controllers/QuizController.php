<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
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
}
