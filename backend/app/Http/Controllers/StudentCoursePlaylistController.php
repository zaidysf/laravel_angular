<?php

namespace App\Http\Controllers;

use App\Models\StudentCoursePlaylist;
use App\Traits\BasicResponseTrait;

class StudentCoursePlaylistController extends Controller
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
        return $this->successResponse(StudentCoursePlaylist::paginate($per_page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'student_playlist_id' => 'required|integer|student_playlists,id',
            'student_course_id' => 'required|integer|student_courses,id',
        ]);

        return $this->successResponse(
            StudentCoursePlaylist::create(request()->all())
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
        return $this->successResponse(StudentCoursePlaylist::find($id));
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
            'student_playlist_id' => 'required|integer|student_playlists,id',
            'student_course_id' => 'required|integer|student_courses,id',
        ]);

        return $this->successResponse(
            StudentCoursePlaylist::where('id', $id)->update(
                request()->all()
            ) ? StudentCoursePlaylist::find($id) : $this->errorResponse([])
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
