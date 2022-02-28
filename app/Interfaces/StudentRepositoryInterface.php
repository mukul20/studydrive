<?php

namespace App\Interfaces;

interface StudentRepositoryInterface 
{
    /**
     * Create a student.
     *
     * @param  array $universityData
     * @return array
     */
    public function create(array $studentData): array;

    /**
     * Get list of students.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get student details.
     *
     * @param  string  $studentId
     * @return array
     */
    public function getById($studentId): array;
}