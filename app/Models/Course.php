<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    University,
    UniversityCourse,
};

class Course extends Model
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
     * Relationship of courses with universities
     */
    public function universities()
    {
        return $this->belongsToMany(University::class, 'university_courses')
                        // Get all attributes of pivot table
                        ->withPivot((new UniversityCourse)->getFillable())
                        ->as('details');
    }
}
