<?php

namespace App\Http\Controllers;

use App\Subject;
use App\SubjectTutorial;
use App\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response as HttpResponse;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('tutorials')->get();
        return response()->json($subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subject = new Subject();
        $subject->name= $request->name;

        $subject->save();
        return response()->json($subject);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        return response()->json($subject);
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
        $subject= Subject::find($id);

        $subject->name = $request->input('name');
        $subject->save();
        return response()->json($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return response()->json('The subject has been deleted successfully');
    }

    public function assignTutorial(Request $request)
    {
        $data = $request->only('course_id', 'subject_id');

        $validator = Validator::make($request->all(), [
            'subject_id' => 'required',
            'tutorial_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $subject = Subject::find($request->subject_id);
            $tutorial = Tutorial::find($request->tutorial_id);

            if (!$subject) {
                return response()->json([
                    'message' => 'The subject selected does not exist',
                    'status' => 0
                ]);
            }

            if (!$tutorial) {
                return response()->json([
                    'message' => 'The tutorial selected does not exist',
                    'status' => 0
                ]);
            }

            $subject_tutorial = SubjectTutorial::firstOrNew([
                'subject_id' => $request->subject_id,
                'tutorial_id' => $request->tutorial_id
            ]);

            $subject_tutorial->fill($data);

            $status = $subject_tutorial->save();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'The record already exists.',
                'status' => 0],
                HttpResponse::HTTP_CONFLICT);
        }

        return response()->json([
            'message' => 'The tutorial selected has been added to ' . $subject->name,
            'status' => $status
        ]);
    }
}
