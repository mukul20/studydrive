<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\{
    CourseController,
    RegistrationController,
    StudentController,
    UniversityController,
    UniversityCourseController,
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('courses', CourseController::class)
        ->only('index', 'store', 'show');

Route::resource('registrations', RegistrationController::class)
        ->only('index', 'store', 'show', 'destroy');

Route::resource('students', StudentController::class)
        ->only('index', 'store', 'show');

Route::resource('universities', UniversityController::class)
        ->only('index', 'store', 'show');

// Nested resource controller
Route::resource('universities.courses', UniversityCourseController::class)
        ->only('index', 'store');