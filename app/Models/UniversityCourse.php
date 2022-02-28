<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Registration;

class UniversityCourse extends Pivot
{
    protected $table = 'university_courses';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'university_id',
        'course_id',
        'capacity',
        'duration_in_months',
        'about',
    ];

    /**
     * Get all registrations for a course in university
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class, 'course_id', 'course_id')
                        ->where('university_id', $this->university_id);
    }
}
