<?php

namespace App\Interfaces;

interface UniversityCourseRepositoryInterface 
{
    /**
     * Upsert a course for university.
     *
     * @param  array $universityCourseData
     * @return array
     */
    public function create(array $universityCourseData): array;

    /**
     * Get list of university courses.
     *
     * @param  string  $universityId
     * @return array
     */
    public function getAll($universityId): array;
}