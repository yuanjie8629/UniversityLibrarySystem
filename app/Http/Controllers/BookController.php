<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;
use App\Models\Book;

class BookController extends Controller
{
    // retrieve all books
    public function readAll(Request $request)
    {
        $books = Book::all();
        return response()->json($books);
    }

    // retrieve one book
    public function readOne(Request $request, $id)
    {
        $book = Book::find($id);
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    // rules for validation
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'pages' => ['required', 'integer', /* 'min:1' */],
            'categories' => ['required', 'array', /* 'min:1' */],
            'image' => ['required', 'string', 'url'],
            'status' => ['required', Rule::in(['AVAILABLE', 'BORROWED', 'LOST'])],
        ];
    }

    // create new book
    public function create(Request $request)
    {
        // assign status default value
        $request->merge(['status' => 'AVAILABLE']);

        // validate request
        $validator = Validator::make($request->all(), $this->rules());
        // check if book is already exist
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        // check if book already exists
        $book = Book::where('title', $validated['title'])->first();
        if ($book) {
            return response()->json(['message' => 'Book already exists'], 400);
        }

        $book = new Book();
        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->publisher = $validated['publisher'];
        $book->pages = $validated['pages'];
        $book->categories = serialize($validated['categories']);
        $book->image = $validated['image'];
        $book->status = $validated['status'];
        $book->save();

        // return error message if failed
        if (!$book) {
            return response()->json(['message' => 'Failed to create new book'], 500);
        }

        return response()->json($book, 201);
    }

    // update a book
    public function update(Request $request, $id)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules());
        // check if book is already exist
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $book = Book::find($id);
        if ($book) {
            $book->title = $validated['title'];
            $book->author = $validated['author'];
            $book->publisher = $validated['publisher'];
            $book->pages = $validated['pages'];
            $book->categories = serialize($validated['categories']);
            $book->image = $validated['image'];
            $book->status = $validated['status'];
            $book->save();

            return response()->json($book, 200);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    // delete a book
    public function delete($id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Book deleted'], 200);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }
}
