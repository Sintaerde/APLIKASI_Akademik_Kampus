<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // 🔐 REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:students',
            'NIM' => 'required|unique:students',
            'major' => 'required|string',
            'enrollment_year' => 'required|date',
            'password' => 'required|min:6'
        ]);

        $student = Students::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'email' => $request->email,
            'NIM' => $request->NIM,
            'major' => $request->major,
            'enrollment_year' => $request->enrollment_year,
            'password' => bcrypt($request->password)
        ]);

        return response()->json(['message' => 'Register success', 'data' => $student], 201);
    }

    // 🔑 LOGIN
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $student = Students::where('email', $request->email)->first();

    if (!$student || !Hash::check($request->password, $student->password)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $token = $student->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $student
    ]);
}


    // 🚪 LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
