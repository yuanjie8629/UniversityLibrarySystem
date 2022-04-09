<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;
use App\Models\Borrow;

class BorrowController extends Controller
{
    //retrieve all borrows
    public function readAll(Request $request)
    {
        $borrows = Borrow::all();
        return response()->json($borrows);
    }

    // retrieve one borrow
    public function readOne(Request $request, $id)
    {
        $borrow = Borrow::find($id);
        if ($borrow) {
            return response()->json($borrow);
        } else {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
    }

    // rules for validation
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer'],
            'book_id' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'borrow_period' => ['required', 'integer'],
            'return_date' => ['required', 'date'],
        ];
    }

    //create new borrow
    public function create(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules());
        // check if borrow is already exist
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        // check if borrow already exists
        $borrow = Borrow::where('user_id', $validated['user_id'])
            ->where('book_id', $validated['book_id'])
            ->first();
        if ($borrow) {
            return response()->json(['message' => 'Borrow already exists'], 400);
        }

        // create new borrow
        $borrow = Borrow::create($validated);
        return response()->json($borrow);
    }

    // update a borrow
    public function updateBorrow(Request $request, $id)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules());
        // check if borrow is already exist
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        // check if borrow already exists
        $borrow = Borrow::where('user_id', $validated['user_id'])
            ->where('book_id', $validated['book_id'])
            ->first();
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        // update borrow
        $borrow->update($validated);
        return response()->json($borrow);
    }

    // delete a borrow
    public function deleteBorrow(Request $request, $id)
    {
        $borrow = Borrow::find($id);
        if ($borrow) {
            $borrow->delete();
            return response()->json(['message' => 'Borrow deleted'], 200);
        } else {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
    }
}
