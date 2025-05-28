<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        return response()->json(Students::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'NIM' => 'required|unique:students',
            'major' => 'required',
            'enrollment_year' => 'required|date',
            'password' => 'required|min:6'
        ]);

        $request['password'] = bcrypt($request->password);

        Students::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $student = Students::find($id);
        if (!$student) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($student, 200);
    }

    public function update(Request $request, $id)
    {
        $student = Students::find($id);
        if (!$student) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $student->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $student = Students::find($id);
        if (!$student) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Data telah berhasil dihapus']);
    }
}
