<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRegistrationRequest;
use App\Interfaces\RegistrationRepositoryInterface;

class RegistrationController extends Controller
{
    // Repository for registration model
    private $registrationRepository;

    /**
     * Constructor function
     *
     * @return void
     */
    public function __construct(
        RegistrationRepositoryInterface $registrationRepository
    ) {
        $this->registrationRepository = $registrationRepository;
    }

    /**
     * Get list of registrations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->registrationRepository->getAll()
        );
    }

    /**
     * Register a student for a course
     *
     * @param  CreateRegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateRegistrationRequest $request): JsonResponse
    {
        return response()->json(
            $this->registrationRepository->create($request->validated())
        );
    }

    /**
     * Get registration details.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(
            $this->registrationRepository->getById($id)
        );
    }

    /**
     * Delete a registration.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->registrationRepository->deleteById($id);

        return response()->json(['message' => 'success']);
    }
}
