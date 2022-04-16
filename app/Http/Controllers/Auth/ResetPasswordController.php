<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($user->telephone);
        $user->save();
        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}
