<?php

namespace App\Interfaces;

interface CourseRepositoryInterface 
{
    /**
     * Get course details.
     *
     * @param  array $courseData
     * @return array
     */
    public function create(array $courseData): array;

    /**
     * Get list of courses.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get course details.
     *
     * @param  string  $courseId
     * @return array
     */
    public function getById($courseId): array;
}