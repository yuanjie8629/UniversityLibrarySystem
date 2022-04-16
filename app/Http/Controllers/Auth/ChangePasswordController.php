<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    // rules for validation
    public function createRules()
    {
        return [
            'old_password' => ['required'],
            'password' => [
                'required_with: password2',
                'min:8',  // must be at least 8 characters in length
            ],
            'password2' => ['required', 'same:password']
        ];
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->only(['old_password', 'password', 'password2']), $this->createRules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $user = User::find($id);

        // check if old pass matched with new pass
        if (!Hash::check($validated['old_password'], $user->password)) {
            return response()->json(['message' => 'Invalid Old Password.'], 400);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();
        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function index()
    {
        return view('change-password');
    }
}
