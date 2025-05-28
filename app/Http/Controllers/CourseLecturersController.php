<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseLecturer;

class CourseLecturersController extends Controller
{
    public function index()
    {
        return response()->json(CourseLecturer::all(), 200);
    }

    public function show($id)
    {
        $courseLecturer = CourseLecturer::find($id);
        if (!$courseLecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($courseLecturer);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|unique:course_lecturers',
            'course_id' => 'required|string',
            'lecturer_id' => 'required|string',
            'role' => 'required|string',
        ]);

        CourseLecturer::create($request->all());

        return response()->json(['message' => 'Data berhasil ditambahkan'], 201);
    }

    public function update(Request $request, $id)
    {
        $courseLecturer = CourseLecturer::find($id);
        if (!$courseLecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $courseLecturer->update($request->all());

        return response()->json(['message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $courseLecturer = CourseLecturer::find($id);
        if (!$courseLecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $courseLecturer->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
