<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Interfaces\CourseRepositoryInterface;

class CourseController extends Controller
{
    // Repository for course model
    private $courseRepository;

    /**
     * Constructor function
     *
     * @return void
     */
    public function __construct(
        CourseRepositoryInterface $courseRepository
    ) {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Get list of courses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->courseRepository->getAll()
        );
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  CreateCourseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCourseRequest $request): JsonResponse
    {
        return response()->json(
            $this->courseRepository->create($request->validated())
        );
    }

    /**
     * Display a course.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(
            $this->courseRepository->getById($id)
        );
    }
}
