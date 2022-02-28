<?php

namespace App\Repositories;

use App\Interfaces\RegistrationRepositoryInterface;
use App\Models\{
    Registration,
    UniversityCourse,
};

class RegistrationRepository implements RegistrationRepositoryInterface 
{
    // Pagination limit
    private $pageLimit = 10;

    /**
     * Get list of registrations.
     *
     * @return array
     */
    public function getAll(): array
    {
        return Registration::simplePaginate($this->pageLimit)->toArray();
    }

    /**
     * Get registration details.
     *
     * @param  string  $registrationId
     * @return array
     */
    public function getById($registrationId): array
    {
        return Registration::with('course', 'student', 'university')
                ->findOrFail($registrationId)
                ->makeHidden([
                    'course_id',
                    'university_id',
                    'student_id',
                ])
                ->toArray();
    }

    /**
     * Register a student for a course
     *
     * @param  array $registrationData
     * @return array
     */
    public function create(array $data): array
    {
        $registration = Registration::with('course', 'student', 'university')
                            ->where('course_id', $data['course_id'])
                            ->where('student_id', $data['student_id'])
                            ->where('university_id', $data['university_id'])
                            ->count();

        // Check if student has already registered
        if ($registration) {
            return [
                'message' => 'Already registered'
            ];
        }

        // Get course details
        $course = UniversityCourse::where('course_id', $data['course_id'])
                    ->where('university_id', $data['university_id'])
                    ->first();

        // Check if capacity of course is full
        if ($course->capacity > count($course->registrations)) {
            // Register a student for given course
            return Registration::firstOrCreate($data)->toArray();
        } else {
            return [
                'message' => 'No more registrations allowed'
            ];
        }
    }

    /**
     * Delete a registration.
     *
     * @param  string  $registrationId
     * @return void
     */
    public function deleteById($registrationId)
    {
        Registration::findOrFail($registrationId)->delete();
    }
}