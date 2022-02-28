<?php

namespace App\Repositories;

use App\Interfaces\UniversityCourseRepositoryInterface;
use App\Transformers\UniversityCourseTransformer;
use App\Models\{
    Registration,
    University,
    UniversityCourse,
};

class UniversityCourseRepository implements UniversityCourseRepositoryInterface 
{
    /**
     * Get list of university courses.
     *
     * @param  string  $universityId
     * @return array
     */
    public function getAll($universityId): array
    {
        $university = University::with('courses')
                        ->findOrFail($universityId)
                        ->toArray();

        $registrations = Registration::selectRaw('course_id, count(*) as count')
                            ->where('university_id', $universityId)
                            ->groupBy('course_id')
                            ->get()
                            ->toArray();

        // Transform the data and return
        return UniversityCourseTransformer::transform(
            $university,
            $registrations
        );
    }

    /**
     * Upsert a course for university.
     *
     * @param  array $data
     * @return array
     */
    public function create(array $data): array
    {
        $university = University::findOrFail($data['university_id']);

        if (empty($university->courses->find($data['course_id']))) {
            $university->courses()->attach(
                $data['course_id'],
                $data
            );

            $university = University::with('courses')
                            ->find($data['university_id']);
        }

        return $university->toArray();
    }
}