<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseSubject;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = new Course();
        $course->name= $request->name;

        $course->save();
        return response()->json($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return response()->json($course);
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
        $course= Course::find($id);

        $course->name = $request->input('name');
        $course->save();
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json('The course has been deleted successfully');
    }

    public function assignSubject(Request $request)
    {
        $data = $request->only('course_id', 'subject_id');

        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'subject_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $course = Course::find($request->course_id);
            $subject = Subject::find($request->subject_id);

            if (!$course) {
                return response()->json([
                    'message' => 'The course selected does not exist',
                    'status' => 0
                ]);
            }

            if (!$subject) {
                return response()->json([
                    'message' => 'The subject selected does not exist',
                    'status' => 0
                ]);
            }

            $course_subject = CourseSubject::firstOrNew([
                'course_id' => $request->course_id,
                'subject_id' => $request->subject_id
            ]);

            $course_subject->fill($data);

            $status = $course_subject->save();

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'The record already exists.',
                'status' => 0],
                HttpResponse::HTTP_CONFLICT);
        }

        return response()->json([
            'message' => $subject->name . ' has been added to ' . $course->name,
            'status' => $status
        ]);
    }
}
