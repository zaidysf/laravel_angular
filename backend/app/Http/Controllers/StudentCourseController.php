<?php

namespace App\Http\Controllers;

use App\Models\StudentCourse;
use App\Traits\BasicResponseTrait;

class StudentCourseController extends Controller
{
    use BasicResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'per_page' => 'integer',
        ]);

        $per_page = request('per_page', 10);
        return $this->successResponse(StudentCourse::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'student_id' => 'required|integer|students,id',
            'course_id' => 'required|integer|courses,id',
            'enroll_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        return $this->successResponse(
            StudentCourse::create(request()->all())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->successResponse(StudentCourse::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'student_id' => 'required|integer|students,id',
            'course_id' => 'required|integer|courses,id',
            'enroll_at' => 'required|date_format:Y-m-d H:i:s'
        ]);

        return $this->successResponse(
            StudentCourse::where('id', $id)->update(
                request()->all()
            ) ? StudentCourse::find($id) : $this->errorResponse([])
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->successResponse([]);
    }
}
