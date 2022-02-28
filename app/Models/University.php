<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    UniversityCourse,
};

class University extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relationship of universities with courses
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'university_courses')
                        // Get all attributes of pivot table
                        ->withPivot((new UniversityCourse)->getFillable())
                        ->as('details');
    }
}
