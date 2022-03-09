<?php

namespace App\Http\Controllers;

use App\Models\StudentPlaylist;
use App\Traits\BasicResponseTrait;

class StudentPlaylistController extends Controller
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
        return $this->successResponse(StudentPlaylist::paginate($per_page));
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
        ]);

        return $this->successResponse(
            StudentPlaylist::create(request()->all())
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
        return $this->successResponse(StudentPlaylist::find($id));
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:1000',
        ]);

        return $this->successResponse(
            StudentPlaylist::where('id', $id)->update(
                request()->all()
            ) ? StudentPlaylist::find($id) : $this->errorResponse([])
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
