<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    Student,
    University,
};

class Registration extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'university_id',
        'course_id',
        'student_id',
    ];

    /**
     * Relationship of registration with course
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship of registration with student
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Relationship of registration with university
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
