<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;

class CoursesController extends Controller
{
    // GET all courses
    public function index()
    {
        return response()->json(Courses::all(), 200);
    }

    // GET course by ID
    public function show($id)
    {
        $course = Courses::find($id);
        if (!$course) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($course, 200);
    }

    // POST create course
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|unique:courses',
            'name' => 'required|string',
            'code' => 'required|string',
            'credits' => 'required|string',
            'semester' => 'required|string',
        ]);

        Courses::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    // PUT update course
    public function update(Request $request, $id)
    {
        $course = Courses::find($id);
        if (!$course) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $course->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    // DELETE course
    public function destroy($id)
    {
        $course = Courses::find($id);
        if (!$course) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
