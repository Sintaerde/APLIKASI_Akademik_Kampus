<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturers;

class LecturersController extends Controller
{
    public function index()
    {
        return response()->json(Lecturers::all(), 200);
    }

    public function show($id)
    {
        $lecturer = Lecturers::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($lecturer);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lecturer_id' => 'required|unique:lecturers',
            'name' => 'required|string',
            'NIP' => 'required|string|unique:lecturers',
            'department' => 'required|string',
            'email' => 'required|email|unique:lecturers',
        ]);

        Lecturers::create($request->all());

        return response()->json(['message' => 'Data telah berhasil ditambahkan'], 201);
    }

    public function update(Request $request, $id)
    {
        $lecturer = Lecturers::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $lecturer->update($request->all());

        return response()->json(['message' => 'Data telah berhasil diupdate']);
    }

    public function destroy($id)
    {
        $lecturer = Lecturers::find($id);
        if (!$lecturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $lecturer->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
