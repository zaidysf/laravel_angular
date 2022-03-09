<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCoursePlaylist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_playlist_id',
        'student_course_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'student_playlist_id' => 'int',
        'student_course_id' => 'int',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['student_playlist', 'student_course'];

    public function student_playlist()
    {
        return $this->belongsTo(StudentPlaylist::class, 'student_playlist_id', 'id');
    }

    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class, 'student_course_id', 'id');
    }
}
