<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request, $id)
    {
        if ($request->has('password')) {
            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Password changed successfully'], 200);
        }

        return response()->json(['message' => 'Password not changed'], 400);
    }

    public function index()
    {
    return view('change-password');
    }
}


