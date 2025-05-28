<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        return response()->json(Enrollment::all(), 200);
    }

    public function show($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($enrollment);
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|unique:enrollments',
            'student_id' => 'required|string',
            'course_id' => 'required|string',
            'grade' => 'required|string',
            'attendance' => 'required|string',
            'status' => 'required|string',
        ]);

        Enrollment::create($request->all());

        return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $enrollment->update($request->all());

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $enrollment->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
