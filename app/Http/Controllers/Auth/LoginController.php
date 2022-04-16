<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function rules()
  {
    return [
      'email' => 'required|email',
      'password' => 'required|min:8'
    ];
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->only(['email', 'password']), $this->rules());
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }
    $validated = $validator->validated();

    // check if email and password is correct
    $user = User::where('email', $validated['email'])->first();
    if (!$user || !Hash::check($validated['password'], $user->password)) {
      return response()->json(['errors' => ['email' => ['Invalid credentials']]], 422);
    }

    // redirect to dashboard
    if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
      $user = Auth::user();
      $role = $user->role;
      switch ($role) {
        case 'ADMIN':
          return redirect('/manage-books');
          // return redirect()->route('testing');
        case 'STUDENT':
          return redirect('/home');
        case 'LECTURER':
          return redirect('/home');
        default:
          return redirect('/home');
      }
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/');
  }
}
