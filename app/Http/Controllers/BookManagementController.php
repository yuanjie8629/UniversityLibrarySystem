<?php

namespace App\Http\Controllers;

class BookManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('book-management');
    }
}
