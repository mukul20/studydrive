<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface 
{
    // Pagination limit
    private $pageLimit = 10;

    /**
     * Get list of courses.
     *
     * @return array
     */
    public function getAll(): array
    {
        return Course::simplePaginate($this->pageLimit)->toArray();
    }

    /**
     * Get course details.
     *
     * @param  string  $courseId
     * @return array
     */
    public function getById($courseId): array
    {
        return Course::findOrFail($courseId)->toArray();
    }

    /**
     * Create a course
     *
     * @param  array $registrationData
     * @return array
     */
    public function create(array $courseData): array
    {
        // Create course object, fill attributes and save
        $course = new Course();
        $course->fill($courseData);
        $course->save();

        return $course->toArray();
    }
}