<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
  public function showRegistrationForm()
  {
    return view('auth.register');
  }

  public function rules()
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'role' => ['required', Rule::in(['ADMIN', 'STUDENT', 'LECTURER'])],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'telephone' => ['required', 'string', 'min:10', 'max:11'],
    ];
  }

  public function register(Request $request)
  {
    // validate request
    $validator = Validator::make($request->only(['name', 'role', 'email', 'telephone']), $this->rules());
    if ($validator->fails()) {
      return response()->json(['message' => $validator->errors()->all()], 422);
    }
    $validated = $validator->validated();

    // check if user already exists
    $user = User::where('email', $validated['email'])->first();
    if ($user) {
      return response()->json(['message' => 'User already exists'], 400);
    }

    // telephone as password
    $validated['password'] = Hash::make($validated['telephone']);

    // create new user
    $user = User::create($validated);

    return response()->json(['message' => 'User created successfully'], 200);
  }
}
