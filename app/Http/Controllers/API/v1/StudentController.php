<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Interfaces\StudentRepositoryInterface;

class StudentController extends Controller
{
    // Repository for student model
    private $studentRepository;

    /**
     * Constructor function
     *
     * @return void
     */
    public function __construct(
        StudentRepositoryInterface $studentRepository
    ) {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Get list of students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->studentRepository->getAll()
        );
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  CreateStudentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateStudentRequest $request): JsonResponse
    {
        return response()->json(
            $this->studentRepository->create($request->validated())
        );
    }

    /**
     * Display a student.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json(
            $this->studentRepository->getById($id)
        );
    }
}
