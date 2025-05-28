<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LecturersController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseLecturersController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::apiResource('students', StudentsController::class);
    Route::apiResource('courses', CoursesController::class);
    Route::apiResource('lecturers', LecturersController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    Route::apiResource('course_lecturers', CourseLecturersController::class);
});
