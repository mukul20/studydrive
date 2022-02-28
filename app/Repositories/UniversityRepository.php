<?php

namespace App\Repositories;

use App\Interfaces\UniversityRepositoryInterface;
use App\Models\University;

class UniversityRepository implements UniversityRepositoryInterface 
{
    // Pagination limit
    private $pageLimit = 10;

    /**
     * Get list of universities.
     *
     * @return array
     */
    public function getAll(): array
    {
        return University::simplePaginate($this->pageLimit)->toArray();
    }

    /**
     * Get university details.
     *
     * @param  string  $universityId
     * @return array
     */
    public function getById($universityId): array
    {
        // Find university or throw not found exception
        return University::findOrFail($universityId)->toArray();
    }

    /**
     * Create a university
     *
     * @param  array $universityData
     * @return array
     */
    public function create(array $universityData): array
    {
        // Create university object, fill attributes and save
        $university = new University();
        $university->fill($universityData);
        $university->save();

        return $university->toArray();
    }
}