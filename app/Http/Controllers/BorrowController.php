<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Borrow;
use App\Models\User;

class BorrowController extends Controller
{
    //retrieve all borrows
    public function readAll(Request $request)
    {
        $borrows = Borrow::select('borrows.id', "borrows.book_id", "borrows.user_id", "borrows.borrow_date", "borrows.return_date", 'books.title', "books.image", "users.name")->join("books", "books.id", '=', 'borrows.book_id')->join("users", "users.id", '=', 'borrows.user_id')->get();
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
    public function createRules()
    {
        return [
            'user_id' => ['required', 'integer'],
            'book_id' => ['required', 'integer'],
            'borrow_date' => ['required', 'date'],
        ];
    }

    //create new borrow
    public function create(Request $request)
    {
        // validate request
        $validator = Validator::make($request->only(['user_id', 'book_id', 'borrow_date']), $this->createRules());
        // check if borrow is already exist
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        //check if user exists
        $user = User::find($validated['user_id']);
        if (is_null($user)) {
            return response()->json(['message' => 'Invalid User ID'], 400);
        }

        // check if book available
        $book = Book::find($validated['book_id']);
        if (is_null($book)) {
            return response()->json(['message' => 'Invalid Book ID'], 400);
        }

        if ($book->status != 'AVAILABLE') {
            return response()->json(['message' => 'Book is not available'], 400);
        }

        // create new borrow
        $borrow = Borrow::create($validated);

        // update book status
        $book->status = 'BORROWED';
        $book->save();

        return response()->json($borrow);
    }

    public function updateRules()
    {
        return [
            'book_id' => ['required', 'integer'],
            'return_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['AVAILABLE', 'LOST'])],
        ];
    }

    // update a borrow
    public function update(Request $request, $id)
    {
        // validate request
        $validator = Validator::make($request->only(['book_id', 'return_date', "status"]), $this->updateRules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $borrow = Borrow::find($id);
        if ($borrow) {
            // update borrow
            $borrow->update($validated);

            // update book status
            $book = Book::find($validated['book_id']);
            $book->status = $validated['status'];
            $book->save();

            return response()->json($borrow);
        } else {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
    }

    // delete a borrow
    public function delete(Request $request, $id)
    {
        $borrow = Borrow::find($id);
        if ($borrow) {
            if (is_null($borrow->return_date)) {
                return response()->json(['message' => 'Book should be returned first'], 404);
            }
            $borrow->delete();
            return response()->json(['message' => 'Borrow deleted'], 200);
        } else {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
    }
}
