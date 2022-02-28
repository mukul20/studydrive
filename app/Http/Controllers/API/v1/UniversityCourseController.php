<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUniversityCourseRequest;
use App\Interfaces\UniversityCourseRepositoryInterface;


class UniversityCourseController extends Controller
{
    // Repository for university_course model
    private $universityCourseRepository;

    /**
     * Constructor function
     *
     * @return void
     */
    public function __construct(
        UniversityCourseRepositoryInterface $universityCourseRepository
    ) {
        $this->universityCourseRepository = $universityCourseRepository;
    }

    /**
     * Get list of university courses.
     *
     * @param  string  $universityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($universityId): JsonResponse
    {
        return response()->json(
            $this->universityCourseRepository->getAll($universityId)
        );
    }

    /**
     * Upsert a course for university.
     *
     * @param  CreateUniversityCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUniversityCourseRequest $request): JsonResponse
    {
        return response()->json(
            $this->universityCourseRepository->create($request->validated())
        );
    }
}
