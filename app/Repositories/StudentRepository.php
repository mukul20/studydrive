<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface 
{
    // Pagination limit
    private $pageLimit = 10;

    /**
     * Get list of students.
     *
     * @return array
     */
    public function getAll(): array
    {
        return Student::simplePaginate($this->pageLimit)->toArray();
    }

    /**
     * Get student details.
     *
     * @param  string  $studentId
     * @return array
     */
    public function getById($studentId): array
    {
        // Find student or throw not found exception
        return Student::findOrFail($studentId)->toArray();
    }

    /**
     * Create a student
     *
     * @param  array $studentData
     * @return array
     */
    public function create(array $studentData): array
    {
        // Create student object, fill attributes and save
        $student = new Student();
        $student->fill($studentData);
        $student->save();

        return $student->toArray();
    }
}