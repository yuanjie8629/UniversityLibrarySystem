<?php

namespace App\Http\Controllers;

class BorrowManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('borrow-management');
    }

    public function returnBook()
    {
        return view('return-book');
    }
}
