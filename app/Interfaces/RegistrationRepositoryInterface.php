<?php

namespace App\Interfaces;

interface RegistrationRepositoryInterface 
{
    /**
     * Register a student for a course
     *
     * @param  array $registrationData
     * @return array
     */
    public function create(array $registrationData): array;

    /**
     * Get list of registrations.
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get registration details.
     *
     * @param  string  $registrationId
     * @return array
     */
    public function getById($registrationId): array;

    /**
     * Delete a registration.
     *
     * @param  string  $registrationId
     * @return void
     */
    public function deleteById($registrationId);
}