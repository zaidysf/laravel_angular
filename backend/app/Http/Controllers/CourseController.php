<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Traits\BasicResponseTrait;

class CourseController extends Controller
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
        return $this->successResponse(Course::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:100',
            'video_url' => 'required|url|max:1000',
            'description' => 'required|string|max:2000',
            'teacher' => 'required|string|max:100',
        ]);

        return $this->successResponse(
            Course::create(request()->all())
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
        return $this->successResponse(Course::find($id));
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
            'name' => 'required|string|max:100',
            'video_url' => 'required|url|max:1000',
            'description' => 'required|string|max:2000',
            'teacher' => 'required|string|max:100',
        ]);

        return $this->successResponse(
            Course::where('id', $id)->update(
                request()->all()
            ) ? Course::find($id) : $this->errorResponse([])
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
