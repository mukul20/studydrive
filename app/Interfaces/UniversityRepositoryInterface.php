<?php

namespace App\Interfaces;

interface UniversityRepositoryInterface 
{
    /**
     * Create a university.
     *
     * @param  array $universityData
     * @return array
     */
    public function create(array $universityData): array;

    /**
     * Get list of universities.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get university details.
     *
     * @param  string  $universityId
     * @return array
     */
    public function getById($universityId): array;
}