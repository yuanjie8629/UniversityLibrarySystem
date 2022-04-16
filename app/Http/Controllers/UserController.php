<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{

    // rules for validation
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', Rule::in(['ADMIN', 'STUDENT', 'LECTURER'])],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telephone' => ['required', 'string', 'min:10', 'max:11'],
        ];
    }

    // retrieve all users
    public function readAll(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }

    // update a user
    public function update(Request $request, $id)
    {
        // validate request
        $validator = Validator::make($request->only(['name', 'email', 'telephone', 'role']), $this->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $user = User::find($id);
        if ($user) {
            // update book
            $user->update($validated);

            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // delete a user
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
