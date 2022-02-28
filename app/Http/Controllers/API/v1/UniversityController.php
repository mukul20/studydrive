<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUniversityRequest;
use App\Interfaces\UniversityRepositoryInterface;

class UniversityController extends Controller
{
    // Repository for university model
    private $universityRepository;

    /**
     * Constructor function
     *
     * @return void
     */
    public function __construct(
        UniversityRepositoryInterface $universityRepository
    ) {
        $this->universityRepository = $universityRepository;
    }

    /**
     * Get list of university.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->universityRepository->getAll()
        );
    }

    /**
     * Store a newly created university in storage.
     *
     * @param  CreateUniversityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUniversityRequest $request): JsonResponse
    {
        return response()->json(
            $this->universityRepository->create($request->validated())
        );
    }

    /**
     * Display a university.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(
            $this->universityRepository->getById($id)
        );
    }
}
